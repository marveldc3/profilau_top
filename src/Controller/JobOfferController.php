<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Form\JobOfferType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOfferController extends AbstractController
{
    #[Route('/job-offers', name: 'job_offer_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $jobOffers = $entityManager->getRepository(JobOffer::class)->findAll();

        return $this->render('job_offer/list.html.twig', [
            'jobOffers' => $jobOffers,
        ]);
    }

    #[Route('/job-offers/new', name: 'job_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jobOffer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobOffer);
            $entityManager->flush();

            return $this->redirectToRoute('job_offer_list');
        }

        return $this->render('job_offer/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/job-offers/{id}', name: 'job_offer_show')]
    public function show(JobOffer $jobOffer): Response
    {
        return $this->render('job_offer/show.html.twig', [
            'jobOffer' => $jobOffer,
        ]);
    }

    #[Route('/job-offers/{id}/edit', name: 'job_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JobOffer $jobOffer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('job_offer_list');
        }

        return $this->render('job_offer/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/job-offers/{id}/delete', name: 'job_offer_delete', methods: ['POST'])]
    public function delete(Request $request, JobOffer $jobOffer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobOffer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($jobOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_offer_list');
    }
}

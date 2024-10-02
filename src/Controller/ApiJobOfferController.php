<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiJobOfferController extends AbstractController
{
    #[Route('/api/job-offers/update-status', name: 'api_job_offer_update_status', methods: ['POST'])]
    public function updateStatus(Request $request, JobOfferRepository $jobOfferRepository, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['id']) && isset($data['status'])) {
            $jobOffer = $jobOfferRepository->find($data['id']);

            if ($jobOffer) {
                $jobOffer->setStatus($data['status']);
                $entityManager->flush();
                return $this->json(['message' => 'Job offer status updated successfully']);
            }
        }

        return $this->json(['error' => 'Invalid data'], 400);
    }
}
<?php

namespace App\Controller;

use App\Entity\CoverLetter;
use App\Form\CoverLetterType;
use App\Repository\CoverLetterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoverLetterController extends AbstractController
{
    #[Route('/cover-letter/generate', name: 'cover_letter_generate', methods: ['POST'])]
    public function generate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coverLetter = new CoverLetter();
        $form = $this->createForm(CoverLetterType::class, $coverLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coverLetter);
            $entityManager->flush();
            return $this->json(['message' => 'Cover letter generated successfully']);
        }

        return $this->json(['errors' => $form->getErrors(true)], 400);
    }

    #[Route('/cover-letter/{id}', name: 'cover_letter_show', methods: ['GET'])]
    public function show(CoverLetter $coverLetter): Response
    {
        return $this->render('cover_letter/show.html.twig', ['coverLetter' => $coverLetter]);
    }
}
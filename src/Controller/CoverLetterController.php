<?php

namespace App\Controller;

use App\Entity\CoverLetter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoverLetterController extends AbstractController
{
    #[Route('/cover-letter/generate', name: 'cover_letter_generate', methods: ['POST'])]
    public function generate(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Logic to generate cover letter
        // ...

        return new Response('Cover letter generated successfully');
    }

    #[Route('/cover-letter/{id}', name: 'cover_letter_show')]
    public function show(CoverLetter $coverLetter): Response
    {
        return $this->render('cover_letter/show.html.twig', [
            'coverLetter' => $coverLetter,
        ]);
    }
}

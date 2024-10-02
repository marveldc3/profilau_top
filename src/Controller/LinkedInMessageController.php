<?php

namespace App\Controller;

use App\Entity\LinkedInMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinkedInMessageController extends AbstractController
{
    #[Route('/linkedin-message/generate', name: 'linkedin_message_generate', methods: ['POST'])]
    public function generate(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Logic to generate LinkedIn message
        // ...

        return new Response('LinkedIn message generated successfully');
    }

    #[Route('/linkedin-message/{id}', name: 'linkedin_message_show')]
    public function show(LinkedInMessage $linkedInMessage): Response
    {
        return $this->render('linkedin_message/show.html.twig', [
            'linkedInMessage' => $linkedInMessage,
        ]);
    }
}

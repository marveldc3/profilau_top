<?php

namespace App\Controller;

use App\Entity\LinkedInMessage;
use App\Form\LinkedInMessageType;
use App\Repository\LinkedInMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LinkedInMessageController extends AbstractController
{
    #[Route('/linkedin-message/generate', name: 'linkedin_message_generate', methods: ['POST'])]
    public function generate(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new LinkedInMessage();
        $form = $this->createForm(LinkedInMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();
            return $this->json(['message' => 'LinkedIn message generated successfully']);
        }

        return $this->json(['errors' => $form->getErrors(true)], 400);
    }

    #[Route('/linkedin-message/{id}', name: 'linkedin_message_show', methods: ['GET'])]
    public function show(LinkedInMessage $message): Response
    {
        return $this->render('linkedin_message/show.html.twig', ['message' => $message]);
    }
}
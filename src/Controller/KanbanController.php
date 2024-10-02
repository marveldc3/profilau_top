<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KanbanController extends AbstractController
{
    #[Route('/kanban', name: 'kanban_index')]
    public function index(): Response
    {
        return $this->render('kanban/index.html.twig');
    }
}

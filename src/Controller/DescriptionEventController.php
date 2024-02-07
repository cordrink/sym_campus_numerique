<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DescriptionEventController extends AbstractController
{
    #[Route('/description/event', name: 'app_description_event')]
    public function index(): Response
    {
        return $this->render('description_event/index.html.twig', [
            'controller_name' => 'DescriptionEventController',
        ]);
    }
}

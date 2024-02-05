<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventDecriptionController extends AbstractController
{
    #[Route('/event-decription/{id}', name: 'app_event_decription')]
    public function index(int $id, EventRepository $eventRepository): Response
    {
        $event  = $eventRepository->findBy(['id'=>$id]);

//        dd($event);

        return $this->render('event_decription/index.html.twig', [
            'event' => $event,
        ]);
    }
}

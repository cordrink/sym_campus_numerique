<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\RegisterType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventManagersController extends AbstractController
{
    #[Route('/profile/event-managers', name: 'app_event_managers')]
    public function index(EventRepository $eventRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $event = $eventRepository->findBy(['user' => $user]);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);


        if ($form->isSubmitted() and $form->isValid() ) {

//            $comment->setEvent();
            $comment->setAuthor($user);
            $comment->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($comment);
            $manager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('event_managers/index.html.twig', [
            'events' => $event,
            'form' => $form,
        ]);
    }
}

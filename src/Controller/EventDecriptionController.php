<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventDecriptionController extends AbstractController
{
    #[Route('/event-decription/{slug}', name: 'app_event_decription')]
    public function index( EventRepository $eventRepository, $slug, CommentRepository $commentRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $event  = $eventRepository->findOneBy(['slug'=>$slug]);
        $comments = $commentRepository->findBy(['event'=>$event->getId()]);
//        dd($comments);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()){
            $comment->setEvent($event);
            $comment->setCreatedAt(new \DateTimeImmutable());
            $comment->setAuthor($this->getUser());

            $entityManager->persist($comment);
            $entityManager->flush($comment);
        }

        return $this->render('event_decription/index.html.twig', [
            'event'=> $event,
            'comments'=>$comments,
            'form'=>$form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Services\CategoriesServices;
use App\Services\UploadFile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddEventController extends AbstractController
{
    private UploadFile $uploadFile;

    public function __construct(UploadFile $uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }
    #[Route('/add-event', name: 'app_add_event')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $event->setCreatedAt(new \DateTimeImmutable());
            $event->setIsValid(0);

            $file = $form['illustration']->getData();
            $fileUrl = $this->uploadFile->saveFile($file);


            $event->setIllustration($fileUrl);
            $event->setUser($this->getUser());

//            dd($event);

            $entityManager->persist($event);
            $entityManager->flush();
        }

        return $this->render('add_event/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

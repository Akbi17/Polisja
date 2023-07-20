<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NieruchomoscController extends AbstractController
{
    public function __construct( public ManagerRegistry $doctrine)
    {}

    #[Route('/nieruchomosc', name: 'app_nieruchomosc')]
    public function index(Request $request): Response
    {
        $entityManager = $this->doctrine->getManager();
        $property = new Property;
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $property->setTypeOfHouse($form->get('typeOfHouse')->getData());
            $property->setResidentialArea($form->get('residentialArea')->getData());
            $property->setName($form->get('name')->getData());
            $property->setPhone($form->get('phone')->getData());
            $property->setMail($form->get('mail')->getData());
            $property->setPlace($form->get('place')->getData());
            $entityManager->persist($property);
            $entityManager->flush();
            $this->addFlash('success','Your message has been sent successfully.');

            return $this->redirectToRoute('app_nieruchomosc');
        }
        return $this->render('frontend/nieruchomosc/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

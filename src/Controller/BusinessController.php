<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Business;
use App\Form\BusinessType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BusinessController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/biznes', name: 'app_business')]
    public function index(Request $request): Response
    {
        $business      = new Business();
        $form          = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $business->setNameOfBusiness($form->get('nameOfBusiness')->getData());
            $business->setName($form->get('name')->getData());
            $business->setPhone($form->get('phone')->getData());
            $business->setMail($form->get('mail')->getData());
            $business->setPlace($form->get('place')->getData());
            $this->entityManager->persist($business);
            $this->entityManager->flush();
            $this->addFlash('success', 'Twoje zgłoszenie zostało wysłane. Wkrótce odpowiemy!');

            return $this->redirectToRoute('app_business');
        }

        return $this->render('frontend/business/index.html.twig', [
            'controller_name' => 'BusinessController',
            'form' => $form->createView(),
        ]);
    }
}

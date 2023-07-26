<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Auto;
use App\Form\AutoType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutoController extends AbstractController
{
    #[Route('/auto', name: 'app_auto')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $auto = new Auto;
        $form = $this->createForm(AutoType::class, $auto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($auto);
            $entityManager->flush();
            $this->addFlash('success', 'Your message has been sent successfully.');
            $this->addFlash('error', 'There was an error processing the form. Please try again.');

            return $this->redirectToRoute('app_auto');
        }
        return $this->render('frontend/auto/index.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}

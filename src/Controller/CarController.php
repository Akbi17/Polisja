<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Auto;
use App\Form\AutoType;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/auto', name: 'app_car')]
    public function index(Request $request, ManagerRegistry $doctrine, WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        if(!$webPageAdmin->getCarStatus()->getValue())
        {
            return $this->redirectToRoute('app_main');
        }
        $entityManager = $doctrine->getManager();
        $auto = new Auto;
        $form = $this->createForm(AutoType::class, $auto);
        $form->handleRequest($request);
    try {
        if ($form->isSubmitted() && $form->isValid()) 
        {  
            $entityManager->persist($auto);
            $entityManager->flush();
            $this->addFlash('success', 'Your message has been sent successfully.');
            $this->addFlash('error', 'There was an error processing the form. Please try again.');

            return $this->redirectToRoute('app_car');
        }
    } catch(Exception $e) {
        $form->addError(new FormError('Błąd przy formularzu'));
    }
        $activepages = $webPageAdmin->ActivePages();
        $enum = $enumValue->getEnumValues();
        
        return $this->render('frontend/car/index.html.twig', [
            'form'=>$form->createView(),
            'activepages'=>$activepages,
            'enum' => $enum,
        ]);
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Property;
use App\Form\PropertyType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    public function __construct( public ManagerRegistry $doctrine){}

    #[Route('/nieruchomosc', name: 'app_property')]
    public function index(Request $request,WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        if(!$webPageAdmin->getPropertyStatus()->getValue())
        {
            return $this->redirectToRoute('app_main');
        }
        $entityManager = $this->doctrine->getManager();
        $property = new Property;
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager->persist($property);
            $entityManager->flush();
            $this->addFlash('success','Your message has been sent successfully.');
        
            return $this->redirectToRoute('app_property');
        }
        $webPageStatus = $webPageAdmin->getWebPageStatus();
        $enum = $enumValue->getEnumValues();
        return $this->render('frontend/property/index.html.twig', [
            'form' => $form->createView(),
            'webPageStatus' => $webPageStatus,
            'enum' => $enum,
        ]);
    }
}

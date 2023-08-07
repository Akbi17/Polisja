<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Business;
use App\Form\BiznesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BusinessController extends AbstractController
{
    public function __construct( public ManagerRegistry $doctrine)
    {}

    #[Route('/biznes', name: 'app_business')]
    public function index(Request $request, WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {   
        if(!$webPageAdmin->getBusinessStatus()->getValue()){
            return $this->redirectToRoute('app_main');
        }
        $entityManager = $this->doctrine->getManager();
        $business = new Business();
        $form = $this->createForm(BiznesType::class, $business);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $business->setNameOfBusiness($form->get('nameOfBusiness')->getData());
            $business->setName($form->get('name')->getData());
            $business->setPhone($form->get('phone')->getData());
            $business->setMail($form->get('mail')->getData());
            $business->setPlace($form->get('place')->getData());
            $entityManager->persist($business);
            $entityManager->flush();
            $this->addFlash('success','Your message has been sent successfully.');

            return $this->redirectToRoute('app_business');
        }
        $webPageStatus = $webPageAdmin->getWebPageStatus();
        $enum = $enumValue->getEnumValues();

        return $this->render('frontend/business/index.html.twig', [
            'form' => $form->createView(),
            'webPageStatus'=>$webPageStatus,
            'enum' => $enum,
        ]);
    }
}

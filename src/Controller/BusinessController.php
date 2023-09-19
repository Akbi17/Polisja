<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Business;
use App\Form\BusinessType;
use App\Enum\Enum;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
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
        $form = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);
    try {
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $business->setCompanyName($form->get('companyName')->getData());
            $business->setName($form->get('name')->getData());
            $business->setPhone($form->get('phone')->getData());
            $business->setMail($form->get('mail')->getData());
            $business->setPlace($form->get('place')->getData());
            $entityManager->persist($business);
            $entityManager->flush();
            $this->addFlash('success','Your message has been sent successfully.');

            return $this->redirectToRoute('app_business');
        }
    } catch(Exception $e) {
        $form->addError(new FormError('Błąd przy formularzu'));
    }
        $activepages = $webPageAdmin->ActivePages();
        $enum = $enumValue->getEnumValues();
        $phone = $webPageAdmin->getContactPhone();
        $mail = $webPageAdmin->getContactEmail();

        return $this->render('frontend/business/index.html.twig', [
            'form' => $form->createView(),
            'activepages'=>$activepages,
            'enum' => $enum,
            'phone' => $phone,
            'mail' => $mail,
        ]);
    }
}

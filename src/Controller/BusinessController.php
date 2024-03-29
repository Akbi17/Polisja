<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Business;
use App\Form\BusinessType;
use App\Enum\Enum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BusinessController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/biznes', name: 'app_business')]
    public function index(Request $request, WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        if (!$webPageAdmin->getBusinessStatus()->getValue())
        {
            return $this->redirectToRoute('app_main');
        }
        $business      = new Business();
        $form          = $this->createForm(BusinessType::class, $business);
        $form->handleRequest($request);
    try {
        if ($form->isSubmitted() && $form->isValid()) {
            $business->setCompanyName($form->get('companyName')->getData());
            $business->setName($form->get('name')->getData());
            $business->setPhone($form->get('phone')->getData());
            $business->setMail($form->get('mail')->getData());
            $business->setPlace($form->get('place')->getData());
            $this->entityManager->persist($business);
            $this->entityManager->flush();
            $this->addFlash('success', 'Twoje zgłoszenie zostało wysłane. Wkrótce odpowiemy!');

            return $this->redirectToRoute('app_business');
        }
    } catch(Exception $e) {
        $form->addError(new FormError('Błąd przy formularzu'));
    }
        $activepages = $webPageAdmin->ActivePages();
        $enum = $enumValue->getEnumValues();
        $phone = $webPageAdmin->getContactPhone()->getValue();
        $mail = $webPageAdmin->getContactEmail()->getValue();

        return $this->render('frontend/business.html.twig', [
            'form' => $form->createView(),
            'activepages'=>$activepages,
            'enum' => $enum,
            'phone' => $phone,
            'mail' => $mail,
        ]);
    }
}

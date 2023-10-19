<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Enum\Enum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/nieruchomosc', name: 'app_property')]
    public function index(Request $request, WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        if(!$webPageAdmin->getPropertyStatus()->getValue())
        {
            return $this->redirectToRoute('app_main');
        }
        $property      = new Property;
        $form          = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
    try {
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($property);
            $this->entityManager->flush();
            $this->addFlash('success', 'Twoje zgłoszenie zostało wysłane. Wkrótce odpowiemy!');
            
            return $this->redirectToRoute('app_property');
        }
    } catch(Exception $e) {
        $form->addError(new FormError('Błąd przy formularzu'));
    }
        $activepages = $webPageAdmin->ActivePages();
        $enum        = $enumValue->getEnumValues();
        $phone       = $webPageAdmin->getContactPhone()->getValue();
        $mail        = $webPageAdmin->getContactEmail()->getValue();

        return $this->render('frontend/property/index.html.twig', [
            'form' => $form->createView(),
            'activepages' => $activepages,
            'enum' => $enum,
            'phone' => $phone,
            'mail' => $mail,
        ]);
    }
}

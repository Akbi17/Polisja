<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Health;
use App\Form\HealthType;
use App\Enum\Enum;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/zycie', name: 'app_health')]
    public function index(Request $request,WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        if($webPageAdmin->ActivePages())
        {
            return $this->redirectToRoute('app_main');
        }
        $health        = new Health;
        $form          = $this->createForm(HealthType::class, $health);
        $form->handleRequest($request);
    try {
        if ($form->isSubmitted() && $form->isValid()) {
            $health->setName($form->get('name')->getData());
            $health->setPhone($form->get('phone')->getData());
            $health->setMail($form->get('mail')->getData());
            $health->setSurname($form->get('surname')->getData());
            $this->entityManager->persist($health);
            $this->entityManager->flush();
            $this->addFlash('success', 'Twoje zgłoszenie zostało wysłane. Wkrótce odpowiemy!');

            return $this->redirectToRoute('app_health');
        }
    } catch(Exception $e) {
        $form->addError(new FormError('Błąd przy formularzu'));
    }
        $activepages = $webPageAdmin->ActivePages();
        $enum = $enumValue->getEnumValues();
        $phone = $webPageAdmin->getContactPhone()->getValue();
        $mail = $webPageAdmin->getContactEmail()->getValue();

        return $this->render('frontend/health/index.html.twig', [
            'form' => $form->createView(),
            'activepages'=> $activepages,
            'enum' => $enum,
            'phone' => $phone,
            'mail' => $mail,
        ]);
    }
}

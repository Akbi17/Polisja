<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\Health;
use App\Form\HealthType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthController extends AbstractController
{
    public function __construct( public ManagerRegistry $doctrine)
    {}

    #[Route('/zycie', name: 'app_health')]
    public function index(Request $request,WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        if(!$webPageAdmin->getHealthStatus()->getValue())
        {
            return $this->redirectToRoute('app_main');
        }
        $entityManager = $this->doctrine->getManager();
        $health = new Health;
        $form = $this->createForm(HealthType::class, $health);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $health->setName($form->get('name')->getData());
            $health->setPhone($form->get('phone')->getData());
            $health->setMail($form->get('mail')->getData());
            $health->setSurname($form->get('surname')->getData());
            $entityManager->persist($health);
            $entityManager->flush();
            $this->addFlash('success','Your message has been sent successfully.');

            return $this->redirectToRoute('app_health');
        }
        $webPageStatus = $webPageAdmin->getWebPageStatus();
        $enum = $enumValue->getEnumValues();

        return $this->render('frontend/health/index.html.twig', [
            'form' => $form->createView(),
            'webPageStatus'=> $webPageStatus,
            'enum' => $enum,
        ]);
    }
}

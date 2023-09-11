<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Health;
use App\Form\HealthType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HealthController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/zycie', name: 'app_health')]
    public function index(Request $request): Response
    {
        $health        = new Health;
        $form          = $this->createForm(HealthType::class, $health);
        $form->handleRequest($request);
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

        return $this->render('frontend/health/index.html.twig', [
            'controller_name' => 'HealthController',
            'form' => $form->createView(),
        ]);
    }
}

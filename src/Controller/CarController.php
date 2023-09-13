<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/auto', name: 'app_car')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $auto = new Car;
        $form = $this->createForm(CarType::class, $auto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($auto);
            $entityManager->flush();
            $this->addFlash('success', 'Twoje zgłoszenie zostało wysłane. Wkrótce odpowiemy!');

            return $this->redirectToRoute('app_car');
        }
        return $this->render('frontend/car/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

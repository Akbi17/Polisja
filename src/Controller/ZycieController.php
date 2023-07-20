<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Health;
use App\Form\HealthType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZycieController extends AbstractController
{
    public function __construct( public ManagerRegistry $doctrine)
    {}

    #[Route('/zycie', name: 'app_zycie')]
    public function index(Request $request): Response
    {
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

            return $this->redirectToRoute('app_zycie');
        }
       
        return $this->render('frontend/zycie/index.html.twig', [
            'controller_name' => 'ZycieController',
            'form' => $form->createView(),
        ]);
    }
}

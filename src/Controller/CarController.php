<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Car;
use App\Block\WebPageAdmin;
use App\Form\CarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Enum\Enum;
use Exception;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/ubezpieczenia-samochodu', name: 'app_car')]
    public function index(Request $request, EntityManagerInterface $entityManager, Enum $enumValue, WebPageAdmin $webPageAdmin): Response
    {
        $auto = new Car;
        $form = $this->createForm(CarType::class, $auto);
        $form->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()) 
            {  
                $entityManager->persist($auto);
                $entityManager->flush();
                $this->addFlash('success', 'Your message has been sent successfully.');
    
                return $this->redirectToRoute('app_car');
            }
        } catch(Exception $e) {
            $form->addError(new FormError('Błąd przy formularzu'));
        }

            $activepages = $webPageAdmin->ActivePages();
            $enum = $enumValue->getEnumValues();
            $phone = $webPageAdmin->getContactPhone();
            $mail = $webPageAdmin->getContactEmail();

        return $this->render('frontend/car/index.html.twig', [
            'form' => $form->createView(),
            'activepages'=>$activepages,
            'enum' => $enum,
            'phone' => $phone,
            'mail' => $mail,
        ]);
    }
}

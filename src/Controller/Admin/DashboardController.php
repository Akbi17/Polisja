<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Admin;
use App\Entity\Contact;
use App\Entity\Business;
use App\Entity\Config;
use App\Entity\Health;
use App\Entity\Property;
use App\Form\ConfigType;
use App\Form\DataConfigType;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Exception;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class DashboardController extends AbstractDashboardController
{
    public function __construct(public ManagerRegistry $doctrine, private RequestStack $requestStack){}

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        $formConfigData = $this->createForm(DataConfigType::class);
        $formConfigData->handleRequest($request);
        $form = $this->createForm(ConfigType::class);
        $form->handleRequest($request);

        try {
            if ($form->isSubmitted() && $form->isValid()) {
                $webPageData = $form->getData();
                $Data = $formConfigData->getData();
                
                $entityManager = $this->doctrine->getManager();
                
                $existingWebPage = $entityManager->getRepository(Config::class)->findOneBy(['name' => $webPageData->getName()]);
                
                if ($existingWebPage) {
                    $existingWebPage->setValue($webPageData->getValue());
                } else {
                    $existingWebPage = $Data;
                }

                $entityManager->persist($existingWebPage);
                $entityManager->flush();

                $this->addFlash('success', 'Zmiany zostały zapisane.');
                return $this->redirectToRoute('admin');
            }
            
            if ($formConfigData->isSubmitted() && $formConfigData->isValid()) {
                $Data = $formConfigData->getData();
                
                $entityManager = $this->doctrine->getManager();
                
                $existingWebPage = $entityManager->getRepository(Config::class)->findOneBy(['name' => $Data->getName()]);
                
                if ($existingWebPage) {
                    $existingWebPage->setValue($Data->getValue());
                } else {
                    $existingWebPage = $Data;
                }

                $entityManager->persist($existingWebPage);
                $entityManager->flush();

                $this->addFlash('success', 'Zmiany zostały zapisane.');
                return $this->redirectToRoute('admin');
            }
        } catch (Exception $e) {
            if ($form->isSubmitted()) {
                $form->addError(new FormError('Wystąpił błąd przy aktywacji strony'));
            } elseif ($formConfigData->isSubmitted()) {
                $formConfigData->addError(new FormError('Wystąpił błąd przy konfiguracji'));
            }
        }

        return $this->render('config/index.html.twig', [
            'form' => $form->createView(),
            'formConfigData' => $formConfigData->createView()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Polisja');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::linkToCrud('Admin', 'fa fa-person', Admin::class),
            MenuItem::linkToCrud('Auto', 'fa fa-car', Car::class),
            MenuItem::linkToCrud('Business', 'fa fa-wallet', Business::class),
            MenuItem::linkToCrud('Health', 'fa fa-heart', Health::class),
            MenuItem::linkToCrud('Property', 'fa fa-home', Property::class),    
            MenuItem::linkToCrud('Contact', 'fa fa-phone', Contact::class),    
            MenuItem::linkToCrud('Config', 'fa fa-key', Config::class),
        ];
    }
}

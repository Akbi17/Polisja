<?php


namespace App\Controller\Admin;
use App\Entity\Auto;
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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(public ManagerRegistry $doctrine ){}

    #[Route('/admin', name: 'admin')]
    public function inde(Request $request):Response
    {
        $formConfigData = $this->createForm(DataConfigType::class);
        $formConfigData->handleRequest($request);
        $form = $this->createForm(ConfigType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $webPageData = $form->getData();
            $webPageRepository = $this->doctrine->getRepository(Config::class);
            $existingWebPage = $webPageRepository->findOneBy(['name' => $webPageData->getName()]);
            if ($existingWebPage) {
                $existingWebPage->setValue($webPageData->getValue());
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($existingWebPage);
                $entityManager->flush();
            } else {
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($webPageData);
                $entityManager->flush();
            }
            $this->addFlash('success', 'Zmiany zostały zapisane.');

            return $this->redirectToRoute('admin');
        }
        if ($formConfigData->isSubmitted() && $formConfigData->isValid()) {
            $Data = $formConfigData->getData();
            $existingWebPage = $this->doctrine->getRepository(Config::class)->findOneBy(['name' => $Data->getName()]);
            if ($existingWebPage) {
                $existingWebPage->setValue($Data->getValue());
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($existingWebPage);
                $entityManager->flush();
            } else {
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($Data);
                $entityManager->flush();
            }
            $this->addFlash('success', 'Zmiany zostały zapisane.');

            return $this->redirectToRoute('admin');
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
            MenuItem::linkToCrud('Auto', 'fa fa-car',Auto::class),
            MenuItem::linkToCrud('Business', 'fa fa-home',Business::class),
            MenuItem::linkToCrud('Health', 'fa fa-heart',Health::class),
            MenuItem::linkToCrud('Property', 'fa fa-home',Property::class),    
            MenuItem::linkToCrud('Contact', 'fa fa-home',Contact::class),    
            MenuItem::linkToCrud('Config', 'fa fa-home',Config::class),    
        ];
    }
}

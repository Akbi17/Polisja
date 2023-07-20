<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Entity\Auto;
use App\Entity\Business;

use App\Entity\Health;
use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
        return $this->render('admin/index.html.twig');
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
            MenuItem::linkToRoute('WebPage', 'fa fa-car','admin_webPage' ),
            MenuItem::linkToCrud('Business', 'fa fa-home',Business::class),
            MenuItem::linkToCrud('Health', 'fa fa-heart',Health::class),
            MenuItem::linkToCrud('Property', 'fa fa-home',Property::class),
            
        ];
    }
}

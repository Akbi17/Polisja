<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//todo klasa stworzona ale nie używana?
class ConfigController extends AbstractController
{
    #[Route('/admin/config', name: 'admin_config')]
    public function adminConfig()
    {
        return $this->render('config/index.html.twig',[]);
    }
}


<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConfigController extends AbstractController
{
    public function __construct(public ManagerRegistry $doctrine )
    {}

    #[Route('/admin/config', name: 'admin_config')]
    public function adminConfig(Request $request)
    {
    }

}


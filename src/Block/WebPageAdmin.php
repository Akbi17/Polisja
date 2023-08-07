<?php
declare(strict_types=1);

namespace App\Block;

use App\Entity\Config;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebPageAdmin extends AbstractController
{
    public $entityManager;
    function __construct(public ManagerRegistry $doctrine) 
    {
        $this->entityManager = $this->doctrine->getManager();
    }

    public function getWebPageStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findAll();
    }

    public function getCarStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'page/car/isActive']);
    }

    public function getPropertyStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'page/property/isActive']);
    }

    public function getHealthStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'page/health/isActive']);
    }

    public function getBusinessStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'page/business/isActive']);
    }
    
    public function getContactStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'page/contact/isActive']);
    }
}
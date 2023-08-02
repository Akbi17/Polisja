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
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'Strona/Auto']);
    }

    public function getPropertyStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'Strona/Dom']);
    }

    public function getHealthStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'Strona/Życie']);
    }

    public function getBusinessStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'Strona/Biznes']);
    }
    
    public function getContactStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => 'Strona/Contact']);
    }
}
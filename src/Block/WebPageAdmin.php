<?php
declare(strict_types=1);

namespace App\Block;

use App\Entity\Config;
use App\Enum\Enum;
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

    public function ActivePages()
    {
        $pages = $this->getWebPageStatus();
    
        $activePages = [];
        
        foreach ($pages as $config) {
            $configName = $config->getName(); 
            $configValue = $config->getValue(); 
            
            if ($configName === Enum::CAR_PATH && $configValue) {
                $activePages[] = [
                    'label' => 'Samochody',
                    'path' => $this->generateUrl('app_car'),
                ];
            } elseif ($configName === Enum::PROPERTY_PATH && $configValue) {
                $activePages[] = [
                    'label' => 'Dom',
                    'path' => $this->generateUrl('app_property'),
                ];
            } elseif ($configName === Enum::HEALTH_PATH && $configValue) {
                $activePages[] = [
                    'label' => 'Zycie',
                    'path' => $this->generateUrl('app_health'),
                ];
            } elseif ($configName === Enum::BUSINESS_PATH && $configValue) {
                $activePages[] = [
                    'label' => 'Bizness',
                    'path' => $this->generateUrl('app_business'),
                ];
            } elseif ($configName === Enum::CONTACT_PATH && $configValue) {
                $activePages[] = [
                    'label' => 'Kontakt',
                    'path' => $this->generateUrl('contact'),
                ];
            }
        }
        
        return $activePages;
    }
}

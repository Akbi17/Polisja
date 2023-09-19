<?php
declare(strict_types=1);

namespace App\Block;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Config;
use App\Enum\Enum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebPageAdmin extends AbstractController
{
    function __construct(public EntityManagerInterface $entityManager)

    {
    }

    public function getWebPageStatus(): array
    {
        return $this->entityManager->getRepository(Config::class)->findAll();
    }

    public function getCarStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => Enum::CAR_PATH]);
    }

    public function getPropertyStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => Enum::PROPERTY_PATH]);
    }

    public function getHealthStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => Enum::HEALTH_PATH]);
    }

    public function getBusinessStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => Enum::BUSINESS_PATH]);
    }
    
    public function getContactStatus()
    {
        return $this->entityManager->getRepository(Config::class)->findOneBy(['name' => Enum::CONTACT_PATH]);
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

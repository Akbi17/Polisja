<?php
declare(strict_types=1);

namespace App\Block;

use App\Entity\WebPage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WebPageAdmin extends AbstractController
{
    function __construct(public EntityManagerInterface $entityManager)
    {
    }

    public function getWebPageStatus(): array
    {
        return $this->entityManager->getRepository(WebPage::class)->findAll(); 
    }
}
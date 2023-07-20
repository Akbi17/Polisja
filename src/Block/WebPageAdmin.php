<?php
declare(strict_types=1);

namespace App\Block;

use App\Entity\WebPage;
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
        return $this->entityManager->getRepository(WebPage::class)->findAll(); 
    }
}
<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(WebPageAdmin $webPageAdmin): Response
    {
        $webPageStatus = $webPageAdmin->getWebPageStatus();

        return $this->render('frontend/main/index.html.twig',[
           'webPageStatus'=>$webPageStatus
        ]);
    }
}

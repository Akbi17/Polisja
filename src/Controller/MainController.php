<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\Enum;
use App\Block\WebPageAdmin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        $activepages = $webPageAdmin->ActivePages();
        $enum = $enumValue->getEnumValues();
        $phone = $webPageAdmin->getContactPhone();
        $mail = $webPageAdmin->getContactEmail();

        return $this->render('frontend/main/index.html.twig',[
            'activepages'=>$activepages,
            'enum' => $enum,
            'phone' => $phone,
            'mail' => $mail,
        ]);
    }
}

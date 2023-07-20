<?php
declare(strict_types=1);

namespace App\Controller;

use App\Block\WebPageAdmin;
use App\Entity\WebPage;
use App\Form\WebPageType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminWebPageController extends AbstractController
{
    public function __construct(public ManagerRegistry $doctrine )
    {}

    #[Route('/admin/webPage', name: 'admin_webPage')]
    public function adminWebPage(Request $request, WebPageAdmin $webPageAdmin): Response
    {
        $form = $this->createForm(WebPageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $webPageData = $form->getData();
            $webPageRepository = $this->doctrine->getRepository(WebPage::class);
            $existingWebPage = $webPageRepository->findOneBy(['webPage' => $webPageData->getWebPage()]);

            if ($existingWebPage) {
                $existingWebPage->setStatus($webPageData->isStatus());
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($existingWebPage);
                $entityManager->flush();
            } else {
                $entityManager = $this->doctrine->getManager();
                $entityManager->persist($webPageData);
                $entityManager->flush();
            }
            $this->addFlash('success', 'Zmiany zostały zapisane.');

            return $this->redirectToRoute('admin');
        }
        $webPageStatus = $webPageAdmin->getWebPageStatus();
        return $this->render('config/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


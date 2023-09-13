<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\WebPage;
use App\Form\WebPageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//todo nie wiem w ogóle co ta klasa ma niby robić - podejrzewam że to do wywalenia
class AdminWebPageController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/admin/webPage', name: 'admin_webPage')]
    public function adminWebPage(Request $request): Response
    {
        $form = $this->createForm(WebPageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $webPageData       = $form->getData();
            $webPageRepository = $this->entityManager->getRepository(WebPage::class);
            $existingWebPage   = $webPageRepository->findOneBy(['webPage' => $webPageData->getWebPage()]);

            if ($existingWebPage) {
                $existingWebPage->setStatus($webPageData->isStatus());
                $this->entityManager->persist($existingWebPage);
                $this->entityManager->flush();
            } else {
                $this->entityManager->persist($webPageData);
                $this->entityManager->flush();
            }
            $this->addFlash('success', 'Zmiany zostały zapisane.');

            return $this->redirectToRoute('admin');
        }

        return $this->render('config/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


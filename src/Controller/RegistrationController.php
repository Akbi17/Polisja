<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\WebPage;
use App\Form\RegistrationFormType;
use App\Form\WebPageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

// todo tutaj jeszcze coś z tym web page szambo jakieś
class RegistrationController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response
    {

        $webPageConfigForm = $this->createForm(WebPageType::class);
        $webPageConfigForm->handleRequest($request);
        $user = new Admin();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_ADMIN']);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Rejestracja admina zakończona pomyślnie!');
            return $this->redirectToRoute('app_login');
        }

        if ($webPageConfigForm->isSubmitted() && $webPageConfigForm->isValid()) {
            $webPageData       = $webPageConfigForm->getData();
            $webPageRepository = $entityManager->getRepository(WebPage::class);
            $existingWebPage   = $webPageRepository->findOneBy(['webPage' => $webPageData->getWebPage()]);

            if ($existingWebPage) {
                $existingWebPage->setStatus($webPageData->isStatus());
                $entityManager->persist($existingWebPage);
                $entityManager->flush();
            } else {
                $entityManager->persist($webPageData);
                $entityManager->flush();
            }

            $this->addFlash('success', 'Zmiany zostały zapisane.');
        }

        return $this->render('admin/install.html.twig', [
            'form' => $form->createView(),
            'webPageConfigForm' => $webPageConfigForm->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\WebPage;
use App\Form\RegistrationFormType;
use App\Form\WebPageType;
use App\Block\WebPageAdmin;
use App\Security\AdminCustomAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    public function __construct(public ManagerRegistry $doctrine)
    {}
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, WebPageAdmin $webPageAdmin, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AdminCustomAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
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
        $webPageData = $webPageConfigForm->getData();
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
        $this->addFlash('success', 'Status strony został zapisany.');
    }

    return $this->render('admin/install.html.twig', [
        'form' => $form->createView(),
        'webPageConfigForm' => $webPageConfigForm->createView(),
    ]);
}
}

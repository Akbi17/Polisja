<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\WebPage;
use App\Form\InstallFormType;
use App\Form\ConfigType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class InstallController extends AbstractController
{
    public function __construct(public ManagerRegistry $doctrine){}

    #[Route('/install', name: 'app_install')]
    public function install(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {    
        $adminRepository = $this->doctrine->getRepository(Admin::class);
        $admins = $adminRepository->findAll();
        if (count($admins) >= 1) 
        {
            return $this->redirectToRoute('app_login');
        }
        $webPageConfigForm = $this->createForm(ConfigType::class);
        $webPageConfigForm->handleRequest($request);
        $user = new Admin();
        $form = $this->createForm(InstallFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {       
            $user->setPassword($userPasswordHasher->hashPassword($user,$form->get('plainPassword')->getData()));
            $user->setRoles(['ROLE_ADMIN']);
            $entityManager->persist($user);
            $entityManager->flush();       
            $this->addFlash('success', 'Rejestracja admina zakończona pomyślnie!');

            return $this->redirectToRoute('app_login');
        }  
    if ($webPageConfigForm->isSubmitted() && $webPageConfigForm->isValid()) {
        $webPageData = $webPageConfigForm->getData();
        $webPageRepository = $this->doctrine->getRepository(Config::class);
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

<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\WebPage;
use App\Entity\Config;
use App\Enum\Enum;
use App\Form\InstallFormType;
use App\Form\ConfigType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormError;

class InstallController extends AbstractController
{
    public function __construct(public ManagerRegistry $doctrine)
    {
    }

    #[Route('/install', name: 'app_install')]
    public function install(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $adminRepository = $this->doctrine->getRepository(Admin::class);
        $admins          = $adminRepository->findAll();
        if (count($admins)) {
            return $this->redirectToRoute('app_login');
        }

        $user = new Admin();
        $form = $this->createForm(InstallFormType::class, $user);
        $form->handleRequest($request);
        try {
            if ($form->isSubmitted() && $form->isValid()) {
                $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));
                $user->setRoles(['ROLE_ADMIN']);

                $sectionKeys      = Enum::getPagesValue();
                $configRepository = $entityManager->getRepository(Config::class);
                foreach ($sectionKeys as $sectionKey) {
                    $existingConfig = $configRepository->findOneBy(['name' => $sectionKey]);

                    if (!$existingConfig) {
                        $newConfig = new Config();
                        $newConfig->setName($sectionKey);
                        $newConfig->setValue('1');
                        $entityManager->persist($newConfig);
                        $entityManager->flush();
                    }
                }
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Rejestracja admina zakończona pomyślnie!');

                return $this->redirectToRoute('app_login');
            }
        } catch (\Exception $e) {
            $form->addError(new FormError('Wystąpił błąd podczas rejestracji admina.'));
        }

        return $this->render('admin/install.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}

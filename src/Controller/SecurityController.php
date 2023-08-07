<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Admin;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator){}

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, ManagerRegistry $entityManger): Response
    {
        if($authenticationUtils->getLastUsername())
        {
            return new RedirectResponse($this->urlGenerator->generate('admin'));
        }
        $adminRepository = $entityManger->getRepository(Admin::class);
        $admins = $adminRepository->findAll();
        if (count($admins) == 0) 
        {
            return $this->redirectToRoute('app_install');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

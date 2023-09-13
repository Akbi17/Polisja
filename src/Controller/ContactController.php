<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\Enum;
use App\Block\WebPageAdmin;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Block\TraitForTextCheck;
use Exception;
use Symfony\Component\Form\FormError;

class ContactController extends AbstractController
{
    use TraitForTextCheck;
    public function __construct( public ManagerRegistry $doctrine){}

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, ManagerRegistry $doctrine, TransportInterface $mailer, WebPageAdmin $webPageAdmin, Enum $enumValue): Response
    {
        if(!$webPageAdmin->getContactStatus()->getValue())
        {
            return $this->redirectToRoute('app_main');
        }
        $entityManager = $doctrine->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
    try {
        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setName($form->get('name')->getData());
            $contact->setEmail($form->get('email')->getData());
            $contact->setSubject($form->get('subject')->getData());
            $this->TextCheckAndGet($form, $contact);
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('polisja.oilisja@com') 
                ->subject($contact->getSubject()) 
                ->text($contact->getMessage());
            $mailer->send($email);
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'Your message has been sent successfully.');

            return $this->redirectToRoute('contact');
        }
    } catch(Exception $e) {
        $form->addError(new FormError('Błąd przy formularzu'));
    }
        $activepages = $webPageAdmin->Activepages();
        $enum = $enumValue->getEnumValues();

        return $this->render('frontend/contact/index.html.twig', [
            'form' => $form->createView(),
            'activepages'=> $activepages,
            'enum' => $enum
        ]);
    }   
    
}

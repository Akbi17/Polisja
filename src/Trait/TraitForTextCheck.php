<?php
declare(strict_types=1);

namespace App\Trait;

use App\Entity\Contact;
use Symfony\Component\Form\FormInterface as FormFormInterface;

trait TraitForTextCheck 
{
    protected function TextCheckAndGet(FormFormInterface $form, Contact $contact): void
    {
        $message = $form->get('message')->getData();
        $message = filter_var($message, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        $contact->setMessage($message);
    }
}
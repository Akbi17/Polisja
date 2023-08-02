<?php
declare(strict_types=1);

namespace App\Form;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email', EmailType::class)
            ->add('subject',TextType::class)
            ->add('message',TextareaType::class,[
                'label' => 'Message',
                'attr' => ['class' => 'form-control', 'placeholder' =>'Type Your Message Here'],
                'constraints' => [
                    new NotBlank(['message' =>'Message is required.']),
                    new Regex([
                        'message' => 'Message cannot contain special characters.',
                        'pattern' => '/^[^\n\r\t@#$%^&*()+=?<>{}[\]~\\\\]+$/',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Business;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BiznesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('companyName',TextType::class, [
                'label' => 'Nazwa Firmy',
                'required' => true,
            ])
            ->add('name',TextType::class, [
                'label' => 'Imię właściiela firmy',
                'required' => true,
            ])
            ->add('surname',TextType::class, [
                'label' => 'Nazwisko właściciela',
                'required' => true,
            ])
            ->add('phone',TelType::class, [
                'label' => 'Numer',
                'required' => true,
            ])
            ->add('mail',TextType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('place',TextType::class, [
                'label' => 'Adres',
                'required' => true,
            ])
            ->add('policystartdate',DateType::class, [
                'label' => 'Data początku polisy',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Wybierz datę',
                ],
            ])
            ->add('policyenddate',DateType::class, [
                'label' => 'Data konca polisy',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Wybierz datę',
                ],
            ])
            ->add('information',TextType::class, [
                'label' => 'Informacja dodatkowa',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Business::class,
        ]);
    }
}

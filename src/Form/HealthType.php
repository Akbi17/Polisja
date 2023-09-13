<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Health;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HealthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Imię',
                'required' => true,
            ])
            ->add('surname',TextType::class, [
                'label' => 'Nazwisko',
                'required' => true,
            ])
            ->add('mail',TextType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('phone',TelType::class, [
                'label' => 'Numer',
                'required' => true,
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Data Urodzenia',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Wybierz datę',
                ],
            ])
            ->add('gender',TextType::class, [
                'label' => 'Płeć',
                'required' => true,
            ])
            ->add('occupation',TextType::class, [
                'label' => 'Zawód',
                'required' => true,
            ])
            ->add('policyStartDate', DateType::class, [
                'label' => 'Dzień zaczęcia polisy',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Wybierz datę',
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Health::class,
        ]);
    }
}

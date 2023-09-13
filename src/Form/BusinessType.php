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

class BusinessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameOfBusiness', TextType::class, [
                'label' => 'Nazwa Firmy',
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'label' => 'Imię właściciela firmy',
                'required' => true,
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nazwisko właściciela',
                'required' => true,
            ])
            ->add('phone', TelType::class, [
                'label' => 'Numer',
                'required' => true,
            ])
            ->add('mail', TextType::class, [
                'label' => 'E-mail',
                'required' => true,
            ])
            ->add('place', TextType::class, [
                'label' => 'Adres',
                'required' => true,
            ])
            ->add('policyStartDate', DateType::class, [
                'label' => 'Data początku polisy',
                'required' => true,
            ])
            ->add('policyEndDate', DateType::class, [
                'label' => 'Data końca polisy',
                'required' => true,
            ])
            ->add('information', TextType::class, [
                'label' => 'Informacja dodatkowa',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Business::class,
        ]);
    }
}

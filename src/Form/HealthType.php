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
                'label' => 'Name',
                'required' => true,
            ])
            ->add('surname',TextType::class, [
                'label' => 'Surname',
                'required' => true,
            ])
            ->add('mail',TextType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('phone',TelType::class, [
                'label' => 'Phone',
                'required' => true,
            ])
            ->add('dateofbirth', DateType::class, [
                'label' => 'Date of Birth',
                'required' => true,
            ])
            ->add('gender',TextType::class, [
                'label' => 'Gender',
                'required' => true,
            ])
            ->add('occupation',TextType::class, [
                'label' => 'Occupation',
                'required' => true,
            ])
            ->add('policyStartDate',DateType::class, [
                'label' => 'Policy Start Date',
                'required' => true,
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

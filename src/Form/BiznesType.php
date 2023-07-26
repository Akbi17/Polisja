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
            ->add('nameOfBusiness',TextType::class, [
                'label' => 'Business Name',
                'required' => true,
            ])
            ->add('name',TextType::class, [
                'label' => 'The name of owner the business',
                'required' => true,
            ])
            ->add('surname',TextType::class, [
                'label' => 'Owner Surename',
                'required' => true,
            ])
            ->add('phone',TelType::class, [
                'label' => 'Phone',
                'required' => true,
            ])
            ->add('mail',TextType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('place',TextType::class, [
                'label' => 'Place',
                'required' => true,
            ])
            ->add('policystartdate',DateType::class, [
                'label' => 'Policy Start Date',
                'required' => true,
            ])
            ->add('policyenddate',DateType::class, [
                'label' => 'Policy End Date',
                'required' => true,
            ])
            ->add('information',TextType::class, [
                'label' => 'Additional Information',
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

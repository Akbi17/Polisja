<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeOfHouse', TextType::class, [
                'label' => 'Typ budynku',
                'required' => true,
            ])
            ->add('residentialArea', IntegerType::class, [
                'label' => 'Powierzchnia ( w metrach kwadratowych)',
                'required' => true,
            ])
            ->add('place', TextType::class, [
                'label' => 'Adress',
                'required' => true,
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'label' => 'Numer',
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'label' => 'Imię',
                'required' => true,
            ])
            ->add('yearbuilt', IntegerType::class, [
                'label' => 'Rok zabudowy budynku',
                'required' => true,
            ])
            ->add('policyStartDate', DateType::class, [
                'label' => 'Dzień zaczęcia polisy',
                'required' => true,
            ])
            ->add('constructiontype', TextType::class, [
                'label' => 'Z czego jest zbudowana budynek',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }   
}

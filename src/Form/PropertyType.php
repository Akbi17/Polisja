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
            ->add('houseType', TextType::class, [
                'label' => 'Typ budynku',
                'required' => true,
            ])
            ->add('residentialArea', IntegerType::class, [
                'label' => 'Powierzchnia ( w metrach kwadratowych)',
                'required' => true,
            ])
            ->add('place', TextType::class, [
                'label' => 'Adres',
                'required' => true,
            ])
            ->add('mail', TextType::class, [
                'label' => 'E-mail',
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
            ->add('yearBuilt', IntegerType::class, [
                'label' => 'Rok budowy nieruchomości',
                'required' => true,
            ])
            ->add('policyStartDate', DateType::class, [
                'label' => 'Dzień rozpoczęcia polisy',
                'required' => true,
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Wybierz datę',
                ],
            ])
            ->add('constructionType', TextType::class, [
                'label' => 'Z czego jest zbudowany budynek',
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

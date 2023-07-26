<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Property;
use App\Form\ChoicesType;
use Doctrine\DBAL\Types\DateTimeTzType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeOfHouse', TextType::class, [
                'label' => 'Type of House',
                'required' => true,
            ])
            ->add('residentialArea', IntegerType::class, [
                'label' => 'Residential Area (in square meters)',
                'required' => true,
            ])
            ->add('place', TextType::class, [
                'label' => 'Place',
                'required' => true,
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
            ])
            ->add('yearbuilt', IntegerType::class, [
                'label' => 'Year Built',
                'required' => true,
            ])
            ->add('policyStartDate', DateType::class, [
                'label' => 'Polica Start Date',
                'required' => true,
            ])
            ->add('constructiontype', TextType::class, [
                'label' => 'Construction Type',
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

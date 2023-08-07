<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Config;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', ChoiceType::class, [
                'choices' => [
                    'Auto' => 'page/car/isActive',
                    'Dom' => 'page/property/isActive',
                    'Życie' => 'page/health/isActive',
                    'Biznes' => 'page/business/isActive',
                    'Contact' => 'page/contact/isActive',
                ],
            ])
            ->add('value',ChoiceType::class,[
                'choices' => [
                    'Włącz' => true,
                    'Wyłącz' => false, 
                   
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Config::class,
        ]);
    }
}

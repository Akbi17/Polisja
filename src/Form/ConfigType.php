<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Config;
use App\Controller\Enum;
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
                    'Auto' => Enum::CAR_PATH,
                    'Dom' => Enum::PROPERTY_PATH,
                    'Życie' => Enum::HEALTH_PATH,
                    'Biznes' => Enum::BUSINESS_PATH,
                    'Contact' => Enum::CONTACT_PATH,
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

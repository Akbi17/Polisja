<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Config;
use App\Enum\Enum;
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
                    Enum::CAR => Enum::CAR_PATH,
                    Enum::PROPERTY => Enum::PROPERTY_PATH,
                    Enum::HEALTH => Enum::HEALTH_PATH,
                    Enum::BUSINESS => Enum::BUSINESS_PATH,
                    Enum::CONTACT => Enum::CONTACT_PATH,
                ],
            ])
            ->add('value',ChoiceType::class,[
                'choices' => [
                    Enum::TURN_ON => true,
                    Enum::TURN_OFF => false, 
                   
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

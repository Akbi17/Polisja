<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Config;
use App\Enum\Enum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


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
                'expanded' => true,

            ])
            ->add('value', ChoiceType::class, [
                'label' => 'Wybierz opcję',
                'choices' => [
                    Enum::TURN_ON => 1,
                    Enum::TURN_OFF => 0,
                ],
                'expanded' => true,
                'multiple' => false,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Config::class,
        ]);
    }
}

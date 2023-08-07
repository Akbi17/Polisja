<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Auto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class)
            ->add('lastname', TextType::class)
            ->add('email',EmailType::class)
            ->add('phone',TelType::class)
            ->add('carmake',TextType::class)
            ->add('carmodel',TextType::class)
            ->add('caryear', NumberType::class)
            ->add('coveragetype',ChoiceType::class,[
                'choices' => [
                    'Comprehensive' => 'comprehensive',
                    'Third Party' => 'third_party',
                ],
                'placeholder' => 'Select coverage type',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auto::class,
        ]);
    }
}

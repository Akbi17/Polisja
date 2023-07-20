<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Property;
use App\Form\ChoicesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeOfHouse')
            ->add('residentialArea')
            ->add('place',EntityType::class,[
                'class' => Property::class,
                'choice_label' => 'typeOfHouse',
                ])
            ->add('mail',EmailType::class)
            ->add('phone',TelType::class)
            ->add('name')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

    
}

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
                    'Auto' => 'Strona/Auto',
                    'Dom' => 'Strona/Dom',
                    'Życie' => 'Strona/Życie',
                    'Biznes' => 'Strona/Biznes',
                    'Contact' => 'Strona/Contact',
                ],
            ])
            ->add('value',ChoiceType::class,[
                'choices' => [
                    'Active' => 'Active',
                    'Disactive' => 'Disactive', 
                   
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

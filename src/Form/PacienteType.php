<?php

namespace App\Form;

use App\Entity\Paciente;
use App\Entity\Tratamiento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//https://symfony.com/doc/current/reference/forms/types/entity.html
class PacienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            
            /*
            ->add('tratamientos',CollectionType::class, [
                // each entry in the array will be an "email" field
                'entry_type' => CheckboxType::class,
            ])*/
            ->add('tratamientos',EntityType::class, [
                // looks for choices from this entity
                'class' => Tratamiento::class,
            
                // uses the User.username property as the visible option string
               // 'choice_label' => 'Tratamiento',
            
                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paciente::class,
        ]);
    }
}

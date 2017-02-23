<?php

namespace AUCBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class JugadorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('apellidos', TextType::class)
            ->add('posicion', ChoiceType::class, array(
                  'choices' => array(
                    'Portero' => 'Portero' ,
                    'Central' => 'Central' ,
                    'Lateral Izquierdo' => 'Lateral Izquierdo' ,
                    'Lateral Derecho' => 'Lateral Derecho' ,
                    'Medio Centro' => 'Medio Centro' ,
                    'Media Punta' => 'Media Punta' ,
                    'Extremo' => 'Extremo' ,
                    'Delantero' => 'Delantero' ,
                   ),))
            ->add('equipo', EntityType::class, array(
                // query choices from this entity
                'class' => 'AUCBundle:Equipo',
                // use the User.username property as the visible option string
                'choice_label' => 'nombre'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AUCBundle\Entity\Jugador'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'aucbundle_jugador';
    }


}

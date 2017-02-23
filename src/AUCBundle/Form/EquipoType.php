<?php

namespace AUCBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EquipoType extends AbstractType
{
  /**
  * {@inheritdoc}
  */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('nombre', TextType::class)
    ->add('imagen', TextareaType::class)
    ->add('entrenador',EntityType::class, array(
            // query choices from this entity
            'class' => 'AUCBundle:Entrenador',
            // use the User.username property as the visible option string
            'choice_label' => 'nombre',
            'multiple'=>true
          )
          );
  }

  /**
  * {@inheritdoc}
  */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'AUCBundle\Entity\Equipo'
    ));
  }

  /**
  * {@inheritdoc}
  */
  public function getBlockPrefix()
  {
    return 'aucbundle_equipo';
  }


}

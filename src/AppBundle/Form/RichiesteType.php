<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RichiesteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('codice')->add('descrizione')->add('dataRichiesta')
//            ->add('idPaziente')
        ->add('idPaziente', EntityType::class, array(
            // query choices from this entity
            'class' => 'AppBundle:Pazienti',

            // use the User.username property as the visible option string
            'choice_label' => 'getNominativo'

            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Richieste'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_richieste';
    }


}

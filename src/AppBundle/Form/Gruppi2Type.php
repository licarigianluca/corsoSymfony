<?php

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;


class Gruppi2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('elencoPersone', Select2EntityType::class, [
//                'mapped' =>false,
                'multiple' => true,
                'remote_route' => 'select2_persone',
                'class' => 'AppBundle\Entity\Persone',
                'primary_key' => 'id',
                'text_property' => 'cognome',
                'minimum_input_length' => 2,
                'page_limit' => 10,
                'allow_clear' => true,
                'delay' => 250,
                'cache' => true,
                'cache_timeout' => 60000, // if 'cache' is true
                'language' => 'en',
                'placeholder' => '',
                // 'em' => $entityManager, // inject a custom entity manager
            ])
            ->add('descrizione', TextType::class, array(
                'label' => 'Descrizione del gruppo',
                'constraints' => new NotNull(array('message' => ' descrizione obbligatorio'))

            ))

//            ->add('elencoStudenti', CollectionType::class, array(
//                'entry_type' => Studenti2NestedType::class,
//                'allow_add' => true,
//                'allow_delete' => true,
//                'by_reference' => false
//            ))

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Gruppi'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_gruppi';
    }


}

<?php

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;


class StudentiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idClasse', Select2EntityType::class, [
                'multiple' => false,
                'remote_route' => 'select2_classi',
                'class' => 'AppBundle\Entity\Classi',
                'primary_key' => 'id',
                'text_property' => 'nome',
                'minimum_input_length' => 2,
                'page_limit' => 10,
                'allow_clear' => true,
                'delay' => 250,
                'cache' => true,
                'cache_timeout' => 60000, // if 'cache' is true
                'language' => 'en',
                'placeholder' => 'Seleziona una classe',
                // 'em' => $entityManager, // inject a custom entity manager
            ])

            ->add('nome')
            ->add('cognome')
            ->add('matricola')
            ->add('dataNascita', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Data Nascita',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => array(
                    'class' => 'date',
                    'value' => (new \DateTime('now'))->format('d/m/Y')
                ),
                'constraints' => new NotNull(array('message' => 'campo obbligatorio'))
            ))
            ->add('codiceFiscale')
            ->add('email', TextType::class, array(
                'label' => 'email',
                'constraints' => new Regex(
                    array(

                        'message' => "l'indirizzo '{{ value }}' non è un indirizzo email valido.",
                        'pattern' => '/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/'
                    )
                )))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Studenti'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_studenti';
    }


}

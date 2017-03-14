<?php

namespace AppBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Regex;


class PersoneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome')
            ->add('cognome')
            ->add('dataNascita', DateType::class, array(
                'input' => 'datetime',
                'widget' => 'single_text',
                'label' => 'Data Nascita',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => array(
                    'class' => 'date',
                    'value' => (new \DateTime('now'))->modify('+2 year')->format('d/m/Y')
                ),
                'constraints' => new NotNull(array('message' => 'campo obbligatorio'))
            ))
            ->add('codiceFiscale')
            ->add('email', TextType::class, array(
                'label' =>'email',
                'constraints' => new Regex(
                array(

                    'message' => "l'indirizzo '{{ value }}' non è un indirizzo email valido.",
                    'pattern' => '/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/'
                )
            )));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Persone'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_persone';
    }


}

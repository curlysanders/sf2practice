<?php

namespace Dopee\WebsiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Naam', 'text', array(
            'attr' => array(
                'placeholder' => 'Hoe heet je?',
                'pattern'     => '.{2,}' //minlength
            )
        ))
            ->add('E-mailadres', 'email', array(
            'attr' => array(
                'placeholder' => 'Wat is je e-mailadres?'
            )
        ))
            ->add('Onderwerp', 'text', array(
            'attr' => array(
                'placeholder' => 'Het onderwerp van je bericht.',
                'pattern'     => '.{3,}' //minlength
            )
        ))
            ->add('Bericht', 'textarea', array(
            'attr' => array(
                'cols' => 90,
                'rows' => 10,
                'placeholder' => 'Vul hier je bericht in...'
            )
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(array(
            'Naam' => array(
                new NotBlank(array('message' => 'Dit veld is verplicht')),
                new Length(array('min' => 2))
            ),
            'E-mailadres' => array(
                new NotBlank(array('message' => 'Dit veld is verplicht')),
                new Email(array('message' => 'Ongeldig e-mailadres'))
            ),
            'Onderwerp' => array(
                new NotBlank(array('message' => 'Dit veld is verplicht')),
                new Length(array('min' => 3))
            ),
            'Bericht' => array(
                new NotBlank(array('message' => 'Dit veld is verplicht')),
                new Length(array('min' => 5))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName()
    {
        return 'contact';
    }

}

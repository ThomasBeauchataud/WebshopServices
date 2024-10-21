<?php

namespace TBCD\Webshop\Form;

use TBCD\Webshop\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'First name',
                    'ariaLabel' => 'First name'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Last name',
                    'ariaLabel' => 'Last name'
                ]
            ])
            ->add('street', TextType::class, [
                'attr' => [
                    'placeholder' => 'Street',
                    'ariaLabel' =>  'Street'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' =>  'City',
                    'ariaLabel' =>  'City'
                ]
            ])
            ->add('country', TextType::class, [
                'attr' => [
                    'placeholder' => 'Country',
                    'ariaLabel' => 'Country'
                ]
            ])
            ->add('zipCode', TextType::class, [
                'attr' => [
                    'placeholder' => 'Zip code',
                    'ariaLabel' => 'Zip code'
                ]
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class
        ]);
    }
}
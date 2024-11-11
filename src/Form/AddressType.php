<?php

namespace TBCD\Webshop\Form;

use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Intl\Countries;
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
        $countryOptions = [
            'attr' => [
                'placeholder' => 'Country',
                'ariaLabel' => 'Country'
            ],
            'choices' => $options['countries'],
            'preferred_choices' => $options['preferred_countries'],
            'duplicate_preferred_choices' => true
        ];

        if (!empty($options['countries'])) {
            $countryOptions['choice_loader'] = null;
        }

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
                    'ariaLabel' => 'Street'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'City',
                    'ariaLabel' => 'City'
                ]
            ])
            ->add('country', CountryType::class, $countryOptions)
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
            'data_class' => Address::class,
            'countries' => [],
            'preferred_countries' => []
        ]);
    }
}
<?php

namespace TBCD\Webshop\Form;

use TBCD\Webshop\Entity\ContactAddress;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactAddressType extends AddressType
{
    
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'ariaLabel' => 'Email'
                ]
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'placeholder' => 'Phone',
                    'ariaLabel' => 'Phone'
                ]
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => ContactAddress::class
        ]);
    }
}
<?php

namespace HK\AdminBundle\FormType;

use HK\CoreBundle\Master\MasterFormType;
use Symfony\Component\Form\FormBuilderInterface;
use HK\CoreBundle\Helper\FormHelper;
use HK\CoreBundle\Entity\Customer;
use HK\CoreBundle\Entity\CustomerProductWarranty;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CustomerType extends MasterFormType
{

    protected $entityClass = Customer::class;

    protected $isMultipart = true;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullName', TextType::class, [
            'label' => 'customer.full-name',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '1',
                FormHelper::$_VALIDATE_CLASS_REQUIRED . '-error' => 'customer.full-name-required',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('phoneNumber', TextType::class, [
            'label' => 'customer.phone-number',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('dateOfBirth', DateType::class, [
            'label' => 'customer.birthday',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS . ' ' . FormHelper::$_CLASS_DATETIME_PICKER,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID,
                'type' => 'date'
            ]
        ])->add('orderDate', DateType::class, [
            'label' => 'customer.order-date',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '1',
                FormHelper::$_VALIDATE_CLASS_REQUIRED . '-error' => 'customer.order-date-required',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID,
                'type' => 'date'
            ]
        ])->add('address', TextType::class, [
            'label' => 'customer.address',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('productModel', TextType::class, [
            'label' => 'customer.product-model',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('productSerial', TextType::class, [
            'label' => 'customer.product-serial',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '1',
                FormHelper::$_VALIDATE_CLASS_REQUIRED . '-error' => 'customer.product-serial-required',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('bodySerial', TextType::class, [
            'label' => 'customer.product-serial',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('gifSerial', TextType::class, [
            'label' => 'customer.gif-serial',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0',
                FormHelper::$_REF_CLASS => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('warranties', CollectionType::class, [
            'entry_type' => WarrantyType::class,
            'label' => 'customer.warranty',
            'allow_add' => true,
            'allow_delete' => true,
            'delete_empty' => true,
            'prototype' => true,
            'entry_options' => ['label' => false],
            'by_reference' => false
        ]);

        parent::buildForm($builder, $options);
    }
}

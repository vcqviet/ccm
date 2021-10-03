<?php

namespace HK\AdminBundle\FormType;

use Symfony\Component\Form\FormBuilderInterface;
use HK\CoreBundle\Helper\FormHelper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use HK\CoreBundle\Entity\CustomerProductWarranty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WarrantyType extends AbstractType
{
    protected $entityClass = CustomerProductWarranty::class;

    protected $isMultipart = true;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('editId', HiddenType::class, [
            'label' => 'lbl.form.edit-id',
            'attr' => [
                'class' => FormHelper::$_FORM_CLASS_EDIT_ID
            ]
        ])->add('warrantyDate', DateType::class, [
            'label' => 'warranty.date',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '1',
                FormHelper::$_VALIDATE_CLASS_REQUIRED . '-error' => 'warranty.date-required'
            ]
        ])->add('statusContent', TextareaType::class, [
            'label' => 'warranty.status-content',
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0',
                'row' => '5'
            ]
        ])->add('status', ChoiceType::class, [
            'label' => 'warranty.status',
            'choices' => [
                'Chờ bảo trì' => CustomerProductWarranty::$_STATUS_WAITING,
                'Xong' => CustomerProductWarranty::$_STATUS_DONE,
                'Hủy' => CustomerProductWarranty::$_STATUS_CANCEL
            ],
            'choice_attr' => [
                'Chờ bảo trì' => ['data-color' => 'Yellow'],
                'Xong' => ['data-color' => 'Green'],
                'Hủy' => ['data-color' => 'Red'],
            ],
            'attr' => [
                'class' => FormHelper::$_FORM_VALIDATE_CLASS,
                FormHelper::$_DATA_IS_MULTI_LANGUAGES => '0',
                FormHelper::$_VALIDATE_CLASS_REQUIRED => '0'
            ]
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // 'csrf_protection' => false,
            'data_class' => $this->entityClass
        ]);
    }
}

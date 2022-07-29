<?php

namespace HK\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HK\CoreBundle\Master\MasterController;
use HK\CoreBundle\Entity\Customer;
use HK\AdminBundle\FormType\CustomerType;
use HK\CoreBundle\Entity\CustomerProductWarranty;
use HK\CoreBundle\Helper\DateTimeHelper;
use HK\CoreBundle\Helper\FormHelper;
use Symfony\Component\BrowserKit\Request as BrowserKitRequest;
use Symfony\Component\VarDumper\VarDumper;

class CustomerController extends MasterController
{

    protected $entityClass = Customer::class;
    protected $entityTypeClass = CustomerType::class;
    protected $isIndexCustom = false;
    protected $isAddEditCustom = true;
    protected $icon = 'users';
    protected $isDisplayOrder = false;
    protected $isDisplayPublishedColumn = false;
    protected $hasContent = false;
    protected $hasPhotoModal = false;

    public function filterForm(Request $req): Response
    {
        if (!$this->isPermissionView()) {
            return $this->errorJson($this->trans('lbl.role.not-granted'));
        }
        $this->filterForm[] = [
            'name' => 'fkeyword',
            'type' => FormHelper::$_ELEMENT_TYPE_TEXT,
            'value' => '',
            'placeholder' => $this->trans('phd.filter.keyword'),
            'attr' => '',
            'class' => ''
        ];
        return $this->okJson($this->filterForm);
    }
    public function filter(Request $req): Response
    {
        if (!$this->isPermissionView()) {
            return $this->errorJson($this->trans('lbl.role.not-granted'));
        }
        $this->gridColumns = [
            [
                'name' => 'fullName',
                'text' => $this->trans('customer.full-name'),
                'width' => '250px',
                'is_content' => false,
                'is_filter' => true
            ],
            [
                'name' => 'dateOfBirth',
                'text' => $this->trans('customer.date-of-birth'),
                'width' => '250px',
                'is_content' => false,
                'is_filter' => false
            ],
            [
                'name' => 'productSerial',
                'text' => $this->trans('customer.product-serial'),
                'width' => '150px',
                'is_content' => false,
                'is_filter' => true
            ],
            [
                'name' => 'gifSerial',
                'text' => $this->trans('customer.gif-serial'),
                'width' => '150px',
                'is_content' => false,
                'is_filter' => true
            ],
            [
                'name' => 'phoneNumber',
                'text' => $this->trans('customer.phone-number'),
                'width' => '80px',
                'is_content' => false,
                'is_filter' => true
            ]
        ];

        $this->filterDefault($req);

        $this->gridData = $this->repository->bkGetData($this->dataFilter);
        $returnArr = [];
        /**
         * @var Customer $item
         */
        foreach ($this->gridData['items'] as $item) {
            // $item = new CmsRole();
            $returnArr[] = [
                'id' => $item->getId(),
                'isPublished' => $item->getIsPublished(),
                'createdAt' => DateTimeHelper::instance()->getDMY($item->getCreatedAt()),
                'updatedAt' => DateTimeHelper::instance()->getDMY($item->getUpdatedAt()),
                'updatedBy' => $item->getUpdatedBy(),


                'fullName' => $item->getFullName(),
                'productModel' => $item->getProductModel(),
                'productSerial' => $item->getProductSerial(),
                'gifSerial' => $item->getGifSerial(),
                'phoneNumber' => $item->getPhoneNumber(),
                'emailAddress' => $item->getEmailAddress(),
                'address' => $item->getAddress(),
                'dateOfBirth' => $item->getDateOfBirth()->format('d/m/Y')
            ];
        }
        $this->gridData['items'] = $returnArr;
        return parent::filter($req);
    }

    public function validateFormBefore(Request &$req)
    {
        $dataForm = $req->get($this->form->getName(), []);

        if (intval($dataForm['editId'] ?? -1) > 0) {
            $data = $this->getDoctrine()->getRepository(CustomerProductWarranty::class)->bkGetData(['customer_id']);
            foreach ($data as $dt) {
                $this->getDoctrine()->getRepository(CustomerProductWarranty::class)->delete($dt->getId());
            }
        }
        // if (isset($dataForm['dateOfBirth'])) {
        //     $dataForm['dateOfBirth'] = new \DateTime(DateTimeHelper::instance()->fromDMYToYMD($dataForm['dateOfBirth']));
        // }
        // if (isset($dataForm['orderDate'])) {
        //     $dataForm['orderDate'] = new \DateTime(DateTimeHelper::instance()->fromDMYToYMD($dataForm['orderDate']));
        // }
        $req->request->set($this->form->getName(), $dataForm);
        return parent::validateFormBefore($req);
    }
}

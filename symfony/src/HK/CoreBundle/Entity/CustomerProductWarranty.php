<?php

namespace HK\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use HK\CoreBundle\Master\MasterEntity;
use Google\Service\Monitoring\Custom;

/**
 * News
 *
 * @ORM\Table(name="hkcustomer_product_warranties")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="HK\CoreBundle\Repository\CustomerProductWarrantyRepository")
 *
 */
class CustomerProductWarranty extends MasterEntity
{
    /**
     *
     * @var Customer
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="warranties", cascade={"persist"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
    /**
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $customerId;

    /**
     *
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $statusContent;

    public function getStatusContent(): ?string
    {
        return $this->statusContent;
    }

    public function setStatusContent($val)
    {
        $this->statusContent = $val;
    }

    /**
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $warrantyDate;

    public function getWarrantyDate(): ?\DateTime
    {
        return $this->warrantyDate;
    }

    public function setWarrantyDate(?\DateTime $val)
    {
        $this->warrantyDate = $val;
    }

    public function __construct()
    {
        parent::__construct();
    }
}

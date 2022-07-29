<?php

namespace HK\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use HK\CoreBundle\Master\MasterEntity;

/**
 * Customer
 *
 * @ORM\Table(name="hkcustomers")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="HK\CoreBundle\Repository\CustomerRepository")
 *
 */
class Customer extends MasterEntity
{


    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private ?string $emailAddress;

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress ?? '';
    }

    public function setEmailAddress(?string $val)
    {
        $this->emailAddress = $val;
    }

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private ?string $bodySerial;

    public function getBodySerial(): ?string
    {
        return $this->bodySerial ?? '';
    }

    public function setBodySerial(?string $val)
    {
        $this->bodySerial = $val;
    }

    /**
     * @ORM\Column(type="string", nullable=true, length=512)
     */
    private ?string $address;

    public function getAddress(): ?string
    {
        return $this->address ?? '';
    }

    public function setAddress(?string $val)
    {
        $this->address = $val;
    }


    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private ?string $phoneNumber;

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber ?? '';
    }

    public function setPhoneNumber(?string $val)
    {
        $this->phoneNumber = $val;
    }

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private ?string $fullName;

    public function getFullName(): ?string
    {
        return $this->fullName ?? '';
    }

    public function setFullName(?string $val)
    {
        $this->fullName = $val;
    }

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private ?string $productModel;

    public function getProductModel(): ?string
    {
        return $this->productModel ?? '';
    }

    public function setProductModel(?string $val)
    {
        $this->productModel = $val;
    }

    /**
     * @ORM\Column(type="string",nullable=true,  length=255)
     */
    private ?string $productSerial;

    public function getProductSerial(): ?string
    {
        return $this->productSerial ?? '';
    }

    public function setProductSerial(?string $val)
    {
        $this->productSerial = $val;
    }

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private ?string $gifSerial;

    public function getGifSerial(): ?string
    {
        return $this->gifSerial ?? '';
    }

    public function setGifSerial(?string $val)
    {
        $this->gifSerial = $val;
    }


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $dateOfBirth;

    public function getDateOfBirth(): ?\DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTime $val)
    {
        $this->dateOfBirth = $val;
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTime $orderDate;

    public function getOrderDate(): ?\DateTime
    {
        return $this->orderDate;
    }

    public function setOrderDate(?\DateTime $val)
    {
        $this->orderDate = $val;
    }

    /**
     * @var Collection | CustomerProductWarranty[]
     * 
     * @ORM\OneToMany(targetEntity="CustomerProductWarranty", mappedBy="customer", cascade={"persist"})
     */
    private $warranties;

    public function addWarranty(CustomerProductWarranty $entity)
    {
        $entity->setCustomer($this);
        $this->warranties[] = $entity;
    }

    public function removeWarranty(CustomerProductWarranty $entity)
    {
        $this->warranties->removeElement($entity);
    }

    function getWarranties()
    {
        return $this->warranties;
    }

    public function __construct()
    {
        parent::__construct();

        $this->warranties = new ArrayCollection();
    }
}

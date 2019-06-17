<?php

namespace Stanislavz\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use Stanislavz\Vendor\Model\ResourceModel\Vendor as VendorResource;

/**
 * Class Vendor
 * @package Stanislavz\Vendor\Model
 */
class Vendor extends AbstractModel implements VendorInterface
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DELETED = 'deleted';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_VACATION = 'vacation';
    public const STATUS_CANDIDATE = 'candidate';

    protected function _construct()
    {
        $this->_init(VendorResource::class);
    }

    /**
     * @param int|string $vendorId
     * @return Vendor
     */
    public function setId($vendorId): self
    {
        $this->setData('vendor_id', $vendorId);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getData('vendor_id');
    }

    /**
     * Gets the created-at timestamp for the vendor.
     *
     * @return string|null Created-at timestamp.
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData('created_at');
    }

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt): self
    {
        $this->setData('created_at', $createdAt);
        return $this;
    }

    /**
     * Get vendor name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData('name');
    }

    /**
     * @param string $name
     * @return Vendor
     */
    public function setName($name): self
    {
        $this->getData('name', $name);
        return $this;
    }

    /**
     * Get vendor description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->getData('description');
    }

    /**
     * @param string|null $description
     * @return Vendor
     */
    public function setDescription($description): self
    {
        $this->getData('description', $description);
        return $this;
    }

    /**
     * Get vendor logo
     *
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->getData('logo');
    }

    /**
     * @param string|null $logo
     * @return Vendor
     */
    public function setLogo($logo): self
    {
        $this->getData('logo', $logo);
        return $this;
    }

    /**
     * Get vendor additional data
     *
     * @return string|null
     */
    public function getAdditionalData(): ?string
    {
        return $this->getData('additional_data');
    }

    /**
     * @param string|null $additionalData
     * @return Vendor
     */
    public function setAdditionalData($additionalData): self
    {
        $this->getData('additional_data', $additionalData);
        return $this;
    }

    /**
     * Get vendor additional data
     *
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->getData('status');
    }

    /**
     * @param string $status
     * @return Vendor
     */
    public function setStatus($status): self
    {
        $this->getData('status', $status);
        return $this;
    }
}

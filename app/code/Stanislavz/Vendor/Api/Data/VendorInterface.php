<?php

namespace Stanislavz\Vendor\Api\Data;

/**
 * Interface VendorInterface
 * @package Stanislavz\Vendor\Api\Data
 */
interface VendorInterface
{
    /**
     * @param $vendorId
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     */
    public function setId($vendorId);

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param $createdAt
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param $name
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     */
    public function setName($name);

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     */
    public function setDescription($description);

    /**
     * @return string|null
     */
    public function getLogo(): ?string;

    /**
     * @param string $logo
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     */
    public function setLogo($logo);

    /**
     * @return string|null
     */
    public function getAdditionalData(): ?string;

    /**
     * @param string $additionalData
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     */
    public function setAdditionalData($additionalData);

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @param string $status
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     */
    public function setStatus($status);
}

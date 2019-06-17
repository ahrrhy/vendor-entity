<?php

namespace Stanislavz\Vendor\Model;

/**
 * Interface VendorInterface
 * @package Stanislavz\Vendor\Model
 */
interface VendorInterface
{
    /**
     * @param $vendorId
     * @return VendorInterface
     */
    public function setId($vendorId): self;

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
     * @return VendorInterface
     */
    public function setCreatedAt($createdAt): self;

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param $name
     * @return VendorInterface
     */
    public function setName($name): self;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     * @return VendorInterface
     */
    public function setDescription($description): self;

    /**
     * @return string|null
     */
    public function getLogo(): ?string;

    /**
     * @param string $logo
     * @return VendorInterface
     */
    public function setLogo($logo): self;

    /**
     * @return string|null
     */
    public function getAdditionalData(): ?string;

    /**
     * @param string $additionalData
     * @return VendorInterface
     */
    public function setAdditionalData($additionalData): self;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @param string $status
     * @return VendorInterface
     */
    public function setStatus($status): self;
}

<?php

namespace Stanislavz\VendorEntity\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface VendorInterface
 * @package Stanislavz\VendorEntity\Api\Data
 * @api
 */
interface VendorInterface extends CustomAttributesDataInterface
{
    public const NAME = 'name';

    public const DESCRIPTION = 'description';

    public const LOGO = 'logo';

    public const DATE_ADDED = 'date_added';

    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get category name
     *
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $name
     * @return $this
     */
    public function setDescription($description);

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}

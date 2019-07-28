<?php

namespace Stanislavz\Vendor\Api;

use Stanislavz\Vendor\Api\Data\VendorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * @todo need to adapt code to my vendor
 * Interface VendorRepositoryInterface
 * @package Stanislavz\Venor\Api
 * @api
 */
interface VendorRepositoryInterface
{
    /**
     * Save vendor.
     *
     * @param \Stanislavz\Vendor\Api\Data\VendorInterface $vendorInterface
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(VendorInterface $vendorInterface);

    /**
     * Retrieve vendor.
     *
     * @param int|string $vendorId
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($vendorId);

    /**
     * Retrieve vendor matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Stanislavz\Vendor\Api\Data\VendorSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete vendor.
     *
     * @param \Stanislavz\Vendor\Api\Data\VendorInterface $vendor
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(VendorInterface $vendor): bool;

    /**
     * Delete vendor by ID.
     *
     * @param int $vendorId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($vendorId): bool;
}

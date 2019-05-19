<?php

namespace Stanislavz\VendorEntity\Api;

/**
 * Interface VendorRepositoryInterface
 * @package Stanislavz\VendorEntity\Api
 * @api
 */
interface VendorRepositoryInterface
{
    /**
     * @param \Stanislavz\VendorEntity\Api\Data\VendorInterface $vendor
     * @return \Stanislavz\VendorEntity\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Stanislavz\VendorEntity\Api\Data\VendorInterface $vendor);

    /**
     * @param string $vendorId
     * @param int|null $storeId
     * @return \Stanislavz\VendorEntity\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($vendorId, $storeId = null);

    /**
     * @param \Stanislavz\VendorEntity\Api\Data\VendorInterface $vendor
     * @return bool
     * @throws \Magento\Framework\Exception\StateException
     */
    public function delete(\Stanislavz\VendorEntity\Api\Data\VendorInterface $vendor);

    /**
     * @param int|string $id
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Stanislavz\VendorEntity\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}

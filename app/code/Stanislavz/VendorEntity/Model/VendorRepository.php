<?php

namespace Stanislavz\VendorEntity\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;
use Stanislavz\VendorEntity\Api\Data\VendorSearchResultsInterfaceFactory;
use Stanislavz\VendorEntity\Model\ResourceModel\Vendor\Collection as VendorEntityCollection;
use Stanislavz\VendorEntity\Model\Vendor as VendorModel;
use Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory;
use Stanislavz\VendorEntity\Api\Data\VendorInterface;
use Stanislavz\VendorEntity\Api\Data\VendorInterfaceFactory;

/**
 * Class VendorRepository
 * @package Stanislavz\VendorEntity\Model
 */
class VendorRepository implements \Stanislavz\VendorEntity\Api\VendorRepositoryInterface
{
    /**
     * @var Vendor[]
     */
    protected $instances = [];

    /**
     * @var \Stanislavz\VendorEntity\Model\VendorFactory
     */
    protected $vendorFactory;

    /**
     * @var \Stanislavz\VendorEntity\Model\ResourceModel\VendorFactory
     */
    protected $resourceModelFactory;

    /**
     * @var \Stanislavz\VendorEntity\Api\Data\VendorSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory
     */
    protected $vendorCollectionFactory;

    /**
     * @var \Stanislavz\VendorEntity\Api\Data\VendorInterfaceFactory
     */
    protected $dataVendorFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * VendorRepository constructor.
     * @param VendorInterfaceFactory $dataVendorFactory
     * @param VendorSearchResultsInterfaceFactory $searchResultsFactory
     * @param VendorFactory $vendorFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param ResourceModel\VendorFactory $resourceModelFactory
     */
    public function __construct(
        \Stanislavz\VendorEntity\Api\Data\VendorInterfaceFactory $dataVendorFactory,
        \Stanislavz\VendorEntity\Api\Data\VendorSearchResultsInterfaceFactory $searchResultsFactory,
        \Stanislavz\VendorEntity\Model\VendorFactory $vendorFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        \Stanislavz\VendorEntity\Model\ResourceModel\VendorFactory $resourceModelFactory
    ) {
        $this->dataVendorFactory = $dataVendorFactory;
        $this->dataObjectHelper  = $dataObjectHelper;
        $this->vendorFactory = $vendorFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->resourceModelFactory = $resourceModelFactory;
        $this->dataObjectProcessor  = $dataObjectProcessor;
    }

    /**
     * @param \Stanislavz\VendorEntity\Api\Data\VendorInterface $vendor
     * @return \Stanislavz\VendorEntity\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Stanislavz\VendorEntity\Api\Data\VendorInterface $vendor)
    {
        try {
            /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor $resourceModel */
            $resourceModel = $this->resourceModelFactory->create();
            $resourceModel->save($vendor);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(
                __(
                    'Could not save brand: %1',
                    $e->getMessage()
                ),
                $e
            );
        }
        unset($this->instances[$vendor->getId()]);
        return $vendor;
    }


    public function get($vendorId, $storeId = null)
    {
        $cacheKey = null !== $storeId ? $storeId : 'all';
        if (!isset($this->instances[$vendorId][$cacheKey])) {
            /** @var \Stanislavz\VendorEntity\Model\Vendor $vendor */
            $vendor = $this->vendorFactory->create();
            /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor $resourceModel */
            $resourceModel = $this->resourceModelFactory->create();
            if (null !== $storeId) {
                $vendor->setStoreId($storeId);
            }
            $resourceModel->load($vendor, $vendorId);
            if (!$vendor->getId()) {
                throw NoSuchEntityException::singleField('id', $vendorId);
            }
            $this->instances[$vendorId][$cacheKey] = $vendor;
        }
        return $this->instances[$vendorId][$cacheKey];
    }
    /**
     * @inheritdoc
     */
    public function delete(\Stanislavz\VendorEntity\Api\Data\VendorInterface $vendor)
    {
        try {
            $vendorId = $vendor->getId();
            /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor $resourceModel */
            $resourceModel = $this->resourceModelFactory->create();
            $resourceModel->delete($vendor);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\StateException(
                __(
                    'Cannot delete brand with id %1',
                    $vendor->getId()
                ),
                $e
            );
        }
        unset($this->instances[$vendorId]);
        return true;
    }

    /**
     * @param int|string $id
     * @return bool|ResourceModel\Vendor
     * @throws \Exception
     */
    public function deleteById($id)
    {
        /** @var \Stanislavz\VendorEntity\Model\Vendor $vendor */
        $vendor = $this->vendorFactory->create();
        /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor $resourceModel */
        $resourceModel = $this->resourceModelFactory->create();
        $resourceModel->load($vendor, $id);
        return $resourceModel->delete($vendor);
    }
    /**
     * @inheritdoc
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Stanislavz\VendorEntity\Api\Data\VendorSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        /** @var VendorEntityCollection $collection */
        $collection = $this->vendorCollectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() === SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        $vendor = [];
        /** @var VendorModel $askQuestionModel */
        foreach ($collection as $vendorModel) {
            /** @var VendorInterface $askQuestionData */
            $askQuestionData = $this->dataVendorFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $askQuestionData,
                $vendorModel->getData(),
                'Stanislavz\VendorEntity\Api\Data\VendorInterface'
            );
            $vendor[] = $this->dataObjectProcessor->buildOutputDataArray(
                $askQuestionData,
                'Stanislavz\AskQuestion\Api\Data\AskQuestionInterface'
            );
        }
        $searchResults->setItems($vendor);
        return $searchResults;
    }
}

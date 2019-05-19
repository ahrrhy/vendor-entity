<?php

namespace Stanislavz\VendorEntity\Model\ResourceModel\Vendor;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory;

/**
 * Class Collection
 * @package Stanislavz\VendorEntity\Model\ResourceModel\Vendor
 */
class Collection extends AbstractCollection
{
    /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory */
    protected $vendorCollectionFactory;

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Eav\Model\Config $eavConfig,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Eav\Model\EntityFactory $eavEntityFactory,
        \Magento\Eav\Model\ResourceModel\Helper $resourceHelper,
        \Magento\Framework\Validator\UniversalFactory $universalFactory,
        \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null
    ) {
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $eavConfig,
            $resource,
            $eavEntityFactory,
            $resourceHelper,
            $universalFactory,
            $connection
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            'Stanislavz\VendorEntity\Model\Vendor',
            'Stanislavz\VendorEntity\Model\ResourceModel\Vendor'
        );
    }

    /**
     * @param bool $addEmpty
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray($addEmpty = true)
    {
        /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\Collection $collection */
        $collection = $this->vendorCollectionFactory->create();
        $collection->addAttributeToSelect('name')->load();
        $options = [];
        if ($addEmpty) {
            $options[] = ['label' => __('-- Please Select a Vendor --'), 'value' => ''];
        }
        foreach ($collection as $vendor) {
            $options[] = ['label' => $vendor->getName(), 'value' => $vendor->getId()];
        }
        return $options;
    }
}

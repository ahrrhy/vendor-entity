<?php

namespace Stanislavz\Vendor\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Stanislavz\Vendor\Model\ResourceModel\Vendor
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'vendor_id';
    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'vendor_collection';
    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'vendor_collection';

    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(
            \Stanislavz\Vendor\Model\Vendor::class,
            \Stanislavz\Vendor\Model\ResourceModel\Vendor::class
        );
    }
}

<?php

namespace Stanislavz\Vendor\Ui\Component\Form;

use Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 * @package Stanislavz\Vendor\Ui\Component\Form
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Stanislavz\Vendor\Model\ResourceModel\Vendor\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $vendorCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $vendorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $vendor) {
            $this->_loadedData[$vendor->getId()] = $vendor->getData();
        }
        return $this->_loadedData;
    }
}

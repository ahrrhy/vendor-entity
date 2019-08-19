<?php

namespace Stanislavz\Vendor\Ui\Component\Form;

use Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;

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
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var array
     */
    protected $_loadedData = [];

    /**
     * DataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $vendorCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $vendorCollectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $vendorCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getData(): array
    {
        $baseUrl =  $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        if (!empty($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $vendor) {
            $this->_loadedData[$vendor->getId()] = $vendor->getData();
            if ($this->_loadedData[$vendor->getId()]['logo']) {
                $logo = [];
                $logo[0]['image'] = $this->_loadedData[$vendor->getId()]['logo'];
                $logo[0]['url'] = $baseUrl . 'vendors/logo/' . $this->_loadedData[$vendor->getId()]['logo'];
                $this->_loadedData[$vendor->getId()]['logo'] = $logo;
            }
        }

        return $this->_loadedData;
    }
}

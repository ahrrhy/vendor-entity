<?php

namespace Stanislavz\Vendor\Ui\Component\Form;

use Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

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
    protected $loadedData;

    /**
     * @var PoolInterface
     */
    protected $pool;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param PoolInterface $pool
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->pool = $pool;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    /**
     * @inheritdoc
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }
        return $meta;
    }
    /**
     * Get data
     *
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getData()
    {
        if (!isset($this->loadedData)) {
            $items = $this->collection->getItems();
            /** @var \Magento\Cron\Model\Schedule $job */
            foreach ($items as $job) {
                $this->loadedData[$job->getId()] = $job->getData();
            }
        }
        $data = $this->loadedData;
        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $data = $modifier->modifyData($data);
        }
        return $data;
    }
}

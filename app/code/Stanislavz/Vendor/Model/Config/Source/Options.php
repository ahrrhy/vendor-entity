<?php

namespace Stanislavz\Vendor\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Stanislavz\Vendor\Model\ResourceModel\Vendor\Collection;
use Stanislavz\Vendor\Model\Vendor;

/**
 * Class Options
 * @package Stanislavz\Vendor\Model\Config\Source
 */
class Options extends AbstractSource
{
    /** @var \Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory */
    private $vendorCollectionFactory;

    /**
     * Options constructor.
     * @param \Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
     */
    public function __construct(
        \Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
    ) {
        $this->vendorCollectionFactory = $vendorCollectionFactory;
    }

    /**
     * @return array
     */
    public function getAllOptions(): array
    {
        /** @var array $vendors */
        $vendors = $this->getVendors();
        $vendorsOptions = [];
        /** @var Vendor $vendor */
        foreach ($vendors as $vendor) {
            $vendorsOptions[] = [
                'label' => $vendor->getName(),
                'value' => $vendor->getId()
            ];
        }

        return $vendorsOptions;
    }

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string|bool
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] === $value) {
                return $option['label'];
            }
        }
        return false;
    }

    /**
     * @return \Magento\Framework\DataObject[]
     */
    private function getVendors(): array
    {
        /** @var Collection $vendorsCollection */
        $vendorsCollection = $this->vendorCollectionFactory->create();
        $vendorsCollection->addFieldToFilter('status', ['neq' => Vendor::STATUS_DELETED]);
        $vendorsCollection->load();

        return $vendorsCollection->getItems();
    }
}

<?php

namespace Stanislavz\Vendor\Model;

use Stanislavz\Vendor\Model\ResourceModel\Vendor\Collection;
use Stanislavz\Vendor\Model\Vendor;

/**
 * Class VendorOptions
 * @package Stanislavz\Vendor\Model
 */
class VendorOptions
{
    private $vendorCollectionFactory;

    private $vendorModelFactory;

    /**
     * VendorOptions constructor.
     * @param ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
     * @param VendorFactory $vendorModelFactory
     */
    public function __construct(
        \Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        \Stanislavz\Vendor\Model\VendorFactory $vendorModelFactory
    ) {
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->vendorModelFactory = $vendorModelFactory;
    }


}

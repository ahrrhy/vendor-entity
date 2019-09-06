<?php

namespace Stanislavz\Vendor\Block;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Helper\Data;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Exception\NoSuchEntityException;
use Stanislavz\Vendor\Model\ResourceModel\Vendor as VendorResource;
use Stanislavz\Vendor\Model\Vendor as VendorModel;

/**
 * Class VendorData
 * @package Stanislavz\Vendor\Block
 */
class VendorData extends Template
{
    /** @var StoreManagerInterface */
    private $storeManager;

    /** @var Data */
    protected $catalogHelper;

    /** @var Product */
    private $product;

    /** @var \Stanislavz\Vendor\Model\VendorFactory */
    private $vendorModelFactory;

    /** @var \Stanislavz\Vendor\Model\ResourceModel\VendorFactory */
    private $vendorResourceFactory;

    /** @var VendorModel */
    private $vendor;

    /**
     * VendorData constructor.
     * @param Template\Context $context
     * @param Data $catalogHelper
     * @param StoreManagerInterface $storeManager
     * @param \Stanislavz\Vendor\Model\VendorFactory $vendorModelFactory
     * @param \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Data $catalogHelper,
        StoreManagerInterface $storeManager,
        \Stanislavz\Vendor\Model\VendorFactory $vendorModelFactory,
        \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
        $this->vendorModelFactory = $vendorModelFactory;
        $this->vendorResourceFactory = $vendorResourceFactory;
        $this->catalogHelper = $catalogHelper;
    }

    /**
     * @return Product|null
     */
    private function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->catalogHelper->getProduct();
        }

        return $this->product;
    }

    /**
     * @return VendorModel|void
     */
    public function getVendor()
    {
        if (!$this->getProduct()) {
            return;
        }

        if (is_null($this->vendor)) {
            /** @var string|int $vendorId */
            $vendorId = $this->product->getVendor();
            /** @var VendorModel $vendor */
            $vendor = $this->vendorModelFactory->create();
            /** @var VendorResource $vendorResource */
            $vendorResource = $this->vendorResourceFactory->create();
            $vendorResource->load($vendor, $vendorId);
            $this->vendor = $vendor;
        }

        return $this->vendor;
    }

    /**
     * @return string|void
     */
    public function getVendorLogo()
    {
        if (!$this->getVendor()) {
            return;
        }
        try {
            $store = $this->storeManager->getStore();
            $path = $store->getBaseUrl('media') . VendorModel::VENDOR_LOGO_BASE_DIR . $this->vendor->getLogo();
        } catch (NoSuchEntityException $exception) {
            return;
        }

        return $path;
    }
}

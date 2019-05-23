<?php

namespace Stanislavz\VendorEntity\Controller\Adminhtml\Vendors;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Stanislavz\VendorEntity\Model\Vendor;
use Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory;

/**
 * Class InlineEdit
 * @package Stanislavz\VendorEntity\Controller\Adminhtml\Vendors
 */
class InlineEdit extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory */
    protected $vendorCollectionFactory;

    /**
     * @var \Stanislavz\VendorEntity\Model\VendorFactory
     */
    protected $vendorFactory;

    /**
     * InlineEdit constructor.
     * @param Context $context
     * @param \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Stanislavz\VendorEntity\Model\VendorFactory $vendorFactory
     */
    public function __construct(
        Context $context,
        \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Stanislavz\VendorEntity\Model\VendorFactory $vendorFactory
    ) {
        parent::__construct($context);
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->jsonFactory = $jsonFactory;
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            }
            /** @var \Stanislavz\VendorEntity\Model\ResourceModel\Vendor\Collection $vendorCollection */
            $vendorCollection = $this->vendorCollectionFactory->create();
            foreach ($postItems as $postItem) {
                /** @var Vendor $vendor */
                $vendor = $this->vendorFactory->create();
                $vendor->setData($postItem);
                $vendorCollection->addItem($vendor);
            }
            $vendorCollection->save();
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}

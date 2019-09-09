<?php

namespace Stanislavz\Vendor\Controller\Adminhtml\Actions;

use Magento\Backend\App\Action;
use Stanislavz\Vendor\Model\Vendor;
use Stanislavz\Vendor\Model\ResourceModel\Vendor as VendorResource;

class Delete extends Action
{
    /**
     * @var \Stanislavz\Vendor\Model\VendorFactory
     */
    private $vendorFactory;

    /**
     * @var \Stanislavz\Vendor\Model\ResourceModel\VendorFactory
     */
    private $vendorResourceFactory;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param \Stanislavz\Vendor\Model\VendorFactory $vendorFactory
     * @param \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory
     */
    public function __construct(
        Action\Context $context,
        \Stanislavz\Vendor\Model\VendorFactory $vendorFactory,
        \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory
    ) {
        parent::__construct($context);
        $this->vendorFactory = $vendorFactory;
        $this->vendorResourceFactory = $vendorResourceFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('vendor_id');
        if ($id) {
            try {
                /** @var Vendor $vendor */
                $vendor = $this->vendorFactory->create();
                /** @var VendorResource $vendorResource */
                $vendorResource = $this->vendorResourceFactory->create();
                $vendorResource->load($vendor, $id);
                $vendorResource->delete($vendor);
                $this->messageManager->addSuccessMessage(__('You deleted the vendor.'));
                return $resultRedirect->setPath('vendors/index/index');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('vendors/index/index');
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a vendor to delete.'));
        // go to grid
        return $resultRedirect->setPath('vendors/index/index');
    }
}

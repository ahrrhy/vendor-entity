<?php

namespace Stanislavz\VendorEntity\Controller\Adminhtml\Vendors;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Stanislavz\VendorEntity\Model\Vendor;
use Stanislavz\VendorEntity\Model\VendorRepository;
use Stanislavz\VendorEntity\Model\VendorFactory;

/**
 * Class Delete
 * @package Stanislavz\VendorEntity\Controller\Adminhtml\Vendors
 */
class Delete extends Action
{
    /**
     * @var \Stanislavz\VendorEntity\Model\VendorFactory
     */
    private $vendorFactory;

    /** @var VendorRepository */
    private $vendorRepository;

    public function __construct(
        Action\Context $context,
        \Stanislavz\VendorEntity\Model\VendorRepository $vendorRepository,
        \Stanislavz\VendorEntity\Model\VendorFactory $vendorFactory
    ) {
        parent::__construct($context);
        $this->vendorRepository = $vendorRepository;
        $this->vendorFactory = $vendorFactory;
    }

    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                /** @var VendorRepository $vendorRepository */
                $vendorRepository = $this->vendorRepository;
                $vendorRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the question.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/');
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a question to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

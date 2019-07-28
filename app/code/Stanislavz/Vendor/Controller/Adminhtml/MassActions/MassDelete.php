<?php

namespace Stanislavz\Vendor\Controller\Adminhtml\MassActions;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Stanislavz\Vendor\Model\ResourceModel\Vendor\Collection;
use Stanislavz\Vendor\Model\ResourceModel\Vendor as VendorResource;

/**
 * Class MassDelete
 * @package Stanislavz\Vendor\Controller\Adminhtml\MassActions
 */
class MassDelete extends Action
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var \Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory
     */
    private $vendorCollection;

    /**
     * @var \Stanislavz\Vendor\Model\ResourceModel\VendorFactory
     */
    private $vendorResourceFactory;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param VendorResource\CollectionFactory $vendorCollection
     * @param \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory
     */
    public function __construct(
        Action\Context $context,
        Filter $filter,
        \Stanislavz\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollection,
        \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->vendorCollection = $vendorCollection;
        $this->vendorResourceFactory = $vendorResourceFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        /** @var Collection $collection */
        $collection = $this->vendorCollection->create();
        $paramsId = $this->getRequest()->getParam('selected');
        $collection->addFieldToFilter('vendor_id', $paramsId);
        $collectionSize = $collection->getSize();
        /** @var \Stanislavz\Vendor\Model\Vendor $vendor */
        foreach ($collection as $vendor) {
            /** @var VendorResource $vendorResource */
            $vendorResource = $this->vendorResourceFactory->create();
            $vendorResource->delete($vendor);
        }
        $this->messageManager
            ->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}

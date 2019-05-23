<?php

namespace Stanislavz\VendorEntity\Controller\Adminhtml\Vendors;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Edit
 * @package Stanislavz\VendorEntity\Controller\Adminhtml\Vendors
 */
class Edit extends Action
{
    /** @var ResultFactory */
    protected $resultFactory;

    /**
     * Edit constructor.
     * @param ResultFactory $resultFactory
     * @param Action\Context $context
     */
    public function __construct(
        ResultFactory $resultFactory,
        Action\Context $context
    ) {
        parent::__construct($context);
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Vendor'));
        return $resultPage;
    }
}

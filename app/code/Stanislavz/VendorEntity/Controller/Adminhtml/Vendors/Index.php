<?php

namespace Stanislavz\VendorEntity\Controller\Adminhtml\Vendors;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;

/**
 * Class Index
 * @package Stanislavz\VendorEntity\Controller\Adminhtml\Vendors
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Vendors'));
        return $resultPage;
    }
}

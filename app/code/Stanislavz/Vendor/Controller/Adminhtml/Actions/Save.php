<?php

namespace Stanislavz\Vendor\Controller\Adminhtml\Actions;

use Magento\Backend\App\Action;

/**
 * Class Save
 * @package Stanislavz\Vendor\Controller\Adminhtml\Actions
 */
class Save extends Action
{
    public function execute()
    {
        /** Get data from request */
        $requestData = $this->getRequest()->getPostValue();
        /** Validate and save data */
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('vendor/index/index');
    }
}

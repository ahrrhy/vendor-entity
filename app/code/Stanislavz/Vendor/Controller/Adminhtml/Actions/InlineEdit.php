<?php

namespace Stanislavz\Vendor\Controller\Adminhtml\Actions;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Stanislavz\Vendor\Model\Vendor;
use Magento\Framework\DB\Transaction;

/**
 * Class InlineEdit
 * @package Stanislavz\Vendor\Controller\Adminhtml\Actions
 */
class InlineEdit extends Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;
    /**
     * @var \Magento\Framework\DB\TransactionFactory
     */
    private $transactionFactory;
    /**
     * @var \Stanislavz\Vendor\Model\VendorFactory
     */
    private $vendorFactory;

    /**
     * InlineEdit constructor.
     * @param \Magento\Framework\DB\TransactionFactory $transactionFactory
     * @param Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     * @param \Stanislavz\Vendor\Model\VendorFactory $vendorFactory
     */
    public function __construct(
        \Magento\Framework\DB\TransactionFactory $transactionFactory,
        Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Stanislavz\Vendor\Model\VendorFactory $vendorFactory
    ) {
        parent::__construct($context);
        $this->transactionFactory = $transactionFactory;
        $this->jsonFactory = $jsonFactory;
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            }
            /** @var Transaction $transaction */
            $transaction = $this->transactionFactory->create();
            foreach ($postItems as $postItem) {
                /** @var Vendor $vendor */
                $vendor = $this->vendorFactory->create();
                $vendor->setData($postItem);
                $transaction->addObject($vendor);
            }
            $transaction->save();
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}

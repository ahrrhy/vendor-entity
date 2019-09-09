<?php

namespace Stanislavz\Vendor\Controller\Adminhtml\Actions;

use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Stanislavz\Vendor\Model\ResourceModel\Vendor as VendorResource;
use Stanislavz\Vendor\Model\Vendor as VendorModel;

/**
 * Class Save
 * @package Stanislavz\Vendor\Controller\Adminhtml\Actions
 */
class Save extends Action
{
    /**
     * @var ImageUploader
     */
    private $imageUploader;

    /**
     * @var \Stanislavz\Vendor\Model\VendorFactory
     */
    private $vendorModelFactory;

    /**
     * @var \Stanislavz\Vendor\Model\ResourceModel\VendorFactory
     */
    private $vendorResourceFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param ImageUploader $imageUploader
     * @param \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory
     * @param \Stanislavz\Vendor\Model\VendorFactory $vendorModelFactory
     */
    public function __construct(
        Action\Context $context,
        ImageUploader $imageUploader,
        \Stanislavz\Vendor\Model\ResourceModel\VendorFactory $vendorResourceFactory,
        \Stanislavz\Vendor\Model\VendorFactory $vendorModelFactory
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
        $this->vendorResourceFactory = $vendorResourceFactory;
        $this->vendorModelFactory = $vendorModelFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** Get data from request */
        $requestData = $this->getRequest()->getPostValue();
        if (!empty($requestData)) {
            $vendorId = isset($requestData['vendor_id']) ? $requestData['vendor_id'] : null;
            $this->saveVendor($requestData, $vendorId);
        }

        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('vendors/index/index');
    }

    /**
     * @param $data
     * @param null $vendorId
     */
    private function saveVendor($data, $vendorId = null): void
    {
        /** @var VendorResource $vendorResource */
        $vendorResource = $this->vendorResourceFactory->create();
        /** @var VendorModel $vendorModel */
        $vendorModel = $this->vendorModelFactory->create();
        // Load Vendor if Vendor is not new
        if ($vendorId !== null) {
            $vendorResource->load($vendorModel, $vendorId, 'vendor_id');
        }
        try {
            if (empty($data['logo'][0])) {
                $data['logo'] = null;
            } else {
                if (isset($data['logo'][0]['url'])
                    && strpos($data['logo'][0]['url'], 'tmp') !== false) {
                    $data['logo'] = $data['logo'][0]['name'];
                    $this->imageUploader->moveFileFromTmp($data['logo']);
                }
                if (isset($data['logo'][0]['image'])) {
                    $data['logo'] = $data['logo'][0]['image'];
                }
            }
            $vendorModel->setData($data);
            $vendorResource->save($vendorModel);
        } catch (\Exception $exception) {
            $this->messageManager->addExceptionMessage($exception);
        }
    }
}

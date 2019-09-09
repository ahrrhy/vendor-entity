<?php

namespace Stanislavz\Vendor\Controller\Adminhtml\Actions\Form\ImageUploader;

use Magento\Catalog\Model\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Save
 * @package Stanislavz\Vendor\Controller\Adminhtml\Actions\Form\ImageUploader
 */
class Save extends Action
{
    /**
     * @var ImageUploader
     */
    private $imageUploader;

    /** @var \Magento\Store\Model\StoreManagerInterface */
    protected $storeManager;

    /**
     * Save constructor.
     * @param ImageUploader $imageUploader
     * @param StoreManagerInterface $storeManager
     * @param Context $context
     */
    public function __construct(
        ImageUploader $imageUploader,
        StoreManagerInterface $storeManager,
        Context $context
    ) {
        $this->imageUploader = $imageUploader;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $imageId = $this->getRequest()->getParam('param_name', 'logo');
        try {
            $imageResult = $this->imageUploader->saveFileToTmpDir($imageId);
            $imageResult['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];

            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($imageResult);
        } catch (\Exception $e) {
            $imageResult = ['error' => $e->getMessage(), 'error_code' => $e->getCode()];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($imageResult);
    }
}

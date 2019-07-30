<?php

namespace Stanislavz\Vendor\Controller\Adminhtml\Actions\Form\ImageUploader;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action
{
    /** @var UploaderFactory */
    private $fileUploaderFactory;

    /** @var Filesystem */
    private $fileSystem;

    /** @var LoggerInterface */
    private $logger;

    /**
     * Save constructor.
     * @param Filesystem $fileSystem
     * @param UploaderFactory $fileUploaderFactory
     * @param Context $context
     */
    public function __construct(
        Filesystem $fileSystem,
        LoggerInterface $logger,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        Context $context
    ) {
        $this->logger = $logger;
        $this->fileSystem = $fileSystem;
        $this->fileUploaderFactory = $fileUploaderFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\MediaStorage\Model\File\Uploader $uploader */
        $uploader = $this->fileUploaderFactory->create(['fileId' => 'logo']);
        $path = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA)
            ->getAbsolutePath('vendors/logo/');
        try {
            $imageResult = $uploader->save($path);
            return $imageResult;
        } catch (\Exception $e) {
            $imageResult = ['error' => $e->getMessage(), 'error_code' => $e->getCode()];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($imageResult);
    }
}

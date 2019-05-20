<?php

namespace Stanislavz\VendorEntity\Controller\Adminhtml\Vendors;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\App\Action;
use Stanislavz\VendorEntity\Model\VendorRepository;
use Stanislavz\VendorEntity\Model\VendorRepositoryFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria;

/**
 * Class MassDelete
 * @package Stanislavz\VendorEntity\Controller\Adminhtml\Vendors
 */
class MassDelete extends Action
{
    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var VendorRepository */
    private $vendorRepository;

    /** @var \Stanislavz\VendorEntity\Model\VendorRepositoryFactory */
    private $vendorRepositoryFactory;

    /** @var Filter */
    protected $filter;

    /** @var ResultFactory */
    protected $resultFactory;


    public function __construct(
        Context $context,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        Filter $filter,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        VendorRepository $vendorRepository,
        \Stanislavz\VendorEntity\Model\VendorRepositoryFactory $vendorRepositoryFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->vendorRepository = $vendorRepository;
        $this->vendorRepositoryFactory = $vendorRepositoryFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $paramsId = $this->getRequest()->getParam('selected');
        if (!isEmpty($paramsId)) {
            try {
                /** @var SearchCriteria $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter('entity_id', $paramsId)->create();
                /** @var \Stanislavz\VendorEntity\Api\Data\VendorSearchResultsInterface $vendorEntities */
                $vendorEntities = $this->vendorRepository->getList($searchCriteria);
                $repositorySize = count($vendorEntities->getItems());
                foreach ($vendorEntities as $vendor) {
                    /** @var VendorRepository $clearVendorRepository */
                    $clearVendorRepository = $this->vendorRepositoryFactory->create();
                    $clearVendorRepository->delete($vendor);
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 record(s) have been deleted.', $repositorySize)
                );

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/');
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find vendors to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

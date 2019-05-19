<?php

namespace Stanislavz\VendorEntity\Model\ResourceModel;

use Magento\Eav\Model\Entity\AbstractEntity;

/**
 * Class Vendor
 * @package Stanislavz\VendorEntity\Model\ResourceModel
 */
class Vendor extends AbstractEntity
{
    /**
     * {@inheritDoc}
     */
    protected function _construct() {
        $this->_read = 'vendor_read';
        $this->_write = 'vendor_write';
    }

    /**
     * @return \Magento\Eav\Model\Entity\Type
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getEntityType()
    {
        if (empty($this->_type)) {
            $this->setType(\Stanislavz\VendorEntity\Model\Vendor::ENTITY);
        }
        return parent::getEntityType();
    }
}

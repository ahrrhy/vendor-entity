<?php

namespace Stanislavz\Vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Vendor
 * @package Stanislavz\Vendor\Model\ResourceModel
 */
class Vendor extends AbstractDb
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init('stanislavz_vendor', 'vendor_id');
    }
}

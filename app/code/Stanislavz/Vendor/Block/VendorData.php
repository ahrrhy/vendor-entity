<?php

namespace Stanislavz\Vendor\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class VendorData
 * @package Stanislavz\Vendor\Block
 */
class VendorData extends Template
{
    /**
     * @return string
     */
    public function writeHello()
    {
        return 'Hello!!!';
    }
}

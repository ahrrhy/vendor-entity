<?php

namespace Stanislavz\Vendor\Block\Adminhtml;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Container;

class Vendor extends Container
{
    /**
     * Prepare button and grid
     *
     * @return \Stanislavz\Vendor\Block\Adminhtml\Vendor
     */
    protected function _prepareLayout()
    {
        $addButtonProps = [
            'id' => 'add_new_vendor',
            'label' => __('Add Vendor'),
            'class' => 'add',
            'button_class' => '',
            'class_name' => \Magento\Backend\Block\Widget\Button\SplitButton::class,
            'options' => '',
        ];
        $this->buttonList->add('add_new', $addButtonProps);

        return parent::_prepareLayout();
    }
}

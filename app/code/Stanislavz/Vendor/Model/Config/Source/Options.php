<?php

namespace Stanislavz\Vendor\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class Options
 * @package Stanislavz\Vendor\Model\Config\Source
 */
class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        /**
         * @TODO refactor for get data from Vendor entity
         */
        $this->_options = [
            ['label'=>'', 'value'=>''],
            ['label'=>'Small', 'value'=>'1'],
            ['label'=>'Medium', 'value'=>'2'],
            ['label'=>'Large', 'value'=>'3']
        ];
        return $this->_options;
    }

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     * @return string|bool
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] === $value) {
                return $option['label'];
            }
        }
        return false;
    }
}

<?php

namespace Stanislavz\Vendor\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Stanislavz\Vendor\Model\Vendor;

/**
 * Class Status
 * @package Stanislavz\Vendor\Model\Config\Source
 */
class Status implements OptionSourceInterface
{
    /**Questions Statuses
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            [
                'label' => __('Active'),
                'value' => Vendor::STATUS_ACTIVE,
            ],
            [
                'label' => __('Deleted'),
                'value' => Vendor::STATUS_DELETED,
            ],
            [
                'label' => __('Inactive'),
                'value' => Vendor::STATUS_INACTIVE,
            ],
            [
                'label' => __('Vacation'),
                'value' => Vendor::STATUS_VACATION,
            ],
            [
                'label' => __('Candidate'),
                'value' => Vendor::STATUS_CANDIDATE,
            ],
        ];
    }
}
<?php

namespace Stanislavz\Vendor\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Class VendorSearchResultsInterface
 * @package Stanislavz\Vendor\Api\Data
 */
interface VendorSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get request samples list.
     *
     * @return \Stanislavz\Vendor\Api\Data\VendorInterface[]
     */
    public function getItems(): array;
    /**
     * Set request samples list.
     *
     * @param \Stanislavz\Vendor\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items): self;
}

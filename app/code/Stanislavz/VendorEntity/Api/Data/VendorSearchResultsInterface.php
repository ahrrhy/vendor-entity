<?php

namespace Stanislavz\VendorEntity\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface VendorSearchResultsInterface
 * @package Stanislavz\VendorEntity\Api\Data
 * @api
 */
interface VendorSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get brands list.
     *
     * @return \Stanislavz\VendorEntity\Api\Data\VendorInterface[]
     */
    public function getItems();
    /**
     * Set brands list.
     *
     * @param \Stanislavz\VendorEntity\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

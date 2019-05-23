<?php

namespace Stanislavz\VendorEntity\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Vendor
 * @package Stanislavz\VendorEntity\Model
 *
 * @method int|string getEntityId()
 * @method string getName()
 * @method Vendor setName(string $name)
 * @method string getDescription()
 * @method Vendor setDescription(string $description)
 * @method string getDateAdded()
 * @method Vendor setDateAdded(string $dateTime)
 * @method string getLogo()
 * @method Vendor setLogo(string $logo)
 */
class Vendor extends AbstractModel
{
    public const ENTITY = 'vendor';

    public const CACHE_TAG = 'vendor';

    public const STORE_ID = 'store_id';

    protected $_eventPrefix = 'vendor';

    protected $_eventObject = 'vendor';

    protected $_cacheTag = self::CACHE_TAG;


    /**
     * {@inheritDoc}
     */
    protected function _construct() {
        $this->_init('Stanislavz\VendorEntity\Model\ResourceModel\Vendor');
    }
}

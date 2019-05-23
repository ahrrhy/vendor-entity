<?php

namespace Stanislavz\VendorEntity\Setup;

use Magento\Catalog\Model\Category\Attribute\Backend\Image;
use Magento\Eav\Model\Entity\Attribute\Backend\Datetime;
use Stanislavz\VendorEntity\Model\VendorFactory;
use Magento\Eav\Model\Entity\Setup\Context;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
 * Class VendorSetup
 * @package Stanislavz\VendorEntity\Setup
 */
class VendorSetup extends EavSetup
{
    private $vendorFactory;

    public function __construct(
        ModuleDataSetupInterface $setup,
        Context $context,
        CacheInterface $cache,
        CollectionFactory $attrGroupCollectionFactory,
        VendorFactory $vendorFactory
    ) {
        $this->vendorFactory = $vendorFactory;
        parent::__construct($setup, $context, $cache, $attrGroupCollectionFactory);
    }

    /**
     * @return array
     */
    public function getDefaultEntities()
    {
        return [
            'vendor' => [
                'entity_model' => 'Stanislavz\VendorEntity\Model\ResourceModel\Vendor',
                'attribute_model' => 'Magento\Catalog\Model\ResourceModel\Eav\Attribute',
                'table' => 'vendor_entity',
                'entity_attribute_collection' => 'Magento\Eav\Model\ResourceModel\Entity\Attribute\Collection',
                'attributes' => [
                    'name' => [
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'required' => true,
                        'source' => 'Stanislavz\VendorEntity\Model\Product\Attribute\Source\Vendor',
                        'frontend_class' => 'validate-length maximum-length-255',
                        'sort_order' => 10,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                    ],
                    'description' => [
                        'type' => 'text',
                        'label' => 'Description',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 20,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                        'wysiwyg_enabled' => true,
                        'is_html_allowed_on_front' => true,
                    ],
                    'date_added' => [
                        'type' => 'datetime',
                        'label' => 'Date Added',
                        'input' => 'date',
                        'backend' => Datetime::class,
                        'required' => false,
                        'class' => 'validate-length maximum-length-255',
                        'sort_order' => 30,
                        'global' => ScopedAttributeInterface::SCOPE_STORE,
                    ],
                    'logo' => [
                        'type' => 'varchar',
                        'label' => 'Logo',
                        'input' => 'image',
                        'backend' => Image::class,
                        'required' => false,
                        'sort_order' => 40,
                        'global' => ScopedAttributeInterface::SCOPE_STORE
                    ],
                ],
            ]
        ];
    }
}

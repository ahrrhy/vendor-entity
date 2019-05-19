<?php

namespace Stanislavz\VendorEntity\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Stanislavz\VendorEntity\Setup\VendorSetup;

/**
 * Class InstallData
 * @package Stanislavz\VendorEntity\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \Stanislavz\VendorEntity\Setup\VendorSetupFactory
     */
    private $vendorSetupFactory;

    /**
     * InstallData constructor.
     * @param \Stanislavz\VendorEntity\Setup\VendorSetupFactory $vendorSetupFactory
     */
    public function __construct(
        \Stanislavz\VendorEntity\Setup\VendorSetupFactory $vendorSetupFactory
    ) {
        $this->vendorSetupFactory = $vendorSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $vendorEntity = \Stanislavz\VendorEntity\Model\Vendor::ENTITY;

            /** @var \Stanislavz\VendorEntity\Setup\VendorSetup $vendorSetup */
        $vendorSetup = $this->vendorSetupFactory->create(['setup' => $setup]);
        $vendorSetup->installEntities();

        $vendorSetup->addAttribute(
            $vendorEntity,
            'name',
            ['type' => 'text']
        );

        $vendorSetup->addAttribute(
            $vendorEntity,
            'date_added',
            ['type' => 'datetime']
        );

        $vendorSetup->addAttribute(
            $vendorEntity,
            'description',
            ['type' => 'text']
        );

        $vendorSetup->addAttribute(
            $vendorEntity,
            'logo',
            ['type' => 'varchar']
        );
        $setup->endSetup();
    }
}

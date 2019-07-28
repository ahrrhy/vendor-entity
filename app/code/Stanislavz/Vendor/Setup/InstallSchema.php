<?php

namespace Stanislavz\Vendor\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Stanislavz\Vendor\Model\Vendor;

/**
 * Creating Vendor Tables
 *
 * Class InstallSchema
 * @package Stanislavz\Vendor\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context): void
    {
        /** @var SchemaSetupInterface $installer */
        $installer = $setup;
        $installer->startSetup();
            /**
             * Create table 'stanislavz_vendor'
             */
            $table = $installer->getConnection()->newTable(
                $installer->getTable('stanislavz_vendor')
            )->addColumn(
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Vendor ID'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                63,
                ['nullable' => false],
                'Vendor Name'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                63,
                ['nullable' => true],
                'Vendor Description'
            )->addColumn(
                'logo',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Customer Phone'
            )->addColumn(
                'additional_data',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Vendor Additional Data'
            )->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE
                ],
                'Updated At'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                15,
                [
                    'nullable' => false,
                    'default' => Vendor::STATUS_ACTIVE
                ],
                'Vendor Activity Status'
            );

            $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}

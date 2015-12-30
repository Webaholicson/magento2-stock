<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace EWD\Stock\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'wishlist'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ewd_warehouse')
        )->addColumn(
            'warehouse_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Warehouse ID'
        )->addColumn(
            'warehouse_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Warehuse Code'
        )->addColumn(
            'warehouse_contant_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Contact Name'
        )->addColumn(
            'warehouse_contant_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Contact Email'
        )->addColumn(
            'warehouse_location',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Warehouse Location'
        )->addColumn(
            'warehouse_lat',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Warehouse Latitude'
        )->addColumn(
            'warehouse_lng',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Warehouse Longitude'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created date'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Last updated date'
        )->addIndex(
            $installer->getIdxName(
                'warehouse_code',
                'warehouse_code',
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            'warehouse_id',
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'Warehouse main Table'
        );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'wishlist_item'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ewd_warehouse_shelf')
        )->addColumn(
            'warehouse_shelf_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Warehouse shelf ID'
        )->addColumn(
            'warehouse_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Warehouse ID'
        )->addColumn(
            'location',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Location name'
        )->addColumn(
            'description',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'Short description of shelf'
        )->addIndex(
            $installer->getIdxName('ewd_warehouse_shelf', 'warehouse_id'),
            'warehouse_id'
        )->addForeignKey(
            $installer->getFkName('ewd_warehouse_shelf', 'warehouse_id', 'ewd_warehouse', 'warehouse_id'),
            'warehouse_id',
            $installer->getTable('ewd_warehouse'),
            'warehouse_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Warehouse shelf'
        );
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'warehouse_shelf_item'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ewd_warehouse_shelf_item')
        )->addColumn(
            'item_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Item Id'
        )->addColumn(
            'warehouse_shelf_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false],
            'Warehouse Shelf Id'
        )->addColumn(
            'product_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false],
            'Product Id'
        )->addColumn(
            'Qty',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            255,
            ['nullable' => false],
            'Qty'
        )->addForeignKey(
            $installer->getFkName('ewd_warehouse_shelf_item', 'warehouse_shelf_id', 'ewd_warehouse_shelf', 'warehouse_shelf_id'),
            'warehouse_shelf_id',
            $installer->getTable('ewd_warehouse_shelf'),
            'warehouse_shelf_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Warehuse Shelf Item Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
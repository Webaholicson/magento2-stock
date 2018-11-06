<?php
namespace EWD\Stock\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(
        SchemaSetupInterface $setup, 
        ModuleContextInterface $context
    ) {
        $installer = $setup;

        $installer->startSetup();
        
        $this->createWarehouseTable($installer);
        $this->createWarehouseStoreTable($installer);
        $this->createWarehouseShelfTable($installer);
        $this->createWarehouseShelfItemTable($installer);

        $installer->endSetup();
    }
    
    /**
     * Create table 'ewd_warehouse'
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $installer
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    private function createWarehouseTable(SchemaSetupInterface $installer)
    {
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ewd_warehouse')
        )->addColumn(
            'warehouse_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true, 
                'unsigned' => true, 
                'nullable' => false, 
                'primary' => true
            ],
            'Warehouse ID'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            ['nullable' => false],
            'Warehouse Status'
        )->addColumn(
            'warehouse_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => false],
            'Warehouse Code'
        )->addColumn(
            'warehouse_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Warehouse Name'
        )->addColumn(
            'warehouse_contact_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            ['nullable' => true],
            'Contact Name'
        )->addColumn(
            'warehouse_contact_email',
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
            'created_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created date'
        )->addColumn(
            'updated_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Last updated date'
        )->addIndex(
            $installer->getIdxName(
                'warehouse_code',
                'warehouse_code',
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            'warehouse_id',
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'Warehouse main Table'
        );

        $installer->getConnection()->createTable($table);
    }
    
    /**
     * Create table 'ewd_warehouse_store'
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $installer
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    private function createWarehouseStoreTable(SchemaSetupInterface $installer)
    {
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ewd_warehouse_store')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true, 
                'unsigned' => true, 
                'nullable' => false, 
                'primary' => true
            ],
            'Primary key'
        )->addColumn(
            'warehouse_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Warehouse ID'
        )->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Store ID'
        )->addColumn(
            'created_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created date'
        )->addColumn(
            'updated_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Last updated date'
        )->addIndex(
            $installer->getIdxName(
                'ewd_warehouse_shelf',
                ['warehouse_id', 'store_id'],
                AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['warehouse_id', 'store_id'],
            ['type' => AdapterInterface::INDEX_TYPE_UNIQUE]
        )->setComment(
            'Warehouse and store pivot Table'
        );

        $installer->getConnection()->createTable($table);
    }
    
    /**
     * Create table 'ewd_warehouse_shelf'
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $installer
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    private function createWarehouseShelfTable(SchemaSetupInterface $installer)
    {
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ewd_warehouse_shelf')
        )->addColumn(
            'warehouse_shelf_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
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
        )->addColumn(
            'created_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created date'
        )->addColumn(
            'updated_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Last updated date'
        )->addIndex(
            $installer->getIdxName('ewd_warehouse_shelf', 'warehouse_id'),
            'warehouse_id'
        )->addForeignKey(
            $installer->getFkName(
                'ewd_warehouse_shelf', 
                'warehouse_id', 
                'ewd_warehouse', 
                'warehouse_id'
            ),
            'warehouse_id',
            $installer->getTable('ewd_warehouse'),
            'warehouse_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Warehouse shelf'
        );
        
        $installer->getConnection()->createTable($table);
    }
    
    /**
     * Create table 'warehouse_shelf_item'
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $installer
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    private function createWarehouseShelfItemTable(SchemaSetupInterface $installer)
    {
        $table = $installer->getConnection()->newTable(
            $installer->getTable('ewd_warehouse_shelf_item')
        )->addColumn(
            'item_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
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
            'qty',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            255,
            ['nullable' => false],
            'Qty'
        )->addColumn(
            'backorders',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false, 'default' => '0'],
            'Backorders'
        )->addColumn(
            'created_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created date'
        )->addColumn(
            'updated_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Last updated date'
        )->addForeignKey(
            $installer->getFkName(
                'ewd_warehouse_shelf_item',
                'warehouse_shelf_id',
                'ewd_warehouse_shelf',
                'warehouse_shelf_id'
            ),
            'warehouse_shelf_id',
            $installer->getTable('ewd_warehouse_shelf'),
            'warehouse_shelf_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'Warehuse Shelf Item Table'
        );
        
        $installer->getConnection()->createTable($table);
    }
}
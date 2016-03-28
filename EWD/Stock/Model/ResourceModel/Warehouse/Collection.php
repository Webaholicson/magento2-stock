<?php
namespace EWD\Stock\Model\ResourceModel\Warehouse;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Warehouse collection
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('EWD\Stock\Model\Warehouse', 'EWD\Stock\Model\ResourceModel\Warehouse');
        $this->_map['fields']['warehouse_id'] = 'main_table.warehouse_id';
    }
}
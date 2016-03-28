<?php
namespace EWD\Stock\Model\ResourceModel;

use  \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Warehouse entity resource model
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Warehouse extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('ewd_warehouse', 'warehouse_id');
    }
}
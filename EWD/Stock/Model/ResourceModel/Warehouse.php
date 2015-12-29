<?php
namespace EWD\Stock\Model\ResourceModel;

/**
 * Warehouse entity resource model
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Warehouse extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('ewd_warehouse', 'warehouse_id');
    }
}
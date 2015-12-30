<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace EWD\Stock\Model\ResourceModel\Warehouse;

/**
 * Warehouse collection
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('EWD\Stock\Model\Warehouse', 'EWD\Stock\Model\ResourceModel\Warehouse');
        $this->_map['fields']['warehouse_id'] = 'main_table.warehouse_id';
        //$this->_map['fields']['store'] = 'store_table.store_id';
    }
}
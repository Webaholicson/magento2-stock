<?php
namespace EWD\Stock\Block\Adminhtml\Warehouse\Edit;

/**
 * Warehouse left menu
 * 
 * @author     Antonio Mendes <webaholicson@gmail.com>
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('warehouse_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Warehouse Information'));
    }
}

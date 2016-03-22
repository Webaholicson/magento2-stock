<?php
namespace EWD\Stock\Block\Adminhtml;

/**
 * Adminhtml cms blocks content block
 */
class Warehouse extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'EWD_Stock';
        $this->_controller = 'adminhtml_block';
        $this->_headerText = __('Warehouses');
        $this->_addButtonLabel = __('Add New Warehouse');
        parent::_construct();
    }
}

<?php
namespace EWD\Stock\Block\Adminhtml;

/**
 * Adminhtml cms blocks content block
 * 
 * @author      Antonio Mendes <webaholicson@gmail.com>
 */
class Warehouse extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'EWD_Stock';
        $this->_controller = 'adminhtml_warehouse';
        $this->_headerText = __('Warehouses');
        $this->_addButtonLabel = __('Add New Warehouse');
        parent::_construct();
    }
    
    /**
     * @return string
     */
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/edit');
    }
}
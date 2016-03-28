<?php
namespace EWD\Stock\Controller\Adminhtml\Warehouse;

/**
 * Warehouse index action
 *
 * @author      Antonio Mendes <webaholicson@gmail.com>
 */
class Index extends \EWD\Stock\Controller\Adminhtml\Warehouse
{
    /**
     * EWD Stock management page
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('EWD_Stock::admin');
        $this->_addBreadcrumb(__('Stock'), __('Warehouses'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Warehouses'));
        $this->_view->renderLayout();
    }
}
<?php
namespace EWD\Stock\Controller\Adminhtml\Warehouse;

/**
 * Warehouse new action
 *
 * @author      Antonio Mendes <webaholicson@gmail.com>
 */
class NewAction extends \EWD\Stock\Controller\Adminhtml\Warehouse
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Cms::warehouse_save');
    }

    /**
     * Forward to edit page
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}

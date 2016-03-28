<?php
namespace EWD\Stock\Controller\Adminhtml;

/**
 * Warehouse manage blocks controller
 *
 * @author      Antonio Mendes <antoniom@internationalvapor.com>
 */
abstract class Stock extends \Magento\Backend\App\Action
{
    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EWD_Stock::stock');
    }
}
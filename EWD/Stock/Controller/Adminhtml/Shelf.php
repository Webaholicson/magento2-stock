<?php
namespace EWD\Stock\Controller\Adminhtml;

/**
 * Warehouse shelf controller
 *
 * @author Antonio Mendes <avmdausa@gmail.com>
 */
abstract class Shelf extends \EWD\Stock\Controller\Adminhtml\Stock
{
    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('EWD_Stock::warehouse');
    }
}
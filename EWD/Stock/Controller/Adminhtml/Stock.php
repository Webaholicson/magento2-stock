<?php
namespace EWD\Stock\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\Registry;
use Magento\Backend\App\Action\Context;

/**
 * Warehouse manage blocks controller
 *
 * @author      Antonio Mendes <antoniom@internationalvapor.com>
 */
abstract class Stock extends Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct( Context $context,  Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

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
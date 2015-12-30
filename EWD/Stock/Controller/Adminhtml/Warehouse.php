<?php
namespace EWD\Stock\Controller\Adminhtml;

/**
 * Warehouse manage blocks controller
 *
 * @author      Antonio Mendes <antoniom@internationalvapor.com>
 */
abstract class Warehouse extends \EWD\Stock\Controller\Adminhtml\Stock
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        parent::__construct($context, $coreRegistry);
    }
    
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
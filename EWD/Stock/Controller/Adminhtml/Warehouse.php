<?php
namespace EWD\Stock\Controller\Adminhtml;

use EWD\Stock\Controller\Adminhtml\Stock;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

/**
 * Warehouse manage blocks controller
 *
 * @author      Antonio Mendes <antoniom@internationalvapor.com>
 */
abstract class Warehouse extends Stock
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param \Registry $coreRegistry
     */
    public function __construct(Context $context, Registry $coreRegistry)
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
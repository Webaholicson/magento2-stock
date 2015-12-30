<?php
namespace EWD\Stock\Model;

class Warehouse extends \Magento\Framework\Model\AbstractModel
{
	/**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'stock_warehouse';

    /**
     * Parameter name in event
     *
     * In observe method you can use $observer->getEvent()->getObject() in this case
     *
     * @var string
     */
    protected $_eventObject = 'warehouse';

    /**
     * True if data changed
     *
     * @var bool
     */
    protected $_isStatusChanged = false;

    /**
     * Warehouse data
     *
     * @var \Magento\Warehouse\Helper\Data
     */
    protected $_warehouseData = null;

    /**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
		
    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('EWD\Stock\Model\ResourceModel\Warehouse');
    }
}
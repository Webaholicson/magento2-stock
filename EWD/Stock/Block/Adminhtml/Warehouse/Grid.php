<?php
namespace EWD\Stock\Block\Adminhtml\Warehouse;

/**
 * Adminhtml cms pages grid
 *
 * @author      Antonio Mendes <webaholicson@gmail.com>
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param array $data
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \EWD\Stock\Model\ResourceModel\Warehouse\Grid\Collection $collection,
        array $data = []
    ) {
        $this->_collection = $collection;
        $this->_backendHelper = $backendHelper;
        $this->_backendSession = $context->getBackendSession();
        parent::__construct($context, $backendHelper);
    }
    
    /**
     * @return void
     */
    protected function _construct()
    {        
        parent::_construct();
        $this->setId('warehouseGrid');
        $this->setDefaultSort('identifier');
        $this->setDefaultDir('ASC');
    }

    /**
     * Row click url
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['warehouse_id' => $row->getId()]);
    }
    
    /**
     * Initialize grid columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn('warehouse_id', [
            'header' => __('ID'),
            'index' => 'warehouse_id',
        ]);
        
        $this->addColumn('warehouse_code', [
            'header' => __('Code'),
            'index' => 'warehouse_code',
        ]);
        
        $this->addColumn('warehouse_contact_name', [
            'header' => __('Contact Name'),
            'index' => 'warehouse_contact_name',
        ]);
        
        $this->addColumn('warehouse_contact_email', [
            'header' => __('Contact Email'),
            'index' => 'warehouse_contact_email',
        ]);
        
        $this->addColumn('created_date', [
            'header' => __('Created On'),
            'index' => 'created_date',
        ]);
        
        $this->addColumn('updated_date', [
            'header' => __('Updated On'),
            'index' => 'updated_date',
        ]);
        
        return parent::_prepareColumns();
    }
}
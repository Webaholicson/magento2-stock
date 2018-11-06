<?php
namespace EWD\Stock\Block\Adminhtml\Warehouse\Edit\Tab;

use Magento\Catalog\Block\Adminhtml\Product\Grid;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Warehouse products tab
 * 
 * @author     Antonio Mendes <webaholicson@gmail.com>
 */
class Products extends Grid implements TabInterface
{
    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = parent::_prepareCollection();
        
        $collection->join(
            ['shelfItem' => 'ewd_warehouse_shelf_item']
            "shelfItem.prouct_id = main.id",
            ''
        )->join(
            ['shelf' => 'ewd_warehouse_shelf']
            "shelf.id = shelfItem.warehouse_shelf_id",
            'shelf.name'
        );

        $collection->addFieldToFilter(
            'shelf.warehouse_id',
            $this->getWarehouseData()->getId()
        );

        return $this;
    }

    private function getWarehouseId()
    {
        return $this->getWarehouseData()->getId();
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        
        $this->removeColumn('set_name');
        $this->removeColumn('visibility');
        $this->removeColumn('type');
        
        $this->getColumn('edit')->setActions([
            [
                'caption' => __('Manage Shelves'),
                'url' => '#',
                'onclick' => 'return warehouse.manageShelves();',
            ]
        ]);
        
        return $this;
    }
    
    protected function _prepareMassaction()
    {
        return $this;
    }
    
    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Warehouse Products');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Warehouse Products');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
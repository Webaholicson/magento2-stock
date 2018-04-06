<?php
namespace EWD\Stock\Plugin\Catalog\Block\Adminhtml\Product\Edit\Tabs;

use Magento\Framework\Translate\InlineInterface;

/**
 * Plugin for catalog product shelves
 */
class Shelf
{
    /**
     * @var InlineInterface
     */
    protected $_translateInline;
    
    /**
     * @param InlineInterface $translateInline
     */
    public function __construct(
        InlineInterface $translateInline
    ) {
        $this->_translateInline = $translateInline;;  
    }
    
    /**
     * Add shelf tab to product edit accordion
     *
     * @param \Magento\Catalog\Block\Adminhtml\Product\Edit\Tabs $subject
     * @return void
     * @SuppressWarnings("PMD.UnusedFormalParameter")
     */
    public function beforeToHtml(
        \Magento\Catalog\Block\Adminhtml\Product\Edit\Tabs $subject
    ) {
        error_log('testa');
        
        $subject->addTab(
            'warehouse_shelves',
            [
                'label' => __('Warehouse Shelves'),
                'content' => $this->_translateHtml(
                    $subject->getLayout()->createBlock(
                        \EWD\Stock\Block\Adminhtml\Shelf\Tab::class
                    )->toHtml()
                ),
                'class' => 'user-defined',
                'group_code' => $subject::BASIC_TAB_GROUP_CODE
            ]
        );
    }
    
    /**
     * Translate html content
     *
     * @param string $html
     * @return string
     */
    protected function _translateHtml($html)
    {
        $this->_translateInline->processResponseBody($html);
        return $html;
    }
}
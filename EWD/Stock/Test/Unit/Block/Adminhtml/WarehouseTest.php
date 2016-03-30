<?php
namespace EWD\Stock\Test\Block\Adminhtml;

use \Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 *  Test the Warehouse grid container
 * 
 *  @author Antonio Mendes <webaholicson@gmail.com>
 * 
 */
class WarehouseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EWD\Stock\Block\Adminhtml\Warehouse
     */
    protected $_block;
    
    /**
     * @var EWD\Stock\Block\Adminhtml\Warehouse|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_mock;
    
    /**
     * @var \Magento\Backend\Block\Widget\Context|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_context;
    
    /**
     * @var \Magento\Framework\Url|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_urlBuilder;
    
    /**
     * @var \Magento\Backend\Block\Widget\Button\ButtonList|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_buttonList;
    
    protected function setUp()
    {
        $objectManager = new ObjectManager($this);
        
        $this->_context = $this->getMockBuilder('\Magento\Backend\Block\Widget\Context')
            ->setMethods(['getUrlBuilder', 'getButtonList'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_urlBuilder = $this->getMockBuilder('\Magento\Framework\Url')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_buttonList = $this->getMockBuilder('\Magento\Backend\Block\Widget\Button\ButtonList')
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getUrlBuilder')
            ->willReturn($this->_urlBuilder);
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getButtonList')
            ->willReturn($this->_buttonList);
        
        $this->_buttonList->expects($this->atLeastOnce())
            ->method('add');
        
        $this->_block = $objectManager->getObject('\EWD\Stock\Block\Adminhtml\Warehouse', [
            'context' => $this->_context
        ]);
        
        $this->_mock = $this->getMockBuilder('\EWD\Stock\Block\Adminhtml\Warehouse')
            ->disableOriginalConstructor()
            ->setMethods(['getUrl'])
            ->getMock();
    }
    
    /**
     *  Test _construct function
     * 
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse::_construct
     *  @author Antonio Mendes <webaholicson@gmail.com>
     * 
     */
    public function testConstruct()
    {
        $blockGroup = new \ReflectionProperty('\EWD\Stock\Block\Adminhtml\Warehouse', '_blockGroup');
        $controller = new \ReflectionProperty('\EWD\Stock\Block\Adminhtml\Warehouse', '_controller');
        
        $blockGroup->setAccessible(true);
        $controller->setAccessible(true);
        
        $this->assertEquals($this->_block->getHeaderText(), __('Warehouses'));
        $this->assertEquals($blockGroup->getValue($this->_block), 'EWD_Stock');
        $this->assertEquals($controller->getValue($this->_block), 'adminhtml_warehouse');
    }
    
    /**
     *  Test gettin the create url
     * 
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse::getCreateUrl
     *  @author Antonio Mendes <webaholicson@gmail.com>
     * 
     */
    public function testGetCreateUrl()
    {
        $this->_mock->expects($this->once())
            ->method('getUrl')
            ->with($this->equalTo('*/*/edit'))
            ->willReturn($this->_block->getCreateUrl());
        
        $this->assertEquals($this->_mock->getCreateUrl(), $this->_block->getCreateUrl());
    }
}

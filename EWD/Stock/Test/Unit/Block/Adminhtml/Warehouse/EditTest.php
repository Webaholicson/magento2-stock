<?php
namespace EWD\Stock\Test\Block\Adminhtml\Warehouse;

use \Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

/**
 *  Test the Warehouse edit container
 *  @author Antonio Mendes <webaholicson@gmail.com>
 */
class EditTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    protected $_objectManager;
    
    /**
     * @var EWD\Stock\Block\Adminhtml\Warehouse\Edit
     */
    protected $_block;
    
    /**
     * @var EWD\Stock\Block\Adminhtml\Warehouse\Edit|\PHPUnit_Framework_MockObject_MockObject
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
     * @var \Magento\Framework\DataObject|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_dataObject;
    
    /**
     * @var  \Magento\Framework\Registry|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_registry;
    
    /**
     * @var  \Magento\Framework\Authorization|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_authorization;
    
    /**
     * @var  \Magento\Framework\App\Request\Http|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_request;
    
    /**
     * @var \Magento\Backend\Block\Widget\Button\ButtonList|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_buttonList;
    
    /**
     * @var \Magento\Framework\Escaper|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $_escaper;
    
    protected function setUp()
    {
        $this->_objectManager = new ObjectManager($this);
        
        $this->_context = $this->getMockBuilder('\Magento\Backend\Block\Widget\Context')
            ->setMethods(['getUrlBuilder', 'getButtonList', 'getRequest', 'getAuthorization', 'getEscaper'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_urlBuilder = $this->getMockBuilder('\Magento\Framework\Url')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_buttonList = $this->getMockBuilder('\Magento\Backend\Block\Widget\Button\ButtonList')
            ->setMethods(['add', 'remove', 'update'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_registry = $this->getMockBuilder('\Magento\Framework\Registry')
            ->disableOriginalConstructor()
            ->setMethods(['registry'])
            ->getMock();
        
        $this->_authorization = $this->getMockBuilder('\Magento\Framework\Authorization')
            ->disableOriginalConstructor()
            ->setMethods(['isAllowed'])
            ->getMock();
        
        $this->_request = $this->getMockBuilder('\Magento\Framework\App\Request\Http')
            ->setMethods(['getParam'])
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_escaper = $this->getMockBuilder('\Magento\Framework\Escaper')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->_dataObject = $this->getMockBuilder('\Magento\Framework\DataObject')
            ->setMethods(['getId', 'getCode'])
            ->getMock();
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getButtonList')
            ->willReturn($this->_buttonList);
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getAuthorization')
            ->willReturn($this->_authorization);
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getUrlBuilder')
            ->willReturn($this->_urlBuilder);
        
        $this->_context->expects($this->atLeastOnce())
            ->method('getRequest')
            ->willReturn($this->_request);
    }
    
    /**
     *  Test to make sure we can create/edit warehouses if we have
     *  permissions
     * 
     *  @author Antonio Mendes <webaholicson@gmail.com>
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Edit::_construct
     * 
     */
    public function testCanEditWarehouses()
    {
        $this->_authorization->expects($this->exactly(1))
            ->method('isAllowed')
            ->with($this->equalTo('EWD_Stock::warehouse_save'))
            ->will($this->returnValue(true));
        
        $this->_buttonList->expects($this->atLeastOnce())
            ->method('add')
            ->withConsecutive(
                array($this->equalTo('back')),
                array($this->equalTo('reset')),
                array($this->equalTo('save')),
                array($this->equalTo('saveandcontinue'))
            );
        
        $this->_buttonList->expects($this->atLeastOnce())
            ->method('remove')
            ->withConsecutive(
                array($this->equalTo('delete')),
                array($this->equalTo('save'))
            );
        
        $this->_buttonList->expects($this->atLeastOnce())
            ->method('update')
            ->with(
                $this->equalTo('save'), 
                $this->equalTo('label'),
                $this->equalTo(__('Save Warehouse'))
            );
        
        $this->_block = $this->_objectManager->getObject('\EWD\Stock\Block\Adminhtml\Warehouse\Edit', [
            'context' => $this->_context,
            'registry' => $this->_registry
        ]);
        
        $className = '\EWD\Stock\Block\Adminhtml\Warehouse\Edit';
        $objectId = new \ReflectionProperty($className, '_objectId');
        $blockGroup = new \ReflectionProperty($className, '_blockGroup');
        $controller = new \ReflectionProperty($className, '_controller');
        
        $objectId->setAccessible(true);
        $blockGroup->setAccessible(true);
        $controller->setAccessible(true);
        
        $this->assertEquals($objectId->getValue($this->_block), 'warehouse_id');
        $this->assertEquals($blockGroup->getValue($this->_block), 'EWD_Stock');
        $this->assertEquals($controller->getValue($this->_block), 'adminhtml_warehouse');
    }
    
    /**
     *  Test to make sure permissions are being enforced
     * 
     *  @author Antonio Mendes <webaholicson@gmail.com>
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Edit::_construct
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Edit::_isAllowedAction
     */
    public function testCannotEditWarehouses()
    {
        $this->_authorization->expects($this->exactly(1))
            ->method('isAllowed')
            ->with($this->equalTo('EWD_Stock::warehouse_save'))
            ->will($this->returnValue(false));
        
        $this->_buttonList->expects($this->atLeastOnce())
            ->method('add')
            ->withConsecutive(
                array($this->equalTo('back')),
                array($this->equalTo('reset')),
                array($this->equalTo('save'))
            );
        
        $this->_buttonList->expects($this->atLeastOnce())
            ->method('remove')
            ->withConsecutive(
                array($this->equalTo('save')),
                array($this->equalTo('delete'))
            );
        
        $this->_block = $this->_objectManager->getObject('\EWD\Stock\Block\Adminhtml\Warehouse\Edit', [
            'context' => $this->_context,
            'registry' => $this->_registry
        ]);
    }
    
    /**
     *  Test getting the header text
     * 
     *  @author Antonio Mendes <webaholicson@gmail.com>
     *  @group warehouse
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Edit::getHeaderText
     *  @covers \EWD\Stock\Block\Adminhtml\Warehouse\Edit::_isAllowedAction
     * 
     */
    public function testGetHeaderText()
    {        
        $this->_context->expects($this->atLeastOnce())
            ->method('getEscaper')
            ->willReturn($this->_escaper);
        
        $this->_dataObject->expects($this->exactly(2))
            ->method('getId')
            ->will($this->onConsecutiveCalls(1,0));
        
        $this->_dataObject->expects($this->once())
            ->method('getCode')
            ->willReturn('main');
        
        $this->_request->expects($this->atLeastOnce())
            ->method('getParam')
            ->willReturn(null);
        
        $this->_registry->expects($this->exactly(3))
            ->method('registry')
            ->willReturn($this->_dataObject);
        
        $this->_mock = $this->getMockBuilder('\EWD\Stock\Block\Adminhtml\Warehouse\Edit')
            ->setConstructorArgs(array($this->_context, $this->_registry))
            ->setMethods(['getUrl'])
            ->getMock();
        
        $this->assertContains('Edit Warehouse', $this->_mock->getHeaderText()->getText());
        $this->assertContains('New Warehouse', $this->_mock->getHeaderText()->getText());
    }
}
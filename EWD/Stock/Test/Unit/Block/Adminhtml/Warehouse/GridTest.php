<?php
namespace EWD\Stock\Test\Block\Adminhtml\Warehouse;

class GridTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test to make sure the click on Add New Warehouse button is there
     * 
     * @author Antonio Mendes <webaholicson@gmail.com>
     * @group unit
     * @group warehouse
     * @covers \EWD\Stock\Block\Adminhtml\Warehouse\Gird::getButtonLabel
     */
    public function testAddNewWrehouseButton()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->method('getAddButtonLabel')->willReturn('Add New Warehouse');
        $this->assertEquals($mock->getAddButtonLabel(), 'Add New Warehouse');
    }
    
    public function testGetHeaderText()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->method('getHeaderText')->willReturn('Warehouses');
        $this->assertEquals($mock->getHeaderText(), 'Warehouses');
    }
    
    public function testParamBlockGroup()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->expects($this->once())
                ->method('getDataByKey')
                ->with($this->equalTo('block_group'))
                ->willReturn('EWD_Stock');
        
        $this->assertEquals($mock->getDataByKey('block_group'), 'EWD_Stock');
    }
    
    public function testParamController()
    {
        $mock = $this->getMockBuilder('EWD\Stock\Block\Adminhtml\Warehouse')
                ->disableOriginalConstructor()
                ->getMock();
        
        $mock->expects($this->once())
                ->method('getDataByKey')
                ->with($this->equalTo('controller'))
                ->willReturn('adminhtml_block');
        
        $this->assertEquals($mock->getDataByKey('controller'), 'adminhtml_block');
    }
}

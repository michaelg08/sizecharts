<?php
namespace UIS\Sizecharts\Block\Adminhtml;
class Sizecharts extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_sizecharts';/*block grid.php directory*/
        $this->_blockGroup = 'UIS_Sizecharts';
        $this->_headerText = __('Sizecharts');
        $this->_addButtonLabel = __('Add New Entry'); 
        parent::_construct();
		
    }
}

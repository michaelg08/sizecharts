<?php


namespace UIS\Sizecharts\Model\ResourceModel;

class Sizecharts extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('uis_sizecharts', 'sizecharts_id');
    }
}

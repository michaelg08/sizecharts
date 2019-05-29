<?php


namespace UIS\Sizecharts\Model\ResourceModel\Sizecharts;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'UIS\Sizecharts\Model\Sizecharts',
            'UIS\Sizecharts\Model\ResourceModel\Sizecharts'
        );
    }
}

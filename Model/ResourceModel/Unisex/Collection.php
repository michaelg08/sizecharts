<?php


namespace UIS\Sizecharts\Model\ResourceModel\Unisex;

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
            'UIS\Sizecharts\Model\Unisex',
            'UIS\Sizecharts\Model\ResourceModel\Unisex'
        );
    }
}

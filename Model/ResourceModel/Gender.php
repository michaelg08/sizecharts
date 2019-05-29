<?php


namespace UIS\Sizecharts\Model\ResourceModel;

class Gender extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('uis_gender', 'gender_id');
    }
}

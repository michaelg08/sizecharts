<?php


namespace UIS\Sizecharts\Model;

use UIS\Sizecharts\Api\Data\GenderInterface;

class Gender extends \Magento\Framework\Model\AbstractModel implements GenderInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('UIS\Sizecharts\Model\ResourceModel\Gender');
    }

    /**
     * Get gender_id
     * @return string
     */
    public function getGenderId()
    {
        return $this->getData(self::GENDER_ID);
    }

    /**
     * Set gender_id
     * @param string $genderId
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */
    public function setGenderId($genderId)
    {
        return $this->setData(self::GENDER_ID, $genderId);
    }

    /**
     * Get id
     * @return string
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set id
     * @param string $id
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get unisex_size
     * @return string
     */
    public function getMensSize()
    {
        return $this->getData(self::MENS_SIZE);
    }

    /**
     * Set unisex_size
     * @param string $unisex_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */
    public function setMensSize($unisex_size)
    {
        return $this->setData(self::MENS_SIZE, $unisex_size);
    }

    /**
     * Get uk_size
     * @return string
     */
    public function getUkSize()
    {
        return $this->getData(self::UK_SIZE);
    }

    /**
     * Set uk_size
     * @param string $uk_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */
    public function setUkSize($uk_size)
    {
        return $this->setData(self::UK_SIZE, $uk_size);
    }

    /**
     * Get eu_size
     * @return string
     */
    public function getEuSize()
    {
        return $this->getData(self::EU_SIZE);
    }

    /**
     * Set eu_size
     * @param string $eu_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */
    public function setEuSize($eu_size)
    {
        return $this->setData(self::EU_SIZE, $eu_size);
    }

    /**
     * Get mm_size
     * @return string
     */
    public function getMmSize()
    {
        return $this->getData(self::MM_SIZE);
    }

    /**
     * Set mm_size
     * @param string $mm_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */
    public function setMmSize($mm_size)
    {
        return $this->setData(self::MM_SIZE, $mm_size);
    }

    /**
     * Get label_id
     * @return string
     */
    public function getLabelId()
    {
        return $this->getData(self::LABEL_ID);
    }

    /**
     * Set label_id
     * @param string $label_id
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */
    public function setLabelId($label_id)
    {
        return $this->setData(self::LABEL_ID, $label_id);
    }
}

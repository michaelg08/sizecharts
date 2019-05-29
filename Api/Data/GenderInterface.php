<?php

namespace UIS\Sizecharts\Api\Data;

interface GenderInterface
{

    const EU_SIZE = 'eu_size';
    const LABEL_ID = 'label_id';
    const GENDER_ID = 'gender_id';
    const MM_SIZE = 'mm_size';
    const MENS_SIZE = 'mens_size';
    const ID = 'id';
    const UK_SIZE = 'uk_size';


    /**
     * Get gender_id
     * @return string|null
     */

    public function getGenderId();

    /**
     * Set gender_id
     * @param string $gender_id
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */

    public function setGenderId($genderId);

    /**
     * Get id
     * @return string|null
     */

    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */

    public function setId($id);

    /**
     * Get unisex_size
     * @return string|null
     */

    public function getMensSize();

    /**
     * Set unisex_size
     * @param string $unisex_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */

    public function setMensSize($unisex_size);

    /**
     * Get uk_size
     * @return string|null
     */

    public function getUkSize();

    /**
     * Set uk_size
     * @param string $uk_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */

    public function setUkSize($uk_size);

    /**
     * Get eu_size
     * @return string|null
     */

    public function getEuSize();

    /**
     * Set eu_size
     * @param string $eu_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */

    public function setEuSize($eu_size);

    /**
     * Get mm_size
     * @return string|null
     */

    public function getMmSize();

    /**
     * Set mm_size
     * @param string $mm_size
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */

    public function setMmSize($mm_size);

    /**
     * Get label_id
     * @return string|null
     */

    public function getLabelId();

    /**
     * Set label_id
     * @param string $label_id
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     */

    public function setLabelId($label_id);
}

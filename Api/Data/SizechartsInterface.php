<?php

namespace UIS\Sizecharts\Api\Data;

interface SizechartsInterface
{

    const SIZECHARTS_ID = 'sizecharts_id';
    const ID = 'id';
    const SIZECHART_ACTIVE_FROM = 'sizechart_active_from';
    const IS_UNISEX = 'is_unisex';
    const SIZECHARTS_LABEL = 'sizecharts_label';


    /**
     * Get sizecharts_id
     * @return string|null
     */

    public function getSizechartsId();

    /**
     * Set sizecharts_id
     * @param string $sizecharts_id
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface
     */

    public function setSizechartsId($sizechartsId);

    /**
     * Get id
     * @return string|null
     */

    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface
     */

    public function setId($id);

    /**
     * Get sizecharts_label
     * @return string|null
     */

    public function getSizechartsLabel();

    /**
     * Set sizecharts_label
     * @param string $sizecharts_label
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface
     */

    public function setSizechartsLabel($sizecharts_label);

    /**
     * Get is_unisex
     * @return string|null
     */

    public function getIsUnisex();

    /**
     * Set is_unisex
     * @param string $is_unisex
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface
     */

    public function setIsUnisex($is_unisex);

    /**
     * Get sizechart_active_from
     * @return string|null
     */

    public function getSizechartActiveFrom();

    /**
     * Set sizechart_active_from
     * @param string $sizechart_active_from
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface
     */

    public function setSizechartActiveFrom($sizechart_active_from);
}

<?php

namespace UIS\Sizecharts\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SizechartsRepositoryInterface
{


    /**
     * Save Sizecharts
     * @param \UIS\Sizecharts\Api\Data\SizechartsInterface $sizecharts
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \UIS\Sizecharts\Api\Data\SizechartsInterface $sizecharts
    );

    /**
     * Retrieve Sizecharts
     * @param string $sizechartsId
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($sizechartsId);

    /**
     * Retrieve Sizecharts matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \UIS\Sizecharts\Api\Data\SizechartsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Sizecharts
     * @param \UIS\Sizecharts\Api\Data\SizechartsInterface $sizecharts
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \UIS\Sizecharts\Api\Data\SizechartsInterface $sizecharts
    );

    /**
     * Delete Sizecharts by ID
     * @param string $sizechartsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($sizechartsId);
}

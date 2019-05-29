<?php

namespace UIS\Sizecharts\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface GenderRepositoryInterface
{


    /**
     * Save Gender
     * @param \UIS\Sizecharts\Api\Data\GenderInterface $gender
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function save(
        \UIS\Sizecharts\Api\Data\GenderInterface $gender
    );

    /**
     * Retrieve Gender
     * @param string $genderId
     * @return \UIS\Sizecharts\Api\Data\GenderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function getById($genderId);

    /**
     * Retrieve Gender matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \UIS\Sizecharts\Api\Data\GenderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Gender
     * @param \UIS\Sizecharts\Api\Data\GenderInterface $gender
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function delete(
        \UIS\Sizecharts\Api\Data\GenderInterface $gender
    );

    /**
     * Delete Gender by ID
     * @param string $genderId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function deleteById($genderId);
}

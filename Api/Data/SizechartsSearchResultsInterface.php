<?php

namespace UIS\Sizecharts\Api\Data;

interface SizechartsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Sizecharts list.
     * @return \UIS\Sizecharts\Api\Data\SizechartsInterface[]
     */
    
    public function getItems();

    /**
     * Set id list.
     * @param \UIS\Sizecharts\Api\Data\SizechartsInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}

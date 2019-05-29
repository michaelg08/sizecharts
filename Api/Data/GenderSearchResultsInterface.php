<?php

namespace UIS\Sizecharts\Api\Data;

interface GenderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Gender list.
     * @return \UIS\Sizecharts\Api\Data\GenderInterface[]
     */
    
    public function getItems();

    /**
     * Set id list.
     * @param \UIS\Sizecharts\Api\Data\GenderInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}

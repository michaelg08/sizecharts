<?php

namespace UIS\Sizecharts\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Store\Model\StoreManagerInterface;
use UIS\Sizecharts\Api\SizechartsRepositoryInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use UIS\Sizecharts\Model\ResourceModel\Sizecharts as ResourceSizecharts;
use UIS\Sizecharts\Api\Data\SizechartsSearchResultsInterfaceFactory;
use UIS\Sizecharts\Model\ResourceModel\Sizecharts\CollectionFactory as SizechartsCollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SortOrder;
use UIS\Sizecharts\Api\Data\SizechartsInterfaceFactory;

class SizechartsRepository implements SizechartsRepositoryInterface {

    protected $dataSizechartsFactory;
    protected $resource;
    protected $sizechartsFactory;
    protected $dataObjectHelper;
    protected $sizechartsCollectionFactory;
    protected $searchResultsFactory;
    private $storeManager;
    protected $dataObjectProcessor;

    /**
     * @param ResourceSizecharts $resource
     * @param SizechartsFactory $sizechartsFactory
     * @param SizechartsInterfaceFactory $dataSizechartsFactory
     * @param SizechartsCollectionFactory $sizechartsCollectionFactory
     * @param SizechartsSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
    ResourceSizecharts $resource, SizechartsFactory $sizechartsFactory, SizechartsInterfaceFactory $dataSizechartsFactory, SizechartsCollectionFactory $sizechartsCollectionFactory, SizechartsSearchResultsInterfaceFactory $searchResultsFactory, DataObjectHelper $dataObjectHelper, DataObjectProcessor $dataObjectProcessor, StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->sizechartsFactory = $sizechartsFactory;
        $this->sizechartsCollectionFactory = $sizechartsCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataSizechartsFactory = $dataSizechartsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
    \UIS\Sizecharts\Api\Data\SizechartsInterface $sizecharts
    ) {
        /* if (empty($sizecharts->getStoreId())) {
          $storeId = $this->storeManager->getStore()->getId();
          $sizecharts->setStoreId($storeId);
          } */
        try {
            $sizecharts->getResource()->save($sizecharts);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                    'Could not save the sizecharts: %1', $exception->getMessage()
            ));
        }
        return $sizecharts;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($sizechartsId) {
        $sizecharts = $this->sizechartsFactory->create();
        $sizecharts->getResource()->load($sizecharts, $sizechartsId);
        if (!$sizecharts->getId()) {
            throw new NoSuchEntityException(__('Sizecharts with id "%1" does not exist.', $sizechartsId));
        }
        return $sizecharts;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
    \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->sizechartsCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                        $sortOrder->getField(), ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
    \UIS\Sizecharts\Api\Data\SizechartsInterface $sizecharts
    ) {
        try {
            $sizecharts->getResource()->delete($sizecharts);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                    'Could not delete the Sizecharts: %1', $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($sizechartsId) {
        return $this->delete($this->getById($sizechartsId));
    }

}

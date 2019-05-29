<?php


namespace UIS\Sizecharts\Model;

use UIS\Sizecharts\Api\GenderRepositoryInterface;
use UIS\Sizecharts\Model\ResourceModel\Gender as ResourceGender;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Store\Model\StoreManagerInterface;
use UIS\Sizecharts\Api\Data\GenderSearchResultsInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use UIS\Sizecharts\Model\ResourceModel\Gender\CollectionFactory as GenderCollectionFactory;
use UIS\Sizecharts\Api\Data\GenderInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SortOrder;

class GenderRepository implements GenderRepositoryInterface
{

    protected $genderFactory;

    protected $resource;

    protected $dataObjectHelper;

    protected $genderCollectionFactory;

    protected $searchResultsFactory;

    private $storeManager;

    protected $dataObjectProcessor;

    protected $dataGenderFactory;


    /**
     * @param ResourceGender $resource
     * @param GenderFactory $genderFactory
     * @param GenderInterfaceFactory $dataGenderFactory
     * @param GenderCollectionFactory $genderCollectionFactory
     * @param GenderSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceGender $resource,
        GenderFactory $genderFactory,
        GenderInterfaceFactory $dataGenderFactory,
        GenderCollectionFactory $genderCollectionFactory,
        GenderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->genderFactory = $genderFactory;
        $this->genderCollectionFactory = $genderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataGenderFactory = $dataGenderFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \UIS\Sizecharts\Api\Data\GenderInterface $gender
    ) {
        /* if (empty($gender->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $gender->setStoreId($storeId);
        } */
        try {
            $gender->getResource()->save($gender);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the gender: %1',
                $exception->getMessage()
            ));
        }
        return $gender;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($genderId)
    {
        $gender = $this->genderFactory->create();
        $gender->getResource()->load($gender, $genderId);
        if (!$gender->getId()) {
            throw new NoSuchEntityException(__('Gender with id "%1" does not exist.', $genderId));
        }
        return $gender;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->genderCollectionFactory->create();
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
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
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
        \UIS\Sizecharts\Api\Data\GenderInterface $gender
    ) {
        try {
            $gender->getResource()->delete($gender);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Gender: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($genderId)
    {
        return $this->delete($this->getById($genderId));
    }
}

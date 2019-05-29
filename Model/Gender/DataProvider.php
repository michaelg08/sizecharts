<?php


namespace UIS\Sizecharts\Model\Gender;

use Magento\Framework\App\Request\DataPersistorInterface;
use UIS\Sizecharts\Model\ResourceModel\Gender\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;

    protected $loadedData;
    protected $dataPersistor;
    /**
     * @var \Magento\Ui\DataProvider\AddFieldToCollectionInterface[]
     */
    private $addFieldStrategies;
    /**
     * @var \Magento\Ui\DataProvider\AddFilterToCollectionInterface[]
     */
    private $addFilterStrategies;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
		array $addFieldStrategies = [],
        array $addFilterStrategies = []
    ) {
		parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
		
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
/* 		$this->addFieldStrategies  = $addFieldStrategies;
		$this->addFilterStrategies = $addFilterStrategies; */
		
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
/*         if (isset($this->loadedData)) {
            return $this->loadedData;
        } */
			
        //$items = $this->collection->getItems();
			
		$collection = $this->collection; 
		
		if ($this->getRequest()->getParam('label_id')) {
			
			$label_id = $this->getRequest()->getParam('label_id');
			$collection->addFieldToFilter('label_id', $label_id);
			
		}
		
		$items->getItems();
		
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
        }
        $data = $this->dataPersistor->get('uis_sizecharts_gender');
        
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('uis_sizecharts_gender');
        }
        
        return $this->loadedData;
    }
	
	 /**
     * Add field to select
     *
     * @param string|array $field The field
     * @param string|null  $alias Alias for the field
     *
     * @return void
     */
    public function addField($field, $alias = null)
    {
        if (isset($this->addFieldStrategies[$field])) {
            $this->addFieldStrategies[$field]->addField($this->getCollection(), $field, $alias);
            return;
        }
        parent::addField($field, $alias);
    }
    /**
     * {@inheritdoc}
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        if (isset($this->addFilterStrategies[$filter->getField()])) {
            $this->addFilterStrategies[$filter->getField()]
                ->addFilter(
                    $this->getCollection(),
                    $filter->getField(),
                    [$filter->getConditionType() => $filter->getValue()]
                );
            return;
        }
        parent::addFilter($filter);
    }
	
}

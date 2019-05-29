<?php
/**
 * Copyright © 2015 UIS . All rights reserved.
 */
namespace UIS\Sizecharts\Block;
use Magento\Framework\UrlFactory;
class Sizecharts extends \Magento\Framework\View\Element\Template
{
	/**
     * @var \UIS\Sizecharts\Helper\Data
     */
	 protected $_devToolHelper;
	 
	 /**
     * @var \Magento\Framework\Url
     */
	 protected $_urlApp;
	 
	 /**
     * @var \UIS\Sizecharts\Model\Config
     */
    protected $_config;

	protected $_registry;

    /**
     * @param \UIS\Sizecharts\Block\Context $context
	 * @param \Magento\Framework\UrlFactory $urlFactory
     */
    public function __construct( \UIS\Sizecharts\Block\Context $context
	)
    {
        $this->_devToolHelper = $context->getSizechartsHelper();
		$this->_config = $context->getConfig();
        $this->_urlApp=$context->getUrlFactory()->create();
		$this->_registry=$context->getRegistry();
		parent::__construct($context);
	
    }
	
	/**
	 * Function for getting event details
	 * @return array
	 */
    public function getEventDetails()
    {
		return  $this->_devToolHelper->getEventDetails();
    }
	
	/**
     * Function for getting current url
	 * @return string
     */
	public function getCurrentUrl(){
		return $this->_urlApp->getCurrentUrl();
	}
	
	/**
     * Function for getting controller url for given router path
	 * @param string $routePath
	 * @return string
     */
	public function getControllerUrl($routePath){
		
		return $this->_urlApp->getUrl($routePath);
	}
	
	/**
     * Function for getting current url
	 * @param string $path
	 * @return string
     */
	public function getConfigValue($path){
		return $this->_config->getCurrentStoreConfigValue($path);
	}
	
	/**
     * Function canShowSizecharts
	 * @return bool
     */
	public function canShowSizecharts(){
		$isEnabled=$this->getConfigValue('sizecharts/module/is_enabled');
		if($isEnabled)
		{
			$allowedIps=$this->getConfigValue('sizecharts/module/allowed_ip');
			 if(is_null($allowedIps)){
				return true;
			}
			else {
				$remoteIp=$_SERVER['REMOTE_ADDR'];
				if (strpos($allowedIps,$remoteIp) !== false) {
					return true;
				}
			}
		}
		return false;
	}
	
	public function getSizeCharts($sizechartLabel) {

		$sizechartsItem = '';
		if ($sizechartLabel) {

			//$sizechartModel = \Magento\Framework\App\ObjectManager::getInstance()->get('\UIS\Sizecharts\Model\Sizecharts');
			$sizecharts = $this->loadByLabel($sizechartLabel);
			$sizechartsItem = $sizecharts->getFirstItem();

		}

		return $sizechartsItem;
    }
	
	public function getProduct() {
		$this->_product = $this->_registry->registry('product');
		return $this->_product;
    }

	public function getSizeChartsData($sizechart) {

		$sizechartData = array();
		if 	($sizechart) {
			$sizechartDataInstance = \Magento\Framework\App\ObjectManager::getInstance()->get('\UIS\Sizecharts\Model\Gender'); 
			$sizechartData = $sizechartDataInstance->getCollection()->addFieldToFilter('label_id', (int)$sizechart->getId());
		}
		return $sizechartData;
	}
	
		public function getProductGender($product){
		
		$_objectManager = \Magento\Framework\App\ObjectManager::getInstance();	
		if ($product) {
			$cats = $product->getCategoryIds();
			$categoryNames = array();
			
			foreach ($cats as $categoryId) {
				$lastId = $categoryId; 
			} 

			$cat = $_objectManager->get('\Magento\Catalog\Model\Category')->load($lastId) ;
			$path = $cat->getPath();

			$categoryIds = explode('/', $path);

		    unset($categoryIds[0]);

			$gender = '';

			if (in_array(3, $categoryIds)) {
				$gender = 'mens';
			}

			if (in_array(4, $categoryIds)) {
				$gender = 'womens';
			}

			if ($gender == '') {
				if (stristr($product->getName(), 'men')) {
					$gender = 'mens';
				}

				if (stristr($product->getName(), 'women')) {
					$gender = 'womens';
				}
			}
			return $gender;

		}

		return '';
	} 
		
	public function hasSizechart($sizechart) {
		if ($sizechart->getUkSize() || $sizechart->getEuSize() || $sizechart->getMmSize()) {
			return true;
		} 
		return false;
	}
	
	public function loadByLabel($sizechartLabel) {

		$collection = \Magento\Framework\App\ObjectManager::getInstance()->get('UIS\Sizecharts\Model\ResourceModel\Sizecharts\Collection')
							->addFieldToFilter('sizecharts_label', $sizechartLabel)
							->load();
		if ($collection) {
			return $collection; 
		} else {
			return array(); 
		}
	}
	
	public function getHelper() {
		return $this->_devToolHelper;
	}
}

<?php


namespace UIS\Sizecharts\Controller\Adminhtml\Sizecharts;

use Magento\Framework\Exception\LocalizedException;
use \UIS\Sizecharts\Model\Gender as Gender;

class Save extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;
    protected $dataPersistor;
    protected $gender; 

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, 
        \UIS\Sizecharts\Model\Gender $gender 
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        

        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('sizecharts_id');
        
            $model = $this->_objectManager->create('UIS\Sizecharts\Model\Sizecharts')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Sizecharts no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
		$isUnisex = (int)$this->getRequest()->getParam('is_unisex');
		$this->addSizeOptionValues($model->getId(), $isUnisex);

                 $this->messageManager->addSuccessMessage(__('You saved the Sizecharts.'));
                 $this->dataPersistor->clear('uis_sizecharts_sizecharts');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['sizecharts_id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Sizecharts.'));
            }
        
            $this->dataPersistor->set('uis_sizecharts_sizecharts', $data);
            return $resultRedirect->setPath('*/*/edit', ['sizecharts_id' => $this->getRequest()->getParam('sizecharts_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }


    protected function addSizeOptionValues($sizechartId, $isUnisex){
	$sizeOptions = $this->getSizeAttributeAllOptions();

        if (!$sizeOptions || count($sizeOptions) == 0) { return; }
  
	foreach ($sizeOptions as $option){
	    $gender = $this->_objectManager->create('UIS\Sizecharts\Model\Gender'); 
	    $gender->setData('label_id', $sizechartId);
            $gender->setData('mens_size', $option['optionLabel']);
	    $gender->save();
	}

    }

    protected function getSizeAttributeAllOptions(){
	$eavConfig = $this->_objectManager->get('\Magento\Eav\Model\Config');
	$attribute = $eavConfig->getAttribute('catalog_product', 'size');
	$options = $attribute->getSource()->getAllOptions();

	$optionsValues = array();
	foreach($options as $option) {
	    if ($option['value'] != '') {
		$optionsValues[] = array( 'optioValue' => $option['value'],  'optionLabel' => $option['label'] );
	    }
	}

	return $optionsValues;
    }

}

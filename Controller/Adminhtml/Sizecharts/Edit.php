<?php


namespace UIS\Sizecharts\Controller\Adminhtml\Sizecharts;

class Edit extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;
	
	protected $_coreRegistry = null;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
		/**
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
        

        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
		**/
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry = $coreRegistry;
		parent::__construct($context);	
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        //return $this->resultPageFactory->create();

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('sizecharts_id');
        $model = $this->_objectManager->create('UIS\Sizecharts\Model\Sizecharts');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
			
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Sizecharts no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('uis_sizecharts_sizecharts', $model);
        
        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Sizecharts') : __('New Sizecharts'),
            $id ? __('Edit Sizecharts') : __('New Sizecharts')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Sizecharts'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Sizecharts'));
        return $resultPage;
    }
}

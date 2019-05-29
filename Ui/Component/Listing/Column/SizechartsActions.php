<?php
namespace MyNamespace\Sizecharts\Ui\Component\Listing\Column;

/**
 * Class SizechartsActions
 * 
 * extends  \Magento\Ui\Component\Listing\Columns\Column 
 * 
 * @category MyNamespace
 * @package  MyNamespace_Sizecharts
 * @author Husak Mykhailo <noname@nomale.com>
 */
class SizechartsActions extends \Magento\Ui\Component\Listing\Columns\Column
{

    const URL_PATH_DETAILS = 'uis_sizecharts/sizecharts/details';
    protected $urlBuilder;
    const URL_PATH_EDIT = 'uis_sizecharts/sizecharts/edit';
    const URL_PATH_DELETE = 'uis_sizecharts/sizecharts/delete';

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['sizecharts_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_EDIT, [
                                'sizecharts_id' => $item['sizecharts_id']
                                    ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                    static::URL_PATH_DELETE, [
                                'sizecharts_id' => $item['sizecharts_id']
                                    ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.title }"'),
                                'message' => __('Are you sure you wan\'t to delete a "${ $.$data.title }" record?')
                            ]
                        ],
                        'editsizecharttable' => [
                            'href' => $this->urlBuilder->getUrl(
                                    'uis_sizecharts/gender/index', [
                                'label_id' => $item['sizecharts_id']
                                    ]
                            ),
                            'label' => __('Edit Sizechart Table')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }

}

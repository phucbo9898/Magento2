<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Dev\Banner\Controller\Adminhtml\Action;

use Dev\Banner\Model\Banner;
use Magento\Backend\App\Action;

/**
 * InlineEdit CMS page action.
 */
class InlineEdit extends Action
{
    protected $jsonFactory;


    /**
     * @param Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $message = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItem = $this->getRequest()->getParam('items', []);
            if (!count($postItem)) {
                $message[] = __('Please correct the data sent.');
                    $error = true;
            } else {
                foreach (array_keys($postItem) as $bannerId) {
                    $model = $this->_objectManager->create(Banner::class)->load($bannerId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItem[$bannerId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $message[] = "[Error:] {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }
        return $resultJson->setData([
            'messages' => $message,
            'error' => $error
        ]);
    }
}

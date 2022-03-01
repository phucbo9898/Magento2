<?php /** @noinspection ALL */

namespace Dev\Banner\Controller\Index;

use Dev\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\App\Action\Action;

class View extends Action
{

    protected $_pageFactory;

    /**
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct
    (
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}

<?php /** @noinspection ALL */

namespace Dev\Banner\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action;

class Index extends Action
{

    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Catalog::catalog_products');
        $resultPage->getConfig()->getTitle()->prepend((__('Product Banner')));

        return $resultPage;
    }
}

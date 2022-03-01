<?php

namespace Dev\Banner\Controller\Adminhtml\Action;

use Dev\Banner\Model\Banner;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Dev\Banner\Model\ResourceModel\Banner\CollectionFactory;
use Dev\Banner\Model\BannerRepository;
use Dev\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Massaction filter
     * @var Filter
     */
    protected $filter;

    /**
     * @var $collectionFactory
     */
    protected $collectionFactory;

    /**
     * @var $bannerRepository
     */
    protected $bannerRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param BannerRepositoryInterface|null $bannerRepository
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        BannerRepositoryInterface $bannerRepository = null,
        LoggerInterface  $logger = null
    ){
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->bannerRepository = $bannerRepository ?:
            \Magento\Framework\App\ObjectManager::getInstance()->
            create(BannerRepositoryInterface::class);
        $this->logger = $logger ?:
            \Magento\Framework\App\ObjectManager::getInstance()->
            create(LoggerInterface::class);
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->
        collectionFactory->create());
        $bannerDelete = 0;
        $bannerDeleteError = 0;
        foreach ($collection->getItems() as $banner) {
            try {
                $this->_objectManager->create(Banner::class)->load($banner->getEtityId())->delete();
                $bannerDelete++;
            } catch (LocalizedException $exception) {
                $this->logger->error($exception->getLogMessage());
                $bannerDeleteError++;
            }
        }

        if ($bannerDelete) {
            $this->messageManager->addSuccessMessage(
              __('A total of %1 record(s) have been deleted.', $bannerDelete)
            );
        }

        if ($bannerDeleteError) {
            $this->messageManager->addErrorMessage(
                __('A total of %1 record(s) have/nt been deleted/ Please see server logs for more details.', $bannerDeleteError)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('banner/banner/index');
    }
}

<?php
//
//namespace Dev\Banner\Controller\Adminhtml\Banner;
//
//use Dev\Banner\Model\BannerFactory;
//use Magento\Backend\App\Action;
//
///**
// * Class Save
// * @package Dev\Banner\Controller\Adminhtml\Banner
// */
//class Save extends Action
//{
//    const ADMIN_RESOURCE = 'Dev_Banner::save';
//    /**
//     * @var BannerFactory
//     */
//    private $bannerFactory;
//
//    /**
//     * Save constructor.
//     * @param Action\Context $context
//     * @param BannerFactory $bannerFactory
//     */
//    public function __construct(
//        Action\Context $context,
//        BannerFactory $bannerFactory
//    ) {
//        parent::__construct($context);
//        $this->bannerFactory = $bannerFactory;
//    }
//
//    public function execute()
//    {
//        $data = $this->getRequest()->getPostValue();
//        $id = !empty($data['banner_id']) ? $data['banner_id'] : null;
//
//        $newData = [
//            'name' => $data['name'],
//            'description' => $data['description'],
//            'status' => $data['status'],
//            'image' => $data['images'][0]['name'],
//        ];
//
//        $banner = $this->bannerFactory->create();
//
//        if ($id) {
//            $banner->load($id);
//        }
//        try {
//            $banner->addData($newData);
//            $banner->save();
//            $this->messageManager->addSuccessMessage(__('You saved the banner.'));
//        } catch (\Exception $e) {
//            $this->messageManager->addErrorMessage(__($e->getMessage()));
//        }
//
//        return $this->resultRedirectFactory->create()->setPath('banner/banner/index');
//    }
//}
/** @noinspection ALL */
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Dev\Banner\Controller\Adminhtml\Banner;

use Dev\Banner\Model\Banner;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Dev\Banner\Api\Data\BannerInterface;
use Dev\Banner\Api\BannerRepositoryInterface;
use Dev\Banner\Model\BannerFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save CMS page action.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dev_Banner::save';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var BannerFactory
     */
    private $bannerFactory;

    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param BannerFactory|null $bannerFactory
     * @param BannerRepositoryInterface|null $bannerRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        BannerFactory $bannerFactory = null,
        BannerRepositoryInterface $bannerRepository = null
    ){
        $this->dataPersistor = $dataPersistor;
        $this->bannerFactory = $bannerFactory ?: ObjectManager::getInstance()->get(BannerFactory::class);
        $this->bannerRepository = $bannerRepository ?: ObjectManager::getInstance()->get(BannerRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Banner::STATUS_ENABLED;
            }
            if (empty($data['banner_id'])) {
                $data['banner_id'] = null;
            }
            if (empty($data['images'])) {
                $data['images'] = null;
            } else {
                if ($data['images'][0] && $data['images'][0]['name'])
                    $data['image'] = $data['images'][0]['name'];
                else
                    $data['image'] = null;
            }

            /** @var Banner $model */
            $model = $this->bannerFactory->create();
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                try {
                    $model = $this->bannerRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This page no longer exists.'));
                    return $resultRedirect->setPath('banner/banner/index');
                }
            }
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Thêm banner thành công.'));
                return $this->processResultRedirect($model, $resultRedirect, $data);
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the page.'));
            }

            var_dump($this->dataPersistor->set('banner', $data));
            return $resultRedirect->setPath('banner/banner/edit', ['banner_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('banner/banner/index');
    }

    /**
     * Process result redirect
     *
     * @param PageInterface $model
     * @param Redirect $resultRedirect
     * @param array $data
     * @return Redirect
     * @throws LocalizedException
     */
    private function processResultRedirect($model, $resultRedirect, $data)
    {
//        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
//            $newPage = $this->bannerFactory->create(['data' => $data]);
//            $newPage->setId(null);
//            $identifier = $model->getIdentifier() . '-' . uniqid();
//            $newPage->setIdentifier($identifier);
//            $newPage->setIsActive(false);
//            $this->pageRepository->save($newPage);
//            $this->messageManager->addSuccessMessage(__('You duplicated the page.'));
//            return $resultRedirect->setPath(
//                '*/*/edit',
//                [
//                    'banner' => $newPage->getId(),
//                    '_current' => true,
//                ]
//            );
//        }
        $this->dataPersistor->clear('banner');
        if ($this->getRequest()->getParam('b17ack')) {
            return $resultRedirect->setPath('banner/banner/edit', ['banner_id' => $model->getId(), '_current' => true]);
        }
        return $resultRedirect->setPath('banner/banner/index');
    }
}

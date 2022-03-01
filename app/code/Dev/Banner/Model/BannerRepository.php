<?php /** @noinspection ALL */

namespace Dev\Banner\Model;

use Dev\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var  \Dev\Banner\Model\BannerFactory
     */
    protected $bannerFactory;

    /**
     * @var  \Dev\Banner\Model\ResourceModel\Banner
     */
    protected $bannerResource;

    /**
     * @var \Dev\Banner\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param BannerFactory $bannerFactory
     * @param ResourceModel\Banner $bannerResource
     * @param ResourceModel\Banner\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Dev\Banner\Model\BannerFactory $bannerFactory,
        \Dev\Banner\Model\ResourceModel\Banner $bannerResource,
        \Dev\Banner\Model\ResourceModel\Banner\CollectionFactory $collectionFactory
    )
    {
        $this->bannerFactory = $bannerFactory;
        $this->bannerResource = $bannerResource;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param $id
     * {@inheritDoc}
     */
    public function getById($id)
    {
        $bannerModel = $this->bannerFactory->create();
        $this->bannerResource->load($bannerModel,$id);
        if (!$bannerModel->getEtityId()){
            throw new NoSuchEntityException(__('No search id'));
        }
        return $bannerModel;
    }

    /**
     * {@inheritDoc}
     */
    public function getAll()
    {
        $data = $this->bannerFactory->create()->getCollection();
        $item = [];
        foreach ($data as $value) {
            $item = $value->getData();
        }
        return $item;
    }
}

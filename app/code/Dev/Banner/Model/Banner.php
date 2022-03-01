<?php

namespace Dev\Banner\Model;

use Dev\Banner\Api\Data\BannerInterface;
use Magento\Framework\Model\AbstractModel;


class Banner extends AbstractModel implements BannerInterface
{
    const BANNER_ID = 'banner_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const IMAGE = 'image';
    const CREATE_AT = 'create_at';
    const UPDATE_AT = 'update_at';
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected function _construct()
    {
        $this->_init(\Dev\Banner\Model\ResourceModel\Banner::class);
    }

    /**
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * @return int
     */
    public function getEtityId()
    {
        return $this->getData(self::BANNER_ID);
    }

    /**
     * @param $bannerId
     * @return $this
     */
    public function setEntityId($bannerId)
    {
        $this->setData(self::BANNER_ID, $bannerId);
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        $this->getData(self::DESCRIPTION);
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->setDescription(self::DESCRIPTION, $description);
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        $this->getData(self::IMAGE);
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->setData(self::IMAGE, $image);
        return $this;
    }
}

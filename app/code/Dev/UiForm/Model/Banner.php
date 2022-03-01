<?php

namespace Dev\UiForm\Model;

use Dev\UiForm\Api\Data\BannerInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Banner extends AbstractExtensibleModel implements BannerInterface
{

    protected function _construct()
    {
        $this->_init(\Dev\UiForm\Model\ResourceModel\Banner::class);
    }

    /**
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * @return int|mixed|null
     */
    public function getEtityId()
    {
        return $this->getData(self::BANNER_ID);
    }
}

<?php

namespace Dev\Banner\Api\Data;


use Magento\Framework\Api\ExtensibleDataInterface;

interface BannerInterface extends ExtensibleDataInterface
{

    /**
     * @return int|mixed|null;
     */
    public function getEtityId();

    /**
     * @return mixed
     */
    public function getAvailableStatuses();
}

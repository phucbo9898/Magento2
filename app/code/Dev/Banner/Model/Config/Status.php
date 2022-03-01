<?php

namespace Dev\Banner\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    protected $banner;

    /**
     * @param \Dev\Banner\Model\Banner $banner
     */
    public function __construct(\Dev\Banner\Model\Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {

        $availableOptions = $this->banner->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }

}

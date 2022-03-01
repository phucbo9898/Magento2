<?php

namespace Dev\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'banner_id';
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dev\Banner\Model\Banner','Dev\Banner\Model\ResourceModel\Banner');
    }
}

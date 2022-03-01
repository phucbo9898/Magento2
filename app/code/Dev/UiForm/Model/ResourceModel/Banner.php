<?php

namespace Dev\Banner\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Banner extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('ui', 'banner_id');
    }
//    /**
//     * @param Context $context
//     */
//    public function __construct(
//        Context $context
//    )
//    {
//        parent::__construct($context);
//    }


}

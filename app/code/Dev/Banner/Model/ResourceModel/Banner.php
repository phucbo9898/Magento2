<?php

namespace Dev\Banner\Model\ResourceModel;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Model\AbstractModel;
use Dev\Banner\Model\ImageUploader;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Banner extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('banner', 'banner_id');
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
    /**
     * @param AbstractModel $object
     * @return $this|Banner
     */
//    protected function _afterSave(AbstractModel $object)
//    {
//        // Get image data before and after save
//        $oldImage = $object->getOrigData('image');
//        $newImage = $object->getData('image');
//
//        // Check when new image uploaded
//        if ($newImage != null && $newImage != $oldImage) {
//            $imageUploader = ObjectManager::getInstance()
//                ->get(ImageUploader::class);
//        }            $imageUploader->moveFileFromTmp($newImage);
//
//
//        return $this;
//    }

}

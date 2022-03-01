<?php

namespace Dev\Banner\Api;

interface BannerRepositoryInterface
{
    /**
     * @param int $id
     * @return \Dev\Banner\Api\Data\BannerInterface
     */
    public function getById($id);

    /**
     * @return \Dev\Banner\Api\Data\BannerInterface
     */
    public function getAll();
}

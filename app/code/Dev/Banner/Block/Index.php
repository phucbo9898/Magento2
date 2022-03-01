<?php /** @noinspection ALL */

namespace Dev\Banner\Block;

use Dev\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * @var \Dev\Banner\Model\BannerFactory
     */
    protected $bannerFactory;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @param BannerRepositoryInterface $bannerRepository
     * @param Template\Context $context
     * @param array $data
     * @param \Dev\Banner\Model\BannerFactory $bannerFactory
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct
    (
        \Dev\Banner\Api\BannerRepositoryInterface $bannerRepository,
        Template\Context $context,
        array $data = [],
        \Dev\Banner\Model\BannerFactory       $bannerFactory,
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $this->bannerRepository = $bannerRepository;
        $this->request = $request;
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array[]
     */
    public function getBanner()
    {
        $data = $this->bannerRepository->getById($this->getRequest()->getParam('id'));
        return $data->getData() ;
    }
}

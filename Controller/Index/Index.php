<?php


namespace Study\Credit\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ActionInterface;

/**
 * Class Index
 * @package Study\Credit\Controller\Index
 */
class Index implements ActionInterface, HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct
    (
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}

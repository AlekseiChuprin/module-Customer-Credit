<?php


namespace Study\Credit\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class Credit
 * @package Study\Credit\Block
 */
class Credit extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_session;

    /**
     * Credit constructor.
     * @param Template\Context $context
     * @param array $data
     * @param \Magento\Customer\Model\Session $session
     */
    public function __construct
    (
        Template\Context $context, array $data = [],
        \Magento\Customer\Model\Session $session
    )
    {
        parent::__construct($context, $data);
        $this->_session = $session;
    }

    /**
     * @return mixed
     */
    public function getCustomerCredit()
    {
        $credit = $this->_session->getCustomer()->getCredit();

        return $credit;
    }
}

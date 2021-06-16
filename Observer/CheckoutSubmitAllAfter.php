<?php


namespace Study\Credit\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Study\Credit\Helper\CreditConfig;

/**
 * Class CheckoutSubmitAllAfter
 * @package Study\Credit\Observer
 */
class CheckoutSubmitAllAfter implements ObserverInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var CreditConfig
     */
    protected $congifDataCredit;

    /**
     * CheckoutSubmitAllAfter constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param CreditConfig $congifDataCredit
     */
    public function __construct
    (
        CustomerRepositoryInterface $customerRepository,
        CreditConfig $congifDataCredit
    )
    {
        $this->customerRepository = $customerRepository;
        $this->congifDataCredit = $congifDataCredit;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this|void
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if($this->congifDataCredit->getGeneralConfig('enable')){
            $order = $observer->getEvent()->getOrder();
            $customer = $this->customerRepository->getById($order->getCustomerId());
            $countBonus = $customer->getCustomAttribute('credit')->getValue();
            $persentCashBack = $this->congifDataCredit->getGeneralConfig('cashback') / 100;
            $subTotalcashBack = $order->getSubTotal() * $persentCashBack;;
            if(!empty($countBonus)){
                $customer->setCustomAttribute('credit', ($countBonus + $subTotalcashBack));
            }else {
                $customer->setCustomAttribute('credit', $subTotalcashBack);
            }
            $this->customerRepository->save($customer);

            return $this;
        }
    }
}

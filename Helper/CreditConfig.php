<?php


namespace Study\Credit\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class CreditConfig
 * @package Study\Credit\Helper
 */
class CreditConfig extends AbstractHelper
{
    /**
     * const path
     */
    const XML_PATH_CREDIT = 'credit/';

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param $code
     * @param null $storeId
     * @return mixed
     */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_CREDIT .'general/'. $code, $storeId);
    }
}

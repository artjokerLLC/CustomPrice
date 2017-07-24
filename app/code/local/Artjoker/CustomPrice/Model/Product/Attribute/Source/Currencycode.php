<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * with subject "get OSL-3 license" to support@artjoker.ua so we can send you a copy.
 *
 * @category    Artjoker
 * @package     Artjoker_CustomPrice
 * @copyright   Copyright (c) 2017 Artjoker Digital (https://artjoker.ua/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Artjoker_CustomPrice_Model_Product_Attribute_Source_Currencycode extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    /**
     * Empty Value for Currency Code
     */
    const CURRENCY_CODE_EMPTY_VALUE = -1;

    /**
     * Get all option
     *
     * @return array
     */
    public function getAllOptions($withEmpty = true, $withoutBaseCurrency = true)
    {
        if (!$this->_options) {

            $allowCurrencies = Mage::getModel('directory/currency')->getConfigAllowCurrencies();
            $baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();

            $options = array();
            foreach ($allowCurrencies as $value => $label) {
                if ($label == $baseCurrencyCode && $withoutBaseCurrency) {
                    continue;
                }
                $options[] = array(
                    'label' => $label,
                    'value' => $value,
                );
            }
            if ($withEmpty) {
                array_unshift($options, array(
                    'label' => Mage::helper('artjoker_customprice')->__('--Please Select--'),
                    'value' => self::CURRENCY_CODE_EMPTY_VALUE)
                );
            }
            $this->_options = $options;
        }
        return $this->_options;
    }

    /**
     * Get options as array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->getAllOptions(false);
    }

    public function getValueByLabel($label)
    {
        $options = $this->toOptionArray();
        foreach ($options as $option) {
            if ($option['label'] == $label) {
                return $option['value'];
            }
        }
        return false;
    }
}
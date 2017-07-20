<?php

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
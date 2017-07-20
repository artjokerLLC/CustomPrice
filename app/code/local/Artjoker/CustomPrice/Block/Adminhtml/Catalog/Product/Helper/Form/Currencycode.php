<?php

class Artjoker_CustomPrice_Block_Adminhtml_Catalog_Product_Helper_Form_Currencycode extends Varien_Data_Form_Element_Select
{
    /**
     * Validation classes for currency code field which depends by custom price field
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->addClass('validate-currency-code');
    }

    /**
     * Retrieve Element HTML fragment
     *
     * @return string
     */
    public function getElementHtml()
    {
        if (is_null($this->getValue())) {
            $this->setValue(Artjoker_Customprice_Model_Product_Attribute_Source_Currencycode::CURRENCY_CODE_EMPTY_VALUE);
        }
        return parent::getElementHtml();
    }
}
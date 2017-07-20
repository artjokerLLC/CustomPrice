<?php

class Artjoker_CustomPrice_Block_Adminhtml_Catalog_Product_Helper_Form_Customprice extends Varien_Data_Form_Element_Text
{
    /**
     * Validation classes for custom price field which depends by currency code field
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->addClass('validate-custom-price');
    }
}
<?php

class Artjoker_CustomPrice_Block_Adminhtml_Catalog_Product_Edit_Tab_Attributes extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Attributes
{
    /**
     * Retrieve additional element types
     *
     * @return array
     */
    protected function _getAdditionalElementTypes()
    {
        $result = parent::_getAdditionalElementTypes();

        /**
         * Add additional element types for custom price fields
         */
        $result = array_merge_recursive($result, array(
            'currency_code' => Mage::getConfig()->getBlockClassName('artjoker_customprice/adminhtml_catalog_product_helper_form_currencycode'),
            'custom_price'  => Mage::getConfig()->getBlockClassName('artjoker_customprice/adminhtml_catalog_product_helper_form_customprice'),
        ));

        return $result;
    }
}
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
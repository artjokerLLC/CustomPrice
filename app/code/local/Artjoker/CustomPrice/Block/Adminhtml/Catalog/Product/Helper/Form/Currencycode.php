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
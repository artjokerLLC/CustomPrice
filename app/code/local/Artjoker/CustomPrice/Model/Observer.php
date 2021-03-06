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

class Artjoker_CustomPrice_Model_Observer
{
    public function applyCustomPrice(Varien_Event_Observer $observer)
    {
        /**
         * @var $productModel Mage_Catalog_Model_Product
         */
        $productModel = $observer->getObject();

        if (!$productModel instanceof Mage_Catalog_Model_Product) {
            return $this;
        }

        /**
         * Check if price was changed and cleaning custom price fields
         */
        if ($productModel->getData('price') != $productModel->getOrigData('price')) {
            $productModel->setData('custom_price', '');
            $productModel->setData('currency_code', Artjoker_CustomPrice_Model_Product_Attribute_Source_Currencycode::CURRENCY_CODE_EMPTY_VALUE);
            return $this;
        }

        /**
         * Checking changes custom price fields and quiting this observer if nothing didn't change
         */
        if ($productModel->getData('custom_price') == $productModel->getOrigData('custom_price')
            && $productModel->getData('currency_code') == $productModel->getOrigData('currency_code')
        ) {
            return $this;
        }

        /**
         * Additional checking on available currency code and quiting this observer if currency code is not available.
         */
        $currencyCode = $productModel->getAttributeText('currency_code');
        if (!in_array($currencyCode, Mage::app()->getStore()->getAvailableCurrencyCodes())) {
            return $this;
        }

        /**
         * Getting currency rate and setting price to product
         */
        $customPrice = $productModel->getCustomPrice();
        $baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();

        $currencyRate = Mage::helper('directory')->currencyConvert(1, $baseCurrencyCode, $currencyCode);
        $convertedPrice = $customPrice / $currencyRate;
        $productModel->setPrice($convertedPrice);

        return $this;
    }
}
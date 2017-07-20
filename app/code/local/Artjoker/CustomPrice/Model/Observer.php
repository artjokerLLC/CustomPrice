<?php

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

        if ($productModel->getData('price') != $productModel->getOrigData('price')) {
            $productModel->setData('custom_price', '');
            $productModel->setData('currency_code', -1);
            return $this;
        }

        if ($productModel->getData('custom_price') == $productModel->getOrigData('custom_price')
            && $productModel->getData('currency_code') == $productModel->getOrigData('currency_code')
        ) {
            return $this;
        }

        $currencyCode = $productModel->getAttributeText('currency_code');

        if (!in_array($currencyCode, Mage::app()->getStore()->getAvailableCurrencyCodes())) {
            return $this;
        }

        $customPrice = $productModel->getCustomPrice();
        $baseCurrencyCode = Mage::app()->getStore()->getBaseCurrencyCode();

        $currencyRate = Mage::helper('directory')->currencyConvert(1, $baseCurrencyCode, $currencyCode);
        $convertedPrice = $customPrice / $currencyRate;
        $productModel->setPrice($convertedPrice);
        return $this;
    }
}
<?php
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Fix for creating products when was set custom price only
 */
$installer->updateAttribute(Mage_Catalog_Model_Product::ENTITY, 'price', 'default_value', 0);

$installer->endSetup();
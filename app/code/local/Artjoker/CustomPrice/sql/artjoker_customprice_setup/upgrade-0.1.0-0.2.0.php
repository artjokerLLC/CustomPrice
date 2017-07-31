<?php
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer = $this;

$installer->startSetup();

$productTypes = array(
    Mage_Catalog_Model_Product_Type::TYPE_SIMPLE,
    Mage_Catalog_Model_Product_Type::TYPE_BUNDLE,
    Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE,
    Mage_Catalog_Model_Product_Type::TYPE_VIRTUAL,
    Mage_Downloadable_Model_Product_Type::TYPE_DOWNLOADABLE,
);
$productTypes = join(',', $productTypes);

$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'custom_price', array(
    'group'                     => 'Custom Price',
    'backend'                   => 'catalog/product_attribute_backend_price',
    'label'                     => 'Price on another currency',
    'type'                      => 'decimal',
    'global'                    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible'                   => true,
    'required'                  => false,
    'user_defined'              => false,
    'apply_to'                  => $productTypes,
    'input_renderer'            => 'artjoker_customprice/adminhtml_catalog_product_helper_form_customprice',
    'visible_on_front'          => false,
    'used_in_product_listing'   => false,
    'sort_order'                => '1',
));

$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'currency_code', array(
    'group'                     => 'Custom Price',
    'backend'                   => 'catalog/product_attribute_backend_boolean',
    'label'                     => 'Currency',
    'input'                     => 'select',
    'source'                    => 'artjoker_customprice/product_attribute_source_currencycode',
    'global'                    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible'                   => true,
    'required'                  => false,
    'user_defined'              => false,
    'apply_to'                  => $productTypes,
    'input_renderer'            => 'artjoker_customprice/adminhtml_catalog_product_helper_form_currencycode',
    'visible_on_front'          => false,
    'used_in_product_listing'   => false,
    'sort_order'                => '2',
));

$installer->endSetup();
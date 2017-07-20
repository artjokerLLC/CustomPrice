<?php

/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$installer = $this;

$installer->startSetup();

$entityTypeId = $installer->getEntityTypeId(Mage_Catalog_Model_Product::ENTITY);
$attributeSetId = $installer->getDefaultAttributeSetId($entityTypeId);

/**
 * Next code is getting attribute group collection without groups "General" and "Prices"
 *
 * @var $attributeGroupCollection Mage_Eav_Model_Resource_Entity_Attribute_Group_Collection
 */
$attributeGroupCollection = Mage::getModel('eav/entity_attribute_group')
    ->getResourceCollection()
    ->setAttributeSetFilter($attributeSetId);

/**
 * Next code changes sort ordering of the attribute groups from last to "Prices" and
 * retrieves sort order that should be after "Prices" group
 *
 * @var $attributeGroup Mage_Eav_Model_Entity_Attribute_Group
 * @var $attributeGroupSortOrder // default sort ordering item that is after "Prices" group
 */
$attributeGroupSortOrder = 3;
foreach ($attributeGroupCollection as $attributeGroup) {
    if ($attributeGroup->getAttributeGroupName() == 'Prices') {
        $attributeGroupSortOrder = $attributeGroup->getSortOrder() + 1;
        break;
    }
    $attributeGroup->setSortOrder($attributeGroup->getSortOrder() + 1)
        ->save();
}

$installer->addAttributeGroup($entityTypeId, $attributeSetId, 'Custom Price', $attributeGroupSortOrder);

$installer->endSetup();
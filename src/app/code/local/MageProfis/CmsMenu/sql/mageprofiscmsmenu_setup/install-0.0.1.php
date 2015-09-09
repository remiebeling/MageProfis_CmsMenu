<?php
$installer = $this;
/* @var $installer Loewenstark_Seo_Model_Resource_Setup */
$installer->startSetup();
$installer->getConnection()
        ->addColumn($installer->getTable('cms/page'), 'menu_order', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => 10,
        'nullable'  => true,
        'comment'   => Mage::helper('cmsmenu')->__('position in cms menu')
    ));
    $installer->getConnection()
        ->addColumn($installer->getTable('cms/page'), 'show_in_menu', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => 10,
        'nullable'  => true,
        'comment'   => Mage::helper('cmsmenu')->__('is show in cms menu'),
        'default'   => '1'
    ));
    $installer->getConnection()
        ->addColumn($installer->getTable('cms/page'), 'name_in_menu', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'    => 255,
        'nullable'  => true,
        'comment'   => Mage::helper('cmsmenu')->__('name in cms menu'),
    ));
$installer->endSetup();
<?php
class MageProfis_CmsMenu_Model_Observer 
{
    /**
     * event: adminhtml_cms_page_edit_tab_main_prepare_form
     * in: Mage_Adminhtml_Block_Cms_Page_Edit_Tab_Main::_prepareForm()
     *
     * @param $event Varien_Event_Observer
     * @return void
     */
    public function addFieldsToCmsMainForm(Varien_Event_Observer $event)
    {
        $isElementDisabled = Mage::getSingleton('admin/session')->isAllowed('cms/page/save') ? false : true;

        $form = $event->getForm();
        $model = Mage::registry('cms_page');
        /* @var $form Varien_Data_Form */
        $fieldset = $form->addFieldset('cmsmenu', array('legend' => Mage::helper('cmsmenu')->__('CMS Menu Settings'), 'class' => 'fieldset-wide'));
        
        $fieldset->addField('show_in_menu', 'select', array(
            'name'      => 'show_in_menu',
            'label'     => Mage::helper('cmsmenu')->__('Show in CMS Menu'),
            'title'     => Mage::helper('cmsmenu')->__('Show in CMS Menu'),
            'required'  => false,
            'disabled'  => $isElementDisabled,
            'value'     => $model->getMenuOrder(),
            'options'   => array(1 => Mage::helper('cmsmenu')->__('show'), 0 => Mage::helper('cmsmenu')->__('do not show')),
        ));
        
        $fieldset->addField('name_in_menu', 'text', array(
            'name'      => 'name_in_menu',
            'label'     => Mage::helper('cmsmenu')->__('name in CMS Menu'),
            'title'     => Mage::helper('cmsmenu')->__('name in CMS Menu'),
            'required'  => false,
            'disabled'  => $isElementDisabled,
            'value'     => $model->getMenuOrder(),
            'note'      => 'Wenn dieses Feld leer gelassen wird, wird der Seitentitel verwendet'
        ));
        
        $fieldset->addField('menu_order', 'text', array(
            'name'      => 'menu_order',
            'label'     => Mage::helper('cmsmenu')->__('Position in CMS Menu'),
            'title'     => Mage::helper('cmsmenu')->__('Position in CMS Menu'),
            'required'  => false,
            'disabled'  => $isElementDisabled,
            'value'     => $model->getMenuOrder(),
            'note'      => 'Bitte eine Zahl eingeben'
        ));
    }      
    
    public function registerVirtualGroup($event)
    {
        Mage::register('virtual_group', 'service'); 
    }  
}

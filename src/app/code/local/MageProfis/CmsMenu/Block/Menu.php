<?php 
class MageProfis_CmsMenu_Block_Menu extends Mage_Core_Block_Template
{
    public $_cms_pages = null;   
        
    public function getMenuPages()
    {
        if($this->_cms_pages == null)
        {
            
            
        $search = $this->getIdentifierGroup();
        if(Mage::registry('virtual_group'))
        {
           $search = Mage::registry('virtual_group');
        }
        
        $this->_cms_pages = Mage::getModel('cms/page')->getCollection()
                    ->addFieldToFilter('is_active', 1)
                    ->addFieldToFilter('identifier', array('like' => $search . '/%'))
                    ->addFieldToFilter('show_in_menu', '1')
                    ->setOrder('menu_order', 'ASC');
        }
        return $this->_cms_pages;
    }
    /*
     * @param $additional items = array(array('title', 'identifier', 'position'))
     */
    public function getMenuItems($additional_items = array())
    {
        $menu_items = array();
        
        $i = 1;           
        foreach($this->getMenuPages() as $_page)
        {
            $title = $_page->getTitle();      
            if($_page->getNameInMenu() != null)
            {
                $title = $_page->getNameInMenu();
            }           
            $menu_items[str_pad($_page->getMenuOrder(), 10, "10000000000" . $_page->getMenuOrder() , STR_PAD_LEFT) . '0' . $i] = array(
                'title' => $title,
                'identifier' => $_page->getIdentifier(),
            );
            $i++;
        }
        
        if(!empty($additional_items))
        {
            foreach($additional_items as $item)
            {
                $i++;  
                $menu_items[str_pad($item[2], 10, "1000000000", STR_PAD_LEFT) . '0' . $i] = array (
                    'title' => $item[0],
                    'identifier' => $item[1],    
                );
                  
            }    
        }
        ksort($menu_items);
        return $menu_items;
    }
    
    public function getPageState($identifier)
    {
        if(trim($this->getRequest()->getPathInfo(), '/') == trim($identifier, '/'))
        {
            return 'active';
        }            
        else {
            return 'inactive';
        }
    }
    
    public function getIdentifierGroup()
    {
        $result = array_filter((array)explode('/', trim($this->getRequest()->getPathInfo(), '/')));
        if(count($result)  > 1)
        {
            return current($result);     
        }
        return false;
             
    }
    
    public function getCmsPageUrl($identifier)
    {
        return Mage::getUrl($identifier);
    }
    
    protected function _toHtml()
    {
        if($this->getIdentifierGroup() || Mage::registry('virtual_group'))
        {
            if(Mage::getStoreConfigFlag('cmsmenu/general/active'))
            {
                return parent::_toHtml();    
            }    
        }
        return '';
    }
    
}

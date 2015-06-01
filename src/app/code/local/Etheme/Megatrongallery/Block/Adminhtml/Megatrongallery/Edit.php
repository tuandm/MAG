<?php
/**
 * @version   1.0 14.08.2012
 * @author    TonyEcommerce http://www.TonyEcommerce.com <support@TonyEcommerce.com>
 * @copyright Copyright (c) 2012 TonyEcommerce
 */

class Etheme_Megatrongallery_Block_Adminhtml_Megatrongallery_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_blockGroup = 'megatrongallery';
        $this->_controller = 'adminhtml_megatrongallery';
        $this->_mode = 'edit';
        
        $this->_addButton('save_and_continue', array(
                  'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                  'onclick' => 'saveAndContinueEdit()',
                  'class' => 'save',
        ), -100);

        $this->_updateButton('save', 'label', Mage::helper('megatrongallery')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('megatrongallery')->__('Delete Item'));

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( !(Mage::registry('megatrongallery_data') && Mage::registry('megatrongallery_data')->getId()) )
            return Mage::helper('megatrongallery')->__("Edit item");


    }
}
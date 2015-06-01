<?php
/**
 * @version   1.0 14.08.2012
 * @author    TonyEcommerce http://www.TonyEcommerce.com <support@TonyEcommerce.com>
 * @copyright Copyright (c) 2012 TonyEcommerce
 */

class Etheme_Megatronconfig_Adminhtml_CssrefreshController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{

        $website=Mage::app()->getRequest()->getParam('website');
        $store=Mage::app()->getRequest()->getParam('store');
        Mage::helper('megatronconfig')->refreshCssFiles($store, $website);
        $this->getResponse()->setRedirect($this->getUrl('adminhtml/system_config/edit/section/megatroncolors', array('store' => $store, 'website' => $website)));
	}
}




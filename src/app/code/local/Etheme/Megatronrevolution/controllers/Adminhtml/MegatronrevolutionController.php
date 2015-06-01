<?php
/**
 * @version   1.0 14.08.2012
 * @author    TonyEcommerce http://www.TonyEcommerce.com <support@TonyEcommerce.com>
 * @copyright Copyright (c) 2012 TonyEcommerce
 */

class Etheme_Megatronrevolution_Adminhtml_MegatronrevolutionController extends Mage_Adminhtml_Controller_Action
{

	protected function _initAction()
    {
		$this->loadLayout()
			->_setActiveMenu('etheme');
		return $this;
	}   
 
	public function indexAction()
    {
		$this->_initAction()
			->_addContent($this->getLayout()->createBlock('megatronrevolution/adminhtml_megatronrevolution'))
			->renderLayout();
	}

	public function editAction() {
		$Id     = $this->getRequest()->getParam('id');
        $Model  = Mage::getModel('megatronrevolution/megatronrevolution')->load($Id);

        if ($Model->getId() || $Id == 0)
        {

            Mage::register('megatronrevolution_data', $Model);
            $this->loadLayout();
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Slideshowadv Manager'), Mage::helper('adminhtml')->__('Slideshowadv Manager'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('megatronrevolution/adminhtml_megatronrevolution_edit'))
                 ->_addLeft($this->getLayout()->createBlock('megatronrevolution/adminhtml_megatronrevolution_edit_tabs'));
            $this->renderLayout();
        } else
        {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('megatronrevolution')->__('Slide does not exist'));
            $this->_redirect('*/*/');
        }
	}
 
	public function newAction()
    {
		$this->_forward('edit');
	}
 
	public function saveAction()
    {

            $formData=$this->getRequest()->getPost();

            if(isset($formData['stores'])) {
                if(in_array('0',$formData['stores'])){
                    $formData['store_id'] = '0';
                }
                else{
                    $formData['store_id'] = implode(",", $formData['stores']);
                }
                unset($formData['stores']);
            }

            if ($formData) {
                try {

                    $megatronrevolutionModel = Mage::getModel('megatronrevolution/megatronrevolution');

                    $megatronrevolutionModel->setData($formData) ->setId($this->getRequest()->getParam('id'))->save();
                   
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Slide was successfully saved'));
                    Mage::getSingleton('adminhtml/session')->setmegatronrevolutionData(false);

                    if ($this->getRequest()->getParam('back'))
                    {
                        $this->_redirect('*/*/edit', array('id' => $megatronrevolutionModel->getId()));
                        return;
                    }

                    $this->_redirect('*/*/');
                    return;
                } catch (Exception $e)
                {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    Mage::getSingleton('adminhtml/session')->setmegatronrevolutionData($this->getRequest()->getPost());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
            }
            $this->_redirect('*/*/');
    }
 
	public function deleteAction()
    {
		if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $megatronrevolutionModel = Mage::getModel('megatronrevolution/megatronrevolution');
               
                $megatronrevolutionModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Slide was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
	}


    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('megatronrevolution/adminhtml_megatronrevolution_grid')->toHtml()
        );
    }


    public function massDeleteAction()
    {
        $slideIds = $this->getRequest()->getParam('slide_id');
        if(!is_array($slideIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('megatronrevolution')->__('Please select slide(s).'));
        } else {
            try {
                $sliderModel = Mage::getModel('megatronrevolution/megatronrevolution');
                foreach ($slideIds as $slideId) {
                    $sliderModel->load($slideId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('megatronrevolution')->__(
                        'Total of %d slide(s) were deleted.', count($slideIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }



}
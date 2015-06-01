<?php
/**
 * @version   1.0 14.08.2012
 * @author    TonyEcommerce http://www.TonyEcommerce.com <support@TonyEcommerce.com>
 * @copyright Copyright (c) 2012 TonyEcommerce
 */

class Etheme_Megatrongallery_Block_Adminhtml_Megatrongallery_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('megatrongallery');
      $this->setDefaultSort('slide_id');
      $this->setDefaultDir('desc');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('megatrongallery/megatrongallery')->getCollection();
      foreach($collection as $link){
          if($link->getStoreId() && $link->getStoreId() != 0 ){
              $link->setStoreId(explode(',',$link->getStoreId()));
          }
          else{
              $link->setStoreId(array('0'));
          }
      }
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('slide_id', array(
          'header'    => Mage::helper('megatrongallery')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'slide_id',
      ));

      if (!Mage::app()->isSingleStoreMode()) {
          $this->addColumn('store_id', array(
              'header'        => Mage::helper('megatronsimple')->__('Store View'),
              'index'         => 'store_id',
              'type'          => 'store',
              'store_all'     => true,
              'store_view'    => true,
              'sortable'      => true,
              'filter_condition_callback' => array($this,
                  '_filterStoreCondition'),
          ));
      }

      $this->addColumn('caption', array(
          'header'    => Mage::helper('megatrongallery')->__('Title'),
          'align'     =>'left',
          'index'     => 'caption',
      ));

      $this->addColumn('image', array(
          'header'    => Mage::helper('megatrongallery')->__('Image'),
          'align'     =>'left',
          'index'     => 'image',
          'renderer'  => 'megatrongallery/renderer_image',
      ));



      $this->addColumn('sort', array(
          'header'    => Mage::helper('megatrongallery')->__('Sort Order'),
          'align'     =>'left',
          'index'     => 'sort',
      ));




      $this->addColumn('status', array(
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(1 => 'Enabled', 2 => 'Disabled'),
          'header'    => Mage::helper('megatrongallery')->__('Status'),
          'align'     => 'left',
          'width'     => '20px',
      ));
	  
      $this->addColumn('action',
            array(
                'header' => Mage::helper('catalog')->__('Action'),
                'width' => '50px',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('catalog')->__('Edit'),
                        'url' => array(
                            'base'=>'*/*/edit',
                            'params'=>array('store'=>$this->getRequest()->getParam('store'))
                        ),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
      ));

      return parent::_prepareColumns();
  }


  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

  protected function _prepareMassaction()
  {
        $this->setMassactionIdField('slide_id');
        $this->getMassactionBlock()->setFormFieldName('slide_id');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('megatrongallery')->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        // public function massDeleteAction() in Mage_Adminhtml_Tax_RateController
            'confirm' => Mage::helper('megatrongallery')->__('Are you sure?')
        ));
        return $this;
  }

    protected function _filterStoreCondition($collection, $column){
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }




}
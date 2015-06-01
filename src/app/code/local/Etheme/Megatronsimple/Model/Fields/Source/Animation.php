<?php
/**
 * @version   1.0 14.08.2012
 * @author    TonyEcommerce http://www.TonyEcommerce.com <support@TonyEcommerce.com>
 * @copyright Copyright (c) 2012 TonyEcommerce
 */

class Etheme_Megatronsimple_Model_Fields_Source_Animation
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'fade','label' => Mage::helper('megatronconfig')->__('Fade')),
            array('value'=>'slide','label' => Mage::helper('megatronconfig')->__('Slide')),
        );
    }
}

<?php
/**
 * INCHOO's FREE EXTENSION DISCLAIMER
 *
 * Please do not edit or add to this file if you wish to upgrade Magento
 * or this extension to newer versions in the future.
 *
 * Inchoo developers (Inchooer's) give their best to conform to
 * "non-obtrusive, best Magento practices" style of coding.
 * However, Inchoo does not guarantee functional accuracy of specific
 * extension behavior. Additionally we take no responsibility for any
 * possible issue(s) resulting from extension usage.
 *
 * We reserve the full right not to provide any kind of support for our free extensions.
 *
 * You are encouraged to report a bug, if you spot any,
 * via sending an email to bugreport@inchoo.net. However we do not guaranty
 * fix will be released in any reasonable time, if ever,
 * or that it will actually fix any issue resulting from it.
 *
 * Thank you for your understanding.
 */

/**
 * @category Inchoo
 * @package Inchoo_Prevnext
 * @author Branko Ajzele <ajzele@gmail.com, http://foggyline.net>
 * @copyright Inchoo <http://inchoo.net>
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Prevnext_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return Mage_Catalog_Model_Product or FALSE
     */
    public function getPreviousProduct($image=false)
    {

            $prodId = Mage::registry('current_product')->getId();

            $positions = Mage::getSingleton('core/session')->getInchooFilteredCategoryProductCollection();


            if (!$positions) {
                $positions = array_reverse(array_keys(Mage::registry('current_category')->getProductsPosition()));
            }
            
            $cpk = @array_search($prodId, $positions);

            $slice = array_reverse(array_slice($positions, 0, $cpk));

            foreach ($slice as $productId) {
                    $product = Mage::getModel('catalog/product')
                                                    ->load($productId);

                    if ($product && $product->getId() && $product->isVisibleInCatalog() && $product->isVisibleInSiteVisibility()) {
                        if(!$image)return $product;
                        else  return Mage::helper('catalog/image')->init($product, 'small_image')->resize(102, 124);
                    }
            }

            return false;
    }


    /**
     * @return Mage_Catalog_Model_Product or FALSE
     */
    public function getNextProduct($image=false)
    {
            $prodId = Mage::registry('current_product')->getId();

            $positions = Mage::getSingleton('core/session')->getInchooFilteredCategoryProductCollection();
            
            if (!$positions) {
                $positions = array_reverse(array_keys(Mage::registry('current_category')->getProductsPosition()));
            }            
            
            $cpk = @array_search($prodId, $positions);
            
            $slice = array_slice($positions, $cpk + 1, count($positions));

            foreach ($slice as $productId) {
                    $product = Mage::getModel('catalog/product')
                                                    ->load($productId);

                    if ($product && $product->getId() && $product->isVisibleInCatalog() && $product->isVisibleInSiteVisibility()) {
                        if(!$image)return $product;
                        else return Mage::helper('catalog/image')->init($product, 'small_image')->resize(102, 124);
                    }
            }

            return false;
    }

}

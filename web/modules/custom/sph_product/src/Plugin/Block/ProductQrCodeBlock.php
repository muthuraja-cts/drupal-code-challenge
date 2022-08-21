<?php

namespace Drupal\sph_product\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'Product QR Code' block.
 *
 * @Block(
 *  id = "sph_product_product_qr_code",
 *  label = "Product QR Code",
 *  admin_label = @Translation("Product QR Code")
 * )
 */
class ProductQrCodeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = array();
    //if node is found from routeMatch create a markup with node ID's.
    if ($node = \Drupal::routeMatch()->getParameter('node')) {
      // To debug how the cache works properly.
      \Drupal::logger('sph_product')->info('qr code link is @link', ['@link' => $node->field_app_purchase_link->uri]);
      $purchase_link    = $node->field_app_purchase_link->uri;
      $qr_code          = $this->qrCodeGeneration($purchase_link);
      $build['node_id'] = array(
        '#theme'   => 'qr_code_generation_block',
        '#qr_code' => $qr_code,
      );
    }
    return $build;
  }

  /*
   * Generate QR code for the provided link.
   *
   * @param string $purchase_link
   *   The URL.
   * @return string
   *   The barcode as HTML.
   */
  public function qrCodeGeneration($purchase_link) {
    try {
      $barcode = new \Com\Tecnick\Barcode\Barcode();
      $bobj    = $barcode->getBarcodeObj(
        'QRCODE,H', // barcode type and additional comma-separated parameters
        $purchase_link, // data string to encode
        -4, // bar width (use absolute or negative value as multiplication factor)
        -4, // bar height (use absolute or negative value as multiplication factor)
        'black', // foreground color
        array(-2, -2, -2, -2) // padding (use absolute or negative values as multiplication factors)
      )->setBackgroundColor('white'); // background color

      // output the barcode as HTML div (see other output formats in the documentation and examples)
      $html = $bobj->getHtmlDiv();
      return $html;
    } catch (\Exception $e) {
      watchdog_exception('sph_product', $e);
    }
  }

  /**
   * {@inheritDoc}
   */
  public function getCacheTags() {
    //With this when your node change your block will rebuild
    if ($node = \Drupal::routeMatch()->getParameter('node')) {
      //if there is node add its cachetag
      return Cache::mergeTags(parent::getCacheTags(), array('node:' . $node->id()));
    } else {
      //Return default tags instead.
      return parent::getCacheTags();
    }
  }
  
  /**
   * {@inheritDoc}
   */
  public function getCacheContexts() {
    //if you depends on \Drupal::routeMatch()
    //you must set context of this block with 'route' context tag.
    //Every new route this block will rebuild
    return Cache::mergeContexts(parent::getCacheContexts(), array('route'));
  }

}

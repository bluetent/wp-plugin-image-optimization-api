<?php
/**
 * Class ImageOptimizeJpg
 */
class ImageOptimizeJpgHandler extends ImageOptimizeAbstractHandler {
  public $mime_type = 'image/jpeg';
  public $handler_slug = 'image_optimize_jpg';

  /**
   * Required to properly setup the object.
   */
  public function __construct() {
    parent::__construct($this->handler_slug, $this->mime_type, get_option($this->handler_slug . '_binary'));
  }

  /**
   * Required to process any sort of handling you might need.
   * @param $id
   */
  public function attachment_optimize($id) {
    $images = self::get_images($id);
    $cmd = "cd " . escapeshellarg(ABSPATH) . "; ";
    if($images) {
      foreach($images as $img) {
        $cmd .= $this->binary_path . " -p -m70 --strip-all " . escapeshellarg($img) . "; ";
      }
      $cmd .= ' 2>&1';
    }
    if(!empty($cmd)) {
      $output = shell_exec($cmd);
      //@todo: something with the output...
    }
  }
}
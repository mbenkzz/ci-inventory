<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/fpdf/fpdf.php';

class Pdf extends FPDF
{
  const BORDER_NO = 0;
  const BORDER_YES = 1;

  

  public function __construct($params)
  {
    // set default params
    $params = array_merge([
      'orientation' => 'P',
      'unit' => 'mm',
      'size' => 'A4'
    ], $params);
    parent::__construct($params['orientation'], $params['unit'], $params['size']);
  }
}

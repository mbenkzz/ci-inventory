<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/fpdf/fpdf.php';

class Pdf extends FPDF
{
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

  public function Header()
  {
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(80);
    $this->Cell(30, 10, 'Title', 1, 0, 'C');
    $this->Ln(20);
  }

  public function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
  }
}

<?php 

/**
* 
*/
// require_once dirname(__file__).'TCPDF/tcpdf.php';
require_once 'TCPDF/tcpdf.php';

class Pdf_report extends TCPDF {

	protected $ci;

	function __construct() {
		$this->ci =& get_instance();
	}

}
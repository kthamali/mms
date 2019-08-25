<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// include autoloader
require_once  dirname(__FILE__) . '/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfGenerator extends Dompdf
{
	private $renderer;

	function __construct()
	{
		parent::__construct();

		$options = new Options();
		$options->set('defaultFont', 'Courier');
		$options->set('isRemoteEnabled', TRUE);
		$options->set('debugKeepTemp', TRUE);
		$options->set('isHtml5ParserEnabled', true);
		
		$this->renderer = new Dompdf($options);


	}

	public function Generate($html)
	{
		$this->renderer->loadHtml($html);
		$this->renderer->setPaper('A4');
		$this->renderer->render();
		$this->renderer->stream("sample.pdf", array(
			"Attachment" => 0
		));
	}

	public function GenerateLan($html)
	{
		$this->renderer->loadHtml($html);
		$this->renderer->setPaper('A4', 'landscape');
		$this->renderer->render();
		$this->renderer->stream("sample.pdf", array(
			"Attachment" => 0
		));
	}
}


?> 
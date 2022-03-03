<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Barcode extends MY_Controller {
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        
	}
	public function create($purchase_id_fk){
		$this->load->helper('barcode');
		$this->load->model('General_model');
		
		$this->form_validation->set_rules('barcode_count', 'Count', 'required');
		$template['purchase_id_fk'] = $purchase_id_fk;
		if ($this->form_validation->run() == FALSE) {

            $template['body'] = 'Barcode/add';
			$template['script'] = 'Barcode/script';
			
			$this->load->view('template', $template);
		}
		else{
			$count = $this->input->post('barcode_count');
			$img			=	code128BarCode($purchase_id_fk, 1);
	        ob_start();
			imagepng($img);
			$output_img		=	ob_get_clean();

			$template['records'] = $this->General_model->get_row('purchase_details','purchase_id',$purchase_id_fk);
			$product_name = $this->General_model->get_data('product_details','product_id','product_name',$template['records']->product_id_fk);
        	$template['records']->product_name = $product_name[0]->product_name;

			$template['body'] = 'Barcode/add';
			$template['script'] = 'Barcode/script';
			$template['count'] = $count;
			$template['barcode_image'] = base64_encode($output_img);
			
			$this->load->view('template', $template);

			// echo '<img src="data:image/png;base64,' .  . '" />'; 
		}
		
	}

	public function generate($purchase_id_fk){
		$this->load->helper('barcode');
		$this->load->model('General_model');
		$filename = "barcode/lilac.txt";

		$dest_folder = "barcode/".$purchase_id_fk;

		if (!file_exists($dest_folder)) {
		    mkdir($dest_folder, 0777, true);
		}
		$destfilename = $dest_folder."/lilac-code".time().".txt";
		
		$records = $this->General_model->get_row('purchase_details','purchase_id',$purchase_id_fk);
		$product_name = $this->General_model->get_data('product_details','product_id','product_name',$records->product_id_fk);
    	$records->product_name = $product_name[0]->product_name;



    	$count = strlen((string)$purchase_id_fk);

    	if($count/2 == 0){
    		$barcode_val = $purchase_id_fk;
    	}
    	else{

    		$lastdigit =  $purchase_id_fk%10;
    		$firstdigit = substr($purchase_id_fk, 0, -1);
    		
    		$barcode_val = $firstdigit;
    		$barcode_val.="!100";
    		$barcode_val.=$lastdigit;
    	}

    	

	    //read the entire string
		$str=file_get_contents($filename);

		//replace something in the file string - this is a VERY simple example
		$str=str_replace("<!--PRODUCT_NAME-->", $product_name[0]->product_name,$str);
		$str=str_replace("<!--BARCODE-->", $barcode_val ,$str);
		$str=str_replace("<!--BARCODE_TEXT-->", $purchase_id_fk ,$str);
		$str=str_replace("<!--AMOUNT-->", $records->sale_price,$str);

		//write the entire string
		if(file_put_contents($destfilename, $str)) {

			header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename='.basename($destfilename));
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($destfilename));
		    readfile($destfilename);
		    
			$response_text = "File saved successfully";
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			redirect('/purchase/', 'refresh');
		}
		else{
			$response_text = "something went wrong";
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;error&quot;}");
			redirect('/purchase/', 'refresh');
		}
		
		
	}


	public function generateString($purchase_id_fk){
		$this->load->helper('barcode');
		$this->load->model('General_model');
		$filename = "barcode/lilac.txt";

		$dest_folder = "barcode/".$purchase_id_fk;

		if (!file_exists($dest_folder)) {
		    mkdir($dest_folder, 0777, true);
		}
		$destfilename = $dest_folder."/lilac-code".time().".txt";
		// $myfile = fopen($filename, "r") or die("Unable to open file!");
		// $content = fread($myfile,filesize($filename));
		// fclose($myfile);
		
		$records = $this->General_model->get_row('purchase_details','purchase_id',$purchase_id_fk);
		$product_name = $this->General_model->get_data('product_details','product_id','product_name',$records->product_id_fk);
    	$records->product_name = $product_name[0]->product_name;

	    //read the entire string
		$str=file_get_contents($filename);

		//replace something in the file string - this is a VERY simple example
		$str=str_replace("<!--PRODUCT_NAME-->", $product_name[0]->product_name,$str);
		$str=str_replace("<!--BARCODE-->", $product_name[0]->product_name ,$str);
		$str=str_replace("<!--AMOUNT-->", $records->sale_price,$str);

		//write the entire string
		if(file_put_contents($destfilename, $str)) {

			header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename='.basename($destfilename));
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($destfilename));
		    readfile($destfilename);
		    
			$response_text = "File saved successfully";
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			redirect('/purchase/', 'refresh');
		}
		else{
			$response_text = "something went wrong";
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;error&quot;}");
			redirect('/purchase/', 'refresh');
		}
		
		
	}

}
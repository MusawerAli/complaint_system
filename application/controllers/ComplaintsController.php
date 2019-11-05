<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComplaintsController extends CI_Controller {

    public function index(){

        $this->load->view('complaints/complaints-view');

    }
}

?>
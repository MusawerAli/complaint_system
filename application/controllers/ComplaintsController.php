<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ComplaintsController extends CI_Controller {

    public function index(){

        $this->load->view('complaints/complaints-view');

    }





    //Add Complaints 
    public function add_complaints()
    {
       
        $this->load->model('ComplaintsModel');

        $this->ComplaintsModel->add_complaints();
    }


    

    //fetch complaints with ajax to datatables
    public function fetch_complaints()
    {
        $this->load->model("ComplaintsModel");  
           $fetch_data = $this->ComplaintsModel->make_datatables();  
        $data = array();
        
        foreach($fetch_data as $row){
            $sub_array = array();
            $sub_array[] = $row->cnic;
            $sub_array[] = $row->program;
            $sub_array[] = $row->problem;
            $sub_array[] = $row->comment;
            $sub_array[] = $row->status;
            $sub_array[] = $row->piority;
            $sub_array[] = $row->date;
            $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-xs">Update</button>';
            $data[] = $sub_array;


        }
        
        $output = array(
            "draw"                    =>     intval($_POST["draw"]),
            "recordsTotal"          =>      $this->ComplaintsModel->get_all_data(),
            "recordsFiltered"     =>     $this->ComplaintsModel->get_filtered_data(),
            "data"                    =>     $data
        );

        // print_r($output);
        echo json_encode($output); 

    }
}

?>
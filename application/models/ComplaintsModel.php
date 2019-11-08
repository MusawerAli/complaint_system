<?php  
 class ComplaintsModel extends CI_Model  
 { 

    var $table = "complaints";
    var $select_column = array("id","status","cnic","program","piority","problem","date","comment");
    var $order_column = array("id",null,null,null,null,null,null,null);


    function make_query()
    {
      $this->db->select($this->select_column);
      $this->db->from($this->table);
      if(isset($_POST["search"]["value"]))
      {
        $this->db->like("cnic");
        $this->db->or_like("status");
      }

      if(isset($_POST["order"]))
      {
        $this->db->order_by(

                $this->order_column
                [
                  $_POST['order']['0']['column']
                ], 
                  $_POST['order']['0']['dir']
          );
      }else{
        $this->db->order_by('id','DESC');

      }
    }

    function make_datatables(){  
      $this->make_query();  
      if($_POST["length"] != -1)  
      {  
           $this->db->limit($_POST['length'], $_POST['start']);  
      }  
      $query = $this->db->get();  
      return $query->result();  
 } 


    function get_filtered_data()
    {
      $this->make_query();
      $query = $this->db->get();
      return $query->num_rows();

    }


    function get_all_data()
    {
      $this->db->select("*");
      $this->db->from($this->table);
      return $this->db->count_all_results();

    }



    //add into database
    public function add_complaints()
    {
        
     
        
      
        
        $insert_data = array(  
            'piority'          =>     $this->input->post('piority'),  
            'problem'               =>       $this->input->post('problem'),  
            'program'                    =>        $this->input->post('program'),
            'cnic'                         =>       $this->input->post('cnic'),
       );

      $query =  $this->db->insert('complaints',$insert_data);
      if($query){
          echo "Complaint Submited success";
      }

    }


    



  }
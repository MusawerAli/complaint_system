<?php $this->load->view('header'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="container">
  
  <div>
    <h1>Complaints</h1>
  </div>
  <button class="w3-padding w3-right w3-btn w3-blue w3-round fa fa-plus" data-toggle="modal" data-target="#userModal" style="margin-top:10px;margin-bottom:10px">
   Add Complaints</button>
 
  <div class="w3-border " style="margin-top:70px">
 
    <table class="table table-hover table-responsive-lg table-striped table-bordered " id="complaints_data">
      <thead>
        <tr>
        
          <th>CNIC</th>
          <th>Program</th>
          <th>Problem</th>
          <th>comment</th>
          <th>status</th>
          <th>Piority</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr>
          <td>1</td>
          <td>31202496777897</td>
          <td>Admission</td>
          <td>Name is not in listed</td>
          <td>not fulfil merit list</td>
          <td>Solved</td>
          <th>High</th>
          <th>21-08-1996</th>
          <th><button>action</button></th>
        </tr>
        <tr>
          <td>2</td>
          <td>31202496777897</td>
          <td>Admission</td>
          <td>Name is not in listed</td>
          <td>not fulfil merit list</td>
          <td>Solved</td>
          <th>Medium</th>
          <th>21-08-1996</th>
          <th><button>action</button></th>
        </tr> -->
      </tbody>
    </table>
  </div>
</div>

<div id="userModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="POST" id="complaint_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add User</h4>  
                     </div>  
                     <div class="modal-body">  
                          <label>CNIC</label>  
                          <input type="number" name="cnic" id="cnic" class="form-control" />  
                          <br />  
                          <div class="form-group">
                            <label for="program">Program:</label>
                            <select class="form-control" name="program" id="program" >
                              <option value="bscs">BSCS</option>
                              <option value="bsit">BSIT</option>
                              <option value="mphil" >M-phil</option>
                              <option value="phd">PHD</option>
                            </select>
                          </div> 
                          <div class="form-group">
                            <label for="piority">Piority:</label>
                            <select class="form-control" name="piority" id="piority">
                              <option value="high" >High</option>
                              <option value="low">Low</option>
                              <option value="medium">Medium</option>
                              <option value="serious" >Serious</option>
                            </select>
                          </div> 
                          <br />  
                          <label>Problem</label>
                          <br>  
                          <textarea name="problem" id="problem" cols="60" rows="5"></textarea>  
                     </div>  
                     
                     <div class="modal-footer">  
                          <input type="submit" name="action" class="btn btn-success" value="Add" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>

<?php $this->load->view('footer'); ?>


<script src=" <?= base_url(); ?>assets/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src=" <?= base_url(); ?>assets/DataTables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js">


</script>
  <script type="text/javascript" language="javascript" >  
  $(document).ready(function(){  
  
    var dataTable =   $('#complaints_data').DataTable({
        
      "processing":true,
      "serverSide":true,
      "order": [],
      "ajax":{
            url:"<?=base_url().'ComplaintsController/fetch_complaints';?>",
            type:"POST"
      },

      "columnDefs":[  
                {  
                     "targets":[0],  
                     "orderable":false,  
                },  
           ],

      });

      $(document).on('submit','#complaint_form',function(event){
        event.preventDefault();  
        var cnic = $('#cnic').val();
        var program = $('#program').val();
        var piority = $('#piority').val();
        var problem = $('#problem').val();

        if(cnic !='' && program !='' && piority !='' && problem !='')
        {
          $.ajax({
            url:"<?php echo base_url().'ComplaintsController/add_complaints'?>",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,
                     success:function(data)  
                     {  
                          alert(data);  
                          $('#complaint_form')[0].reset();  
                          $('#userModal').modal('hide');  
                         // dataTable.ajax.reload();  
                     }
          });
        }
        else
        {
          alert('All fields are required');
          return false;
        }
      });



      


    });
  </script>
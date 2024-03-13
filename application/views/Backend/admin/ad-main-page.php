<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="RedstarHospital" />
    <title>Admin Panel</title>
    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="<?php echo base_url(); ?>assets/backend_assets/fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/backend_assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/backend_assets/fonts/font-awesome/v6/css/all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/backend_assets/fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
    <!--bootstrap -->
    <link href="<?php echo base_url(); ?>assets/backend_assets/bundles/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend_assets/bundles/material/material.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend_assets/css/material_style.css">
    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/backend_assets/css/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/backend_assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/backend_assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/backend_assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/backend_assets/css/theme-color.css" rel="stylesheet" type="text/css" />
 

     <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.ico" />

    <link href="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  
  <!-- new -->
   <link href="<?php echo base_url(); ?>assets/wnoty/wnoty.css" rel="stylesheet" type="text/css" />  
   <link href="<?php echo base_url(); ?>assets/wnoty/jquery-confirm.min.css" rel="stylesheet" type="text/css" />  
   <!-- New -->
 <link href="<?php echo base_url(); ?>assets/calendar/dist/fullcalendar.css" rel="stylesheet" type="text/css" />
 
 
 <!-- Owl Carousel Assets -->
 <link href="<?php echo base_url(); ?>assets/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/owl-carousel/owl.theme.css" rel="stylesheet">

 <style>
    .page-container-bg-solid .page-bar, .page-content-white .page-bar {
   
    margin: 15px -20px 0px !important;
}
.page-content-wrapper .page-content{
     
     margin-left: 0px !important;
}
 </style>
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md page-full-width header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
        <!-- start header -->
         <?php $this->load->view('Backend/admin/admin-temp/header'); ?> 
        <div class="page-container" style="margin-top:0px !important;">
            <!-- start sidebar menu -->
            <?php $this->load->view('Backend/admin/admin-temp/sidebar'); ?> 
            <!-- end sidebar menu -->
            <!-- start page content -->
            <div class="page-content-wrapper mt-10">
                <div class="page-content">
                        <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                       
                        </div>
                    </div>
                       
                    <div class="row ">
                        <div class="col-md-12 col-sm-12">
                            <div class="card card-box  ">
                                <div class="card-head center">
                                    <h2>Welcome  <?php echo $this->session->userdata('name'); ?>  </h2>

                                  
                                 
                                </div>
                                <div class="card-body" id="bar-parent">
                                    <div class="doctor-profile">
                                
                                        
                                            <!-- <img src=" <?php echo base_url('assets/logo.jpg'); ?>" alt="" style="    max-width: 112px;"> -->

                                            <img alt="image"  src="<?php if($admin_data->profile ) { echo base_url('assets/uploads/profile/').$admin_data->profile; }else{ echo base_url('assets/default.png'); } ?> "  class="doctor-pic" >
                                     

                                        <div class="profile-usertitle">
                                            <div class="doctor-name"> <?php echo $this->session->userdata('name'); ?> </div>
                           
                                                <!-- <h4 style="font-weight:bold">  <?php echo  $result->team; ?>  </h4> -->
                                              
                                        </div>
                                        <p> <?php echo $this->session->userdata('email'); ?></p>
                                        <div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
           
                    <!--  -->
                    <?php 
                          if($this->session->userdata('user_status') == '1') {   ?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card  card-box">
                                <div class="card-head">
                                    <header>Payment Details</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table class="table display product-overview mb-30" id="support_table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Roll No</th>
                                                        <th>Amount</th>
                                                        <th>Date Of Payment</th>
                                                        <th>Status</th>
                                                        <!-- <th>Room No</th> -->
                                                     
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 
                                                    <?php 
                                                 
                                                        $query2 = $this->db->get_where('payment', array('isActive' => '1','student'=> $this->session->userdata('user_login_id')));// $this->db->get('event_card');
                                                        $data = $query2->result();

                                                               $i = 1;
                                                               if($query2->num_rows() > 0) {
                                                                foreach ($data as $member) {

                                                                    $d = date('d-m-Y', strtotime($member->date));
                                                                    
                                                                    $query = $this->db->get_where('admin',array('isActive'=> '1','user_status'=>'1','id'=>$member->student));
                                                                    $result = $query->row();
                                                                    if($member->status == 'Recived'){
                                                                        $color = 'success';
                                                                    }else{
                                                                        $color = 'danger';
                                                                    }
                                                                    ?>
                                                                 <tr class="odd gradeX" data-id="<?=$member->id;?>">
                                                                    <td > <?=$i; ?></td>
                                                                   
                                                                    <td >   <?=$result->roll_no; ?></td>
                                                                    <td >   <?=$member->amount; ?></td>
                                                                    <td >   <?=$d; ?></td>
                                                                    <td > <span class="label label-sm label-<?=$color?>">   <?=$member->status; ?></span></td>
                                                                   
                                                                    <?php  if($admin_data->user_status == '0') { ?>
                                                            
                                                                    <td >
                                                                        <a href="#" class="tblEditBtn"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#staticBackdrop" data-id="<?php echo $member->id; ?>">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                        <a class="tblDelBtn delete"  data-id="<?php echo $member->id; ?>"><!-- data-bs-toggle="modal"
                                                                            data-bs-target="#smallModel" -->
                                                                            <i class="fa fa-trash-o"></i>
                                                                        </a>
                                                                    </td>
                                                                    <?php  }  ?>
                                                                
                                                                </tr>


                                                                <?php $i++; } }else{
                                                                    echo '<tr><td></td><td></td><td></td><td rowspan="2">No Data</td><td></td><td></td></tr>';
                                                                } ?>
                                                            
                                                        <!-- <td>1</td>
                                                        <td>Jens Brincker</td>
                                                        <td>Dr.Kenny Josh</td>
                                                        <td>27/05/2016</td>
                                                        <td>
                                                            <span class="label label-sm label-success">Influenza</span>
                                                        </td>
                                                        <td>101</td> -->
                                                        <!-- <td>
                                                            <a href="javascript:void(0)" class="tblEditBtn">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" class="tblDelBtn">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </td> -->
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- end page content -->
            <!-- start chat sidebar -->

            <!-- end chat sidebar -->
        </div>
        <!-- end page container -->
       <!-- start footer -->
          <?php $this->load->view('Backend/admin/admin-temp/footer'); ?> 

          <!-- <script src="<?php echo base_url(); ?>assets/plotyjs/plotly.min.js"></script> -->
          <!-- <script src="<?php echo base_url(); ?>assets/plotyjs/plotlyjs-data.js"></script> -->
     <!-- new -->
 <script src="<?php echo base_url(); ?>assets/moment/moment.js"></script>
    <script type="text/javascript"
      src="<?php echo base_url(); ?>assets/calendar/dist/fullcalendar.min.js"></script>

      	<!-- owl carousel -->
	<script src="<?php echo base_url(); ?>assets/owl-carousel/owl.carousel.js"></script>
	<script src="<?php echo base_url(); ?>assets/owl-carousel/owl-carousel-data.js"></script>
</body>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>


//calender end
</script>

<div class="modal fade" id="smallModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form  id="form_sample_add" class="form-horizontal" method="post " enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Register Event
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                <label class="control-label col-md-2"> Name
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <input type="text" name="name" data-required="1" placeholder="Enter Name"
                        class="form-control input-height" required value="<?php  echo $admin_data->name; ?>"/>
                </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-md-2"> Email
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <input type="text" name="email" data-required="1" placeholder="Enter Email"
                        class="form-control input-height" required  value="<?php  echo $admin_data->email; ?>"/>
                </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-md-2"> Title
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <input type="text" name="title" data-required="1" placeholder="Enter Title"
                        class="form-control input-height" required/>
                </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-2"> Register 
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-8">
                        <textarea type="text" name="desc" data-required="1" row="3" placeholder="Enter Register"
                            class="form-control input-height" required></textarea>
                    </div>
                </div>
         
               
           
                <div class="modal-footer">
                <input type="hidden" name="startdate">
                      <input type="hidden" name="month">
                      <input type="hidden" name="id">
                      <input type="hidden" name="userid" value="<?php  echo $admin_data->id; ?>">
                      <input type="hidden" name="team" value="<?php  echo $admin_data->team; ?>">
                    <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save_event">Register Now</button>
                </div>
            </div>
            </form>
        </div>
    </div>


<script>
  //add events
  $(document).on('click','#save_event',function(){
        event.preventDefault();
        $("#form_sample_add").valid();


       
         var slot = $("input[name='title']").val();
         var start_date = $("input[name='startdate']").val();
       
     

    // Check if all required fields are filled out
    if (slot !== '' && start_date ) {
        
        $.ajax({
        type:'post',
        url: '<?php echo base_url("Admin/register_events");?>',
        data: new FormData($("#form_sample_add")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#form_sample_add')[0].reset();

          $('#smallModel').modal('hide');
         $(".modal-backdrop").remove();
        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 1000,
        position: 'top-right'

        });
                 setTimeout(function(){
         location.reload(true);
        },2000);

        }else if(data.status == 'error'){

          $.wnoty({
                type: 'error',
                message: data.message,
                autohideDelay: 2000,
                position: 'top-right'

                });
        }
        },
        });
        } else {

        }

        return false;
        })
    //update_reg_event

    $(document).on('click','#update',function(){
        event.preventDefault();
           $("#form_sample_add").valid();
         
         $.ajax({
        type:'post',
        url: '<?php echo base_url("Admin/update_reg_event");?>',
        data: new FormData($("#form_sample_add")[0]),
        contentType: false,
        processData: false, 
        success:function(resp){
        var data=$.parseJSON(resp);
        if(data.status == 'success'){
        $('#form_sample_add')[0].reset();
          $('#smallModel').modal('hide');
         $(".modal-backdrop").remove();

        $.wnoty({
        type: 'success',
        message: data.message,
        autohideDelay: 1000,
        position: 'top-right'

        });
         setTimeout(function(){
         location.reload(true);
        },2000);
  


       }else if(data.status == 'error'){
       
        $('#smallModel').modal('hide');
         $(".modal-backdrop").remove();
              $.wnoty({
                    type: 'error',
                    message: data.message,
                    autohideDelay: 2000,
                    position: 'top-right'

                    });
               setTimeout(function(){
         location.reload(true);
        },2000);
        }
        },
        });
       
     
        return false;
        })
         <?php  if($admin_data->user_status == '1') { ?>
       $(document).on('click', '.register', function(e) {
          //  $(".register").on("click", function() {
            e.preventDefault(); // Prevent the default action
               // console.log("Event " +date);
            
            
            var id = $(this).data('id');
            var date = $(this).data('date');
           // var dataid = $(this).data('user');
           //  $('#exampleModalLabel').text('Update Event')

            // Make an AJAX request to retrieve the data for the ID
            $.ajax({
                url: '<?php echo base_url("Admin/geteventregByID"); ?>?id=' + id,
                method: 'GET',
               // data: { id: id },
               data: { date: date,id:id },
                dataType: 'json',
                success: function(response) {
                    // Populate the modal with the data returned from the server
                    $('#smallModel [name="id"]').val(response.id);
                    $('#smallModel [name="title"]').val(response.title);
                    //$('#smallModel [name="desc"]').val(response.desc);
                    $('#smallModel [name="userId"]').val(response.userId);
                    $('#smallModel [name="team"]').val(response.team);
                    $('#smallModel [name="startdate"]').val(response.startdate);
                  
                    console.log("Successs ");
                    $('#smallModel').modal('show');
                    // setTimeout(function() {
                    //     $('#staticBackdrop').modal('show');
                    // }, 500);
                },
                error: function(xhr, status, error) {
                    console.log(error); // Handle the error if any
                }
            });
        });

          <?php } ?>

        $(document).on('click', '.cancel', function() {
            $(".modal-backdrop").remove();
            location.reload(true);
        });
    
    
</script>

  <div class="sidebar-container">
                <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                    <div id="remove-scroll" class="left-sidemenu">
                    <div class="slimScrollDiv" style="position: relative;overflow: hidden;width: auto;height: 479px;">
                        <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
                            data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <li class="sidebar-user-panel">
                                <div class="sidebar-user">
                                    <div class="sidebar-user-picture">

                                        <img alt="image"  src="<?php if($admin_data->profile ) { echo base_url('assets/uploads/profile/').$admin_data->profile; }else{ echo base_url('assets/default.png'); } ?> " >
                                     
                                        
                                    </div>
                                    <div class="sidebar-user-details">
                                        <div class="user-name"><?php echo $admin_data->name; ?></div>
                                        <div class="user-role"><?php echo $admin_data->role; ?></div>
                                    </div>
                                </div>
                            </li>


                           

                            <li class="nav-item <?=  !$this->uri->segment(2)  ? 'active' : '' ?>">
                                        <a href="<?php echo base_url(); ?>Admin/" class="nav-link "> <i data-feather="book"></i> <span class="title">
                                                Dashboard</span>
                                        </a>
                             </li>
                          
                             <?php  if($admin_data->user_status == '0') { ?>
                             <li class="nav-item <?= $this->uri->segment(2) === 'Students' ? 'active' : '' ?>">
                                        <a href="<?php echo base_url(); ?>Admin/Students" class="nav-link "><i data-feather="book"></i> <span class="title">
                                        Students</span>
                                        </a>
                                </li> 
                             <?php }  ?>
                           
                     
                             
                            <?php  if($admin_data->user_status == '0') { ?>

                                <li class="nav-item <?= $this->uri->segment(2) === 'All_Members' ? 'active' : '' ?>">
                                        <a href="<?php echo base_url(); ?>Admin/All_Members" class="nav-link "><i data-feather="book"></i>  <span class="title">
                                        
                                        Branches</span>
                                        </a>
                                 </li> 

                            <?php } ?>
                            <?php  if($admin_data->user_status == '0') { ?>

                                <li class="nav-item <?= $this->uri->segment(2) === 'Points' ? 'active' : '' ?>">
                                        <a href="<?php echo base_url(); ?>Admin/Points" class="nav-link "> <i data-feather="book"></i> <span class="title">
                                        
                                       Fee Payments</span>
                                        </a>
                                 </li> 

                            <?php } ?>
                            
                                <li class="nav-item <?= $this->uri->segment(2) === 'ExamResults' ? 'active' : '' ?>">
                                        <a href="<?php echo base_url(); ?>Admin/ExamResults" class="nav-link "> <i data-feather="book"></i> <span class="title">
                                        
                                        Exam Results</span>
                                        </a>
                                 </li> 

                            

                    
  


                           

                           
                        </ul>
                    </div>
                    </div>
                </div>
            </div> 

            
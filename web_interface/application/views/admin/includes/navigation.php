<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="d-flex">
  <div class="logo d-flex align-items-center">
  Hydrophonic
  </div>

  <?php 
  
  $profile=$this->db->where('id',$this->session->userdata('admin_id'))->get('users')->row_array() ;?>
  
  <div class="bell-gold d-flex ml-auto align-items-center">
    
    <div class="d-flex dropdown pt-1 show flex-row user-profile-dropdown pr-2">
      <a class="d-flex text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php if($profile['profile_photo']!=""){ ?>
                                  <img class="rounded-circle" src="<?php  echo $profile['profile_photo'] ."?a=".rand()?>" height="50px" width="50px" alt="...">
                                  <?php }else{?>

      
                                    <img class="rounded-circle" src="<?php echo base_url() . 'assets/'; ?>images/25.png" height="50px" width="50px">                              <?php } ?> 
    
      
    
    
      <div class="d-flex flex-column justify-content-start ml-3">
        <span class="d-block text-white font-weight-bold username-comment">
        <?php echo $profile['username'];?></span>
        <span class="date user-date text-white">@
        <?php echo $this->session->userdata('login_type');?> </span>
      </div>
    </a>
      <div class="dropdown-menu shadow custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
        <!--
        <a class="dropdown-item" href="#"><img class="img-fluid" src="<?php echo base_url() . 'assets/'; ?>images/settings-icon.png" alt=""> Settings</a>
        <a class="dropdown-item" href="#"><img class="img-fluid" src="<?php echo base_url() . 'assets/'; ?>images/help-icon.png" alt=""> Help</a>
-->
        <a class="dropdown-item" href="<?php echo base_url() . 'site/logout'; ?>"><img class="img-fluid" src="<?php echo base_url() . 'assets/'; ?>images/log-icon.png" alt=""> Logout</a>
      </div>
    </div>

  </span>

</div>

</div>

</div>

<div class="sidebar" style="position: absolute;">
  <ul>
  <!--
  <li><a href="<?php echo base_url() . 'admin/dashboard'; ?>"><i class="fa fa-dashcube"></i><span>Dashboard</span></a></li>
-->  
    <li><a href="<?php echo base_url() . 'admin/analytics'; ?>"><i class="fa fa-area-chart"></i><span>Analytics</span></a></li>
    <!--
    <li><a href="<?php echo base_url() . 'admin/selleroffers'; ?>"><i class="fa fa-viacoin"></i><span>Seller</span></a></li>
    -->
    <li><a href="<?php echo base_url() . 'admin/'; ?>"><i class="fa fa-user"></i><span>Operators</span></a></li>
   
<li><a href="<?php echo base_url() . 'admin/sensor'; ?>"><i class="fa fa-thermometer-full"></i><span>Sensor</span></a></li>
<li><a href="<?php echo base_url() . 'admin/sensorreading'; ?>"><i class="fa fa-database"></i><span>Sensor Reading</span></a></li>
   <li><a href="<?php echo base_url() . 'admin/camlist'; ?>"><i class="fa fa-camera" ></i><span>Camera’s</span></a></li>
    <li><a href="<?php  echo base_url() . 'admin/output'; ?>"><i class="fa fa-wrench"></i><span>Controls</span></a></li>
    <li><a href="<?php  echo base_url() . 'admin/profile'; ?>"><i class="fa fa-cogs"></i><span>Profile</span></a></li>
    <li><a target="blank" href="https://docs.google.com/forms/d/e/1FAIpQLSdvLT9wiSvGKDditoY_qfxnErsM8Fv54LVgfG-ARqVD1myO2w/viewform"><i class="fa fa-bug"></i><span>Feedback And Report Bug</span></a></li>
   <!--
    <li><a href="<?php  echo base_url() . 'admin/trigger'; ?>"><i class="fa fa-viacoin"></i><span>Trigger</span></a></li>
    <li><a href="<?php // echo base_url() . 'admin/jobs'; ?>"><i class="fa fa-viacoin"></i><span>Jobs</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'admin/sellerreviews'; ?>"><i class="fa fa-viacoin"></i><span>Seller's Review</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'admin/bids'; ?>"><i class="fa fa-viacoin"></i><span>Bids</span></a></li>-->
    <!-- <li><a href="<?php // echo base_url() . 'admin/gigs'; ?>"><i class="fa fa-viacoin"></i><span>Gigs</span></a></li>-->
      <!--<li><a href="<?php // echo base_url() . 'admin/chats'; ?>"><i class="fa fa-viacoin"></i><span>Chats</span></a></li>-->

   

  </ul>
</div>

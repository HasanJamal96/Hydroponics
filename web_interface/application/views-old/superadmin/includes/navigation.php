<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="d-flex">
  <div class="logo d-flex align-items-center">
  Hydrophonic
  </div>

  
  
  <div class="bell-gold d-flex ml-auto align-items-center">
    
    <div class="d-flex dropdown pt-1 show flex-row user-profile-dropdown pr-2">
      <a class="d-flex text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     
     <?php if($this->session->userdata('profile_photo') ==""){ ?>
      <img class="rounded-circle" src="<?php echo base_url() . 'assets/'; ?>images/25.png" height="50px" width="50px">
     <?php }else{?>
      <img class="rounded-circle" src="<?php echo $this->session->userdata('profile_photo');?>" height="50px" width="50px">
     <?php } ?>
     
      <div class="d-flex flex-column justify-content-start ml-3">
        <span class="d-block text-white font-weight-bold username-comment">
        <?php echo $this->session->userdata('name');?></span>
        <span class="date user-date text-white">@
        <?php echo $this->session->userdata('login_type');?> </span>
      </div>
    </a>
      <div class="dropdown-menu shadow custom-dropdown-menu" aria-labelledby="dropdownMenuLink">
        
        <a class="dropdown-item" href="<?php echo base_url().'superadmin/editprofile' ?>"><img class="img-fluid" src="<?php echo base_url() . 'assets/'; ?>images/settings-icon.png" alt=""> Profile Setting</a>
        <!--
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
  <li><a href="<?php echo base_url() . 'superadmin/'; ?>"><i class="fa fa-dashcube"></i><span>Dashboard</span></a></li>
-->  
    <li><a href="<?php echo base_url() . 'superadmin/anaylatics'; ?>"><i class="fa fa-area-chart"></i><span>Analytics</span></a></li>
    
    <li><a href="<?php echo base_url() . 'superadmin/site'; ?>"><i class="fa fa-viacoin"></i><span>Location</span></a></li>
    
    <li><a href="<?php echo base_url() . 'superadmin/adminlist'; ?>"><i class="fa fa-dashcube"></i><span>Admins</span></a></li>
  <!-- 
<li><a href="#"><i class="fa fa-viacoin"></i><span>Sensor</span></a></li>
<li><a href="#"><i class="fa fa-viacoin"></i><span>Reading</span></a></li>
   -->
    <!--<li><a href="<?php // echo base_url() . 'superadmin/orders'; ?>"><i class="fa fa-viacoin"></i><span>Orders</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'superadmin/offers'; ?>"><i class="fa fa-viacoin"></i><span>Offers</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'superadmin/jobs'; ?>"><i class="fa fa-viacoin"></i><span>Jobs</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'superadmin/sellerreviews'; ?>"><i class="fa fa-viacoin"></i><span>Seller's Review</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'superadmin/bids'; ?>"><i class="fa fa-viacoin"></i><span>Bids</span></a></li>-->
    <!-- <li><a href="<?php // echo base_url() . 'superadmin/gigs'; ?>"><i class="fa fa-viacoin"></i><span>Gigs</span></a></li>-->
      <!--<li><a href="<?php // echo base_url() . 'superadmin/chats'; ?>"><i class="fa fa-viacoin"></i><span>Chats</span></a></li>-->

   

  </ul>
</div>

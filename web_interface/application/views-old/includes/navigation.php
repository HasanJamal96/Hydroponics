<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="d-flex">
  <div class="logo d-flex align-items-center">
  Joberiss
  </div>

  
  
  <div class="bell-gold d-flex ml-auto align-items-center">
    
    <div class="d-flex dropdown pt-1 show flex-row user-profile-dropdown pr-2">
      <a class="d-flex text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     
      <img class="rounded-circle" src="<?php echo base_url() . 'assets/'; ?>images/25.png" height="50px" width="50px">
      <div class="d-flex flex-column justify-content-start ml-3">
        <span class="d-block text-white font-weight-bold username-comment">
        <?php echo $this->session->userdata('name');?></span>
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
  <li><a href="<?php echo base_url() . 'site/dashboard'; ?>"><i class="fa fa-dashcube"></i><span>Dashboard</span></a></li>
-->  
    <li><a href="<?php echo base_url() . 'site/analytics'; ?>"><i class="fa fa-area-chart"></i><span>Analytics</span></a></li>
    <!--
    <li><a href="<?php echo base_url() . 'site/selleroffers'; ?>"><i class="fa fa-viacoin"></i><span>Seller</span></a></li>
    -->
    <li><a href="<?php echo base_url() . 'site/home'; ?>"><i class="fa fa-user"></i><span>Users</span></a></li>
<!--
    <li><a href="<?php echo base_url() . 'site/buyer'; ?>"><i class="fa fa-viacoin"></i><span>Buyer</span></a></li>
    
     <li><a href="<?php echo base_url() . 'site/dispute'; ?>"><i class="fa fa-viacoin"></i><span>Dispute</span></a></li>
    -->
     <!--<li><a href="<?php // echo base_url() . 'site/categories'; ?>"><i class="fa fa-viacoin"></i><span>Categories</span></a></li>-->
   
<li><a href="<?php  echo base_url() . 'site/roasters'; ?>"><i class="fa fa-sitemap"></i><span>Roasters</span></a></li>
<li><a href="<?php  echo base_url() . 'site/events'; ?>"><i class="fa fa-viacoin"></i><span>Events</span></a></li>
   
    <!--<li><a href="<?php // echo base_url() . 'site/orders'; ?>"><i class="fa fa-viacoin"></i><span>Orders</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'site/offers'; ?>"><i class="fa fa-viacoin"></i><span>Offers</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'site/jobs'; ?>"><i class="fa fa-viacoin"></i><span>Jobs</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'site/sellerreviews'; ?>"><i class="fa fa-viacoin"></i><span>Seller's Review</span></a></li>-->
    <!--<li><a href="<?php // echo base_url() . 'site/bids'; ?>"><i class="fa fa-viacoin"></i><span>Bids</span></a></li>-->
    <!-- <li><a href="<?php // echo base_url() . 'site/gigs'; ?>"><i class="fa fa-viacoin"></i><span>Gigs</span></a></li>-->
      <!--<li><a href="<?php // echo base_url() . 'site/chats'; ?>"><i class="fa fa-viacoin"></i><span>Chats</span></a></li>-->

   

  </ul>
</div>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
         
            <!-- Left Menu Start -->
            <?php //if ($this->auth_level == 9 || $this->auth_level == 8) { ?>
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" key="t-menu">Menu</li>
                    <li>
                        <a href="<?php echo site_url('/'); ?>" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    <?php if ($this->auth_level == 9) { ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-cog"></i>
                            <span key="t-settings">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <!--  <li><a href="<?php echo site_url('Role_master'); ?>" key="t-crypto">Role Management</a></li> -->
                            <li><a href="<?php echo site_url('Company_settings'); ?>" key="t-crypto">Company Setting</a></li>
                        </ul>
                    </li>
                    <?php 
                    }?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect">
                            <i class="bx bx-task"></i>
                            <span key="t-dashboards"> Master</span>
                        </a>   
                        <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo site_url('customer');?>" key="t-country">Customer Management</a></li>
                            <li><a href="<?php echo site_url('hsn_code'); ?>" key="t-saas">HSN Code</a></li>
                         <li><a href="<?php echo site_url('uom'); ?>" key="t-saas">UOM</a></li>
                              <li><a href="<?php echo site_url('product'); ?>" key="t-crypto">Product</a></li>
                              <li><a href="<?php echo site_url('plant_master');?>" key="t-country">Plant Master</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo site_url('Quotation/view'); ?>" class="waves-effect">
                            <i class="bx bx-edit-alt"></i>
                            <span key="t-settings">Quotation</span>
                        </a>                        
                    </li>
                    <!-- <li>
                        <a  href="<?php echo site_url('Quotation/'); ?>" key="t-crypto">
                        <i class="bx bx-check">
                            <span key="t-settings">View Credit note</span></a></i></li> -->
                            <li>
                                
                        <a  href="<?php echo site_url('Quotation/'); ?>"  class="waves-effect">
                            <i class="bx bx-check"></i>
                            <span key="t-settings">View Credit note</span>
                        </a></li>

                    <li>
                        <a href="<?php echo site_url('SalesOrder/view'); ?>" class="waves-effect">
                            <i class="bx bx-check"></i>
                            <span key="t-settings">Sales Order</span>
                        </a>
                        
                    </li>
                    <li>
                                
                                <a  href="<?php echo site_url('SalesOrder/invoice_list'); ?>"  class="waves-effect">
                                    <i class="bx bx-check"></i>
                                    <span key="t-settings">Invoice List</span>
                                </a></li>

                   
                </ul>
            <?php  ?>
          
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
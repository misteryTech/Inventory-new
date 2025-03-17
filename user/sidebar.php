        <!-- partial:partials/_sidebar.html -->
             
     <?php
            $current_page  = basename($_SERVER['PHP_SELF']);
     ?>


        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item  <?= $current_page =='index.php' ? 'active' : ''?>">
              <a class="nav-link" href="index.php">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>


            <li class="nav-item  <?= $current_page =='profile-page.php' ? 'active' : ''?>">
              <a class="nav-link" href="profile-page.php">
                <i class="mdi mdi-account-outline menu-icon"></i>
                <span class="menu-title">Profile</span>
              </a>
            </li>




            <li class="nav-item nav-category">Inventory</li>
            <i class="mdi mdi-product  menu-icon"></i>
            
            <li class="nav-item">
              <a class="nav-link  <?= $current_page =='product-list.php' ? 'active' : ''?>" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon fa fa-box"></i>
                <span class="menu-title">Product</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">

                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="product-list.php">Product List</a></li>
                  <li class="nav-item"> <a class="nav-link" href="transaction.php">Transaction</a></li>
 
                </ul>
   

              </div>
            </li>


            


            <li class="nav-item  <?= $current_page =='logout.php' ? 'active' : ''?>">
              <a class="nav-link" href="logout.php">
                <i class="mdi mdi-power  menu-icon"></i>
                <span class="menu-title">Logout</span>
              </a>
            </li>




          </ul>
        </nav>
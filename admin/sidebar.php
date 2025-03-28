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


            <li class="nav-item  <?= $current_page =='release-item.php' ? 'active' : ''?>">
              <a class="nav-link" href="release-item-page.php">
                <i class="fa fa-building menu-icon"></i>
                <span class="menu-title">Department</span>
              </a>
            </li>

            <li class="nav-item <?= ($current_page == 'product-request.php' || $current_page == 'view-requestpage.php') ? 'active' : '' ?>">
    <a class="nav-link" href="product-request.php">
        <i class="fa fa-shopping-cart menu-icon"></i>
        <span class="menu-title">Product Requested</span>
    </a>
</li>


            
            <li class="nav-item  <?= $current_page =='approved-request.php' ? 'active' : ''?>">
              <a class="nav-link" href="approved-request.php">
                <i class="fa fa-check  menu-icon"></i>
                <span class="menu-title">Approved Request</span>
              </a>
            </li>



                    
            <li class="nav-item  <?= $current_page =='released-request.php' ? 'active' : ''?>">
              <a class="nav-link" href="release-request.php">
                <i class="fa fa-tasks  menu-icon"></i>
                <span class="menu-title">Release Request</span>
              </a>
            </li>



            <li class="nav-item">
              <a class="nav-link  <?= $current_page =='user-list.php' ? 'active' : ''?>" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="user-list.php"> User List </a></li>
                  <li class="nav-item"> <a class="nav-link" href="archive-list.php"> Archive User </a></li>
        
                </ul>
              </div>
            </li>





            <li class="nav-item nav-category">Inventory</li>
           
            <li class="nav-item">
              <a class="nav-link  <?= $current_page =='product-list.php' ? 'active' : ''?>" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon fa fa-box"></i>
                <span class="menu-title">Product</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">

                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="register-product.php">Add Product</a></li>
                  <li class="nav-item"> <a class="nav-link" href="product-list.php">Product List</a></li>
                  <li class="nav-item"> <a class="nav-link" href="archive-product.php">Archive Product</a></li>
                  <li class="nav-item"> <a class="nav-link" href="stock-list.php">Stock List</a></li>
                </ul>
   

              </div>
            </li>




            
            <li class="nav-item  <?= $current_page =='reports.php' ? 'active' : ''?>">
              <a class="nav-link" href="reports.php">
                <i class="fa fa-area-chart menu-icon"></i>
                <span class="menu-title">Reports</span>
              </a>
            </li>


          </ul>
        </nav>
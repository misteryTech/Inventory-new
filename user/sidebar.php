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




            <li class="nav-item nav-category">Inventory</li>
           
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon fa fa-dropbox"></i>
                <span class="menu-title">Product</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">

                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="list-product.php">List product</a></li>
                
                </ul>
   

              </div>
            </li>


          </ul>
        </nav>
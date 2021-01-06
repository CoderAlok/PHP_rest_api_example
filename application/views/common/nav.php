
    <div class="sidebar" data-color="purple" data-background-color="white">
      
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          Fresh
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          On the Go
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?=basename($_SERVER['PHP_SELF']) == 'dashboard'?'active':'';?>">
            <a class="nav-link" href="<?=site_url('dashboard')?>">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item <?=basename($_SERVER['PHP_SELF']) == 'catagories'?'active':'';?>">
            <a class="nav-link" href="<?=site_url('catagories')?>">
              <i class="material-icons">line_weight</i>
              <p>Catagories</p>
            </a>
          </li>

          <li class="nav-item <?=basename($_SERVER['PHP_SELF']) == 'products'?'active':'';?>">
            <a class="nav-link" href="<?=site_url('products')?>">
              <i class="material-icons">eco</i>
              <p>Products</p>
            </a>
          </li>

          <li class="nav-item <?=basename($_SERVER['PHP_SELF']) == 'stocks'?'active':'';?>">
            <a class="nav-link" href="<?=site_url('stocks')?>">
              <i class="material-icons">fact_check</i>
              <p>Stocks</p>
            </a>
          </li>
          </li>

          <li class="nav-item <?=basename($_SERVER['PHP_SELF']) == 'orders'?'active':'';?>">
            <a class="nav-link" href="<?=site_url('orders')?>">
              <i class="material-icons">receipt</i>
              <p>Orders</p>
            </a>
          </li>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <!-- ALOK HERE -->
    
<div class="sidebar" data-color="azure" data-background-color="white" data-image="../assets/images/pms-bg2.jpg">
  <div class="logo"><a href="#" class="simple-text logo-normal">
     <h3>TRIDENT3CHNOLOGY</h3> <h6>CODE EXAM</h6>
    </a></div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item <?=($access=='product-category')?"active":"";?>">
        <a class="nav-link" href="index.php?access=product-category">
          <i class="material-icons">dashboard</i>
          <p>Product Category</p>
        </a>
      </li>
      <li class="nav-item <?=($access=='products')?"active":"";?>">
        <a class="nav-link" href="index.php?access=products">
          <i class="material-icons">dashboard</i>
          <p>Products</p>
        </a>
      </li>
    </ul>
  </div>
</div>
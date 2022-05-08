

<?php 
  $user = $_SESSION['Username'];
  ?>



<!--NAVBAR design Start-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <a class="navbar-brand" href="dashboard.php"><?php echo lang('HOME')?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app-nav" aria-controls="app-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><?php echo lang('Categories')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><?php echo lang('Items')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="members.php?do=manage"><?php echo lang('Members')?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><?php echo lang('Logs')?></a>
        </li>
      </ul>
      <div class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $user?>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="members.php?do=edit&UserID=<?php echo $_SESSION['UserID']?>"><?php echo lang('Edit Profile')?></a></li>
                    <li><a class="dropdown-item" href="#"><?php echo lang('Setting')?></a></li>
                    <li><a class="dropdown-item" href="logout.php"><?php echo lang('Logout')?></a></li>
                  </ul>
    </div>
        
        
    </div>

    

  </div>
  
</nav>

<!--NAVBAR design End-->
<?php require_once('common.php');
requiresAuthentication();
$css = array("css/main.css", "fonts/feather/feather.min.css");
$js = array("js/mobile.js");
require_once("global_header.php");	
require_once("view_functions.php");
$pages = array(
"index.php" => "Home",
"manage.php;application.php;apply.php" => "Manage Applications",
"post_internship.php" => "Post Internship",
"search.php" => "Explore"
);
function getURL($url)
{
	if (strpos($url, ";") !== false)
	{
		return explode(";", $url)[0];
	}
	return $url;
}
?>
<nav class="navbar navbar-expand-lg navbar-light" id="topnav">
        <div class="container">

          <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <form class="form-inline mr-4 d-none d-lg-flex">
            <div class="input-group input-group-rounded input-group-merge" data-toggle="lists" data-lists-values="[&quot;name&quot;]">

              <input type="search" class="form-control form-control-prepended  dropdown-toggle search" data-toggle="dropdown" placeholder="Search" aria-label="Search" aria-expanded="false">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fe fe-search"></i>
                </div>
              </div>
			  
            </div>
          </form>

          <!-- User -->
          <div class="navbar-user">
      
            <!-- Dropdown -->
            <div class="dropdown mr-4 d-none d-lg-flex">
        
              <!-- Toggle -->
              <a href="#" class="text-muted" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="icon active">
                  <i class="fe fe-bell"></i>
                </span>
              </a>

              <!-- Menu -->
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col">
                
                      <!-- Title -->
                      <h5 class="card-header-title">
                        Notifications
                      </h5>

                    </div>
                    <div class="col-auto">
                
                      <!-- Link -->
                      <a href="#!" class="small">
                        View all
                      </a>

                    </div>
                  </div> <!-- / .row -->
                </div> <!-- / .card-header -->
                <div class="card-body">
				
				</div>
              </div> <!-- / .dropdown-menu -->

            </div>

            <!-- Dropdown -->
            <div class="dropdown">
        
              <!-- Toggle -->
              <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Logged in as <b><?php echo $_SESSION['user']['username']; ?></b>
              </a>

              <!-- Menu -->
              <div class="dropdown-menu dropdown-menu-right">
                <a href="profile.php" class="dropdown-item">Profile</a>
                <hr class="dropdown-divider">
                <a href="logout.php" class="dropdown-item">Logout</a>
              </div>

            </div>

          </div>

          <!-- Collapse -->
          <div class="collapse navbar-collapse mr-auto order-lg-first" id="navbar">

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none" action='search.php'>
              <input type="search" class="form-control form-control-rounded" placeholder="Search" aria-label="Search">
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav m	r-auto">
			
			<?php foreach($pages as $url => $page) { echo "<li class='nav-item".( basename($_SERVER["SCRIPT_FILENAME"]) == getURL($url)? " active" : "")."'><a class='nav-link".(basename($_SERVER["SCRIPT_FILENAME"]) == getURL($url)? " active" : "")."' href='".getURL($url)."'>".$page."</a></li>"; } ?>
          
            </ul>

          </div>

        </div> <!-- / .container -->
      </nav>
	  <div class="header">
        <div class="container">

          <!-- Body -->
          <div class="header-body">
            <div class="row align-items-end">
              <div class="col">
                
                  <?php echo isset($pre_title)? '<h6 class="header-pretitle">'.$pre_title.'</h6>' : ""; ?>

                 <?php echo isset($pre_title)? '<h1 class="header-title">'.$page_title.'</h1>' : ""; ?>
             
              </div>
              <div class="col-auto">
                
                <!-- Button -->
                <a href="#!" class="btn btn-primary">
                  Create Report
                </a>

              </div>
            </div> <!-- / .row -->
          </div> <!-- / .header-body -->

        </div>
      </div>
<div class="container">

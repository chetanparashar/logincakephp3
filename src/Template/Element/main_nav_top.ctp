<?php
$userdata=$this->request->session()->read('Auth.User');
//pr($userdata);
?>
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
           
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
           		 <i class="glyphicon glyphicon-user"></i>
            		<span> <i class="caret"></i></span>
       		 </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header"> 
                        <p>
                            <?= $userdata['partyname']?>
			   <small><?= $userdata['ph1']?></small>
			   <small><?= $userdata['emailid']?></small>
                            <small><?= $userdata['address']?></small>
                        </p>
                    </li>
                  
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href='<?= $this->request->webroot ?>users/login' class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
           
        </ul>
    </div>
</nav>

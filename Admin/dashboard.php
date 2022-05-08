<?php
    session_start();
    if (isset($_SESSION['Username'])){
            $titlePage = 'Dashboard';
            include('init.php');

        /* Dashboard Page Start */

        ?>

        <div class="dash-stat">

                <div class="container">
                        <h1>Dashboard</h1>
                        <div class="row">
                                <div class="col-md-3">
                                        <div class="stat stat-members">
                                                Total Members
                                                <span> <a href="members.php"> <?php echo countItem('UserID' , 'users') ;?> </a></span>

                                        </div>
                                        
                                </div>
                                <div class="col-md-3">
                                        <div class="stat stat-pending">
                                                Pending Members
                                                <span> <a href="members.php?do=manage&page=pending">  <?php echo checkItem("RegStatus",'users', 0 ) ;?> </a></span>
                                        </div>
                                       
                                </div>
                                <div class="col-md-3">
                                        <div class="stat stat-items">
                                                Total Items
                                                <span> <a href="members.php"> 1500 </a></span>
                                        </div>
                                        
                                </div>
                                <div class="col-md-3">
                                        <div class="stat stat-comments">
                                                Total Comments
                                                <span> <a href="members.php"> 3500 </a></span>

                                        </div>
                                        
                                </div>
                        </div>
                </div>

        </div>

        <div class="latest">
                <div class="container">
                        <div class="row">
                                <div class="col-sm-6">
                                        <div class="panel panel-default">
                                                <div class="panel-heading">
                                                        <i class="fa fa-users"></i>  Latest Registerd Users
                                                       

                                                </div>
                                                <div class="panel-body">
                                                        test

                                                </div>
                                        
                                        </div>
                                                
                                </div>

                                <div class="col-sm-6">
                                        <div class="panel panel-default">
                                                <div class="panel-heading">
                                                        <i class="fa fa-tag"></i>  Latest Items
                                                       

                                                </div>
                                                <div class="panel-body">
                                                        test

                                                </div>
                                        
                                        </div>
                                                
                                </div>
                               
                                
                        </div>
                </div>
        </div>





            


            




        <?php

        /* Dashboard Page end */  


            include( $tpl .'footer.php');

    }
    else{
            header('Location:index.php');
            exit();
    }

?>
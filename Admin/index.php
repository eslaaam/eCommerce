<?php   
        
        session_start();
        $noNavbar = '';
        $titlePage = 'Login';
        if (isset($_SESSION['Username'])){
                 header('Location: dashboard.php');

        }
        
        //include Important file

        include('init.php');
        


        // Form Validation Start

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $username = $_POST['user'];
                $password = $_POST['pass'];
                $hashedPass = sha1($password);

                //check if the user is exist in database

                $stmt = $con->prepare('SELECT
                                                UserID ,Username , Password
                                        FROM 
                                                users
                                        WHERE 
                                                Username = ? 
                                        AND 
                                                Password = ? 
                                        AND 
                                                GroupID =1 
                                        LIMIT 1
                                        ');
                $stmt -> execute(array($username,$hashedPass));
                $row = $stmt->fetch();
                $count = $stmt->rowCount();

                // if count >0 That main the database contain this record
                
                if($count >0){
                        $_SESSION['Username'] = $username;  //register Session Name
                        $_SESSION['UserID'] = $row['UserID']; // register session id
                        header('Location: dashboard.php');
                        exit();


                }

        
        }

        // Form Validation End


?>

<!--login form design start-->

<form class="login" action='<?php echo $_SERVER['PHP_SELF']?>' method='POST' >
        <h4 class ='text-center mt-3'>Admin Login </h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="Password" autocomplete="off">
        <input class="btn btn-primary w-100" type="submit" value="Login">
</form>

<!--login form design end-->


<?php include( $tpl .'footer.php');?>
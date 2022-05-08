

<?php


    /*
    *************************************************************
    === Members Page 
    === You can show | add | edit | delete Members From here 
    *************************************************************
    */



    session_start();
    $titlePage = 'Members';
    if (isset($_SESSION['Username'])){
            include('init.php');

            //check if the request equal value 
            if(isset($_GET['do'])){ $do = $_GET['do'];}
            else{ $do = 'manage';} 


                


            if($do == 'manage'){   //////////// manage Members page ////////////////

                $query = '';
                if(isset($_GET['page']) &&  $_GET['page'] == 'pending' ){

                    $query = 'AND RegStatus = 0';
                }
                


                $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
                $stmt->execute();

                $rows = $stmt->fetchAll();

                ?>
                 <section class="members">
                            <h1 class="text-center">Manage Members</h1>
                            <div class="container">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class='bg-dark text-white '>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Register Date</th>
                                        <th scope="col">Control</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php

                                        foreach($rows as $row){
                                            
                                            echo "<tr>";
                                            echo "<td>". $row['UserID'] ."</td>";
                                            echo "<td>". $row['Username'] ."</td>";
                                            echo "<td>". $row['Email'] ."</td>";
                                            echo "<td>". $row['FullName'] ."</td>";
                                            echo "<td>". $row['Date'] ."</td>";
                                            echo "<td>
                                                <a href='members.php?do=edit&UserID= ". $row["UserID"] ."' class = 'btn btn-primary' > <i class = 'fa fa-edit'></i> Edit</a>
                                                <a href='members.php?do=delete&UserID= ". $row["UserID"] ."' class = 'btn btn-danger confirm' > <i class = 'fa fa-close'></i> Delete</a>";
                                                echo " ";
                                                if($row["RegStatus"] == 0){

                                                    echo"<a href='members.php?do=activate&UserID= ". $row["UserID"] ."' class = 'btn btn-success text-white' > <i class='fa-regular fa-circle-check'></i> Activate</a>";

                                                }
                                            echo "</td>";
                                        echo "</tr>";
                                            
                                        }

                                        
                                        
                                        ?>
                                    </tbody>
                                </table>
                                <a href="members.php?do=add" class='btn btn-success'> <i class="fa-solid fa-plus"></i> Add New Member </a>
                            </div>  

                </section>

               

                
                


                
                
                <?php
              
            }



            elseif($do=='add'){    //////////// add Members Design ////////////////
                 
                 ?> 

                <section class="members">
                            <h1 class="text-center">Add Members</h1>
                            <div class="container">

                                <form class="row g-3" action = '?do=insert' method = 'POST'>
                                        <div class="col-md-6">
                                           
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control " name="username"  autocomplete="off" placeholder="Username must be more than 4 and less than 20 characters" required = "required">
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Password</label>
                                            <input type="password" class="password form-control" name="password" placeholder="password Must Be Complex" required = "required"  autocomplete="new-password" >
                                            <i class="show-pass fa fa-eye fa-2x"></i>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" autocomplete="off" required = "required">
                                        </div>
                                        <div class="col-12">
                                            <label  class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="fullname"  autocomplete="off" required = "required" >
                                        </div>
                                        
                                        
                                        <div class="col-12">
                                            <input type="submit" value="Add" class="btn btn-primary">
                                        </div>
                                        </form>

                            </div>

                        </section> <?php    
                    
            
            
            
            }

            elseif($do=='insert'){ //////////// insert Members Code ////////////////
                
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    echo "<div class = 'members'><h1 class='text-center'>Update Members</h1></div>";
                    echo "<div class = 'container'>";

                    
                    $user = $_POST['username'];
                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    $fullname = $_POST['fullname'];
                    $hashedpass = sha1($pass);

                    

                    // Validate The Form

                    $formErrors = array();

                    if(strlen($user) < 3 ){
                       
                        $formErrors[] =  'user must be more than <strong> 4 character </strong>';

                    }
                    if(strlen($user) > 20 ){

                        $formErrors[] = 'user must be less than <strong> 20 character </strong>';

                    }
                    if(empty($user)){
                        $formErrors[] = '<strong> User </strong>cant be empty';
                    }
                    if(empty($pass)){
                        $formErrors[] = '<strong> Password </strong>cant be empty';
                    }
                    if(empty($email)){
                        $formErrors[] = '<strong> Email </strong> cant be empty';
                    }
                    if(empty($fullname)){
                        $formErrors[] = '<strong> Full Name </strong> cant be empty';
                    }

                    foreach($formErrors as $error){

                        echo '<div class ="alert alert-danger text-center w-75 m-auto">' . $error . '</div>';

                    }


                    // insert new users if there is No Errors

                    if(empty($formErrors)){

                        $select = "Username";
                        $from = "users";
                        $value = $user;
                        $check = checkItem($select,$from,$value);
                        if($check === 1){

                            $erorrMsg = 'sorry this user is Repeated';
                            redirect($erorrMsg,1,'members.php');
                        }
                        else{

                            $stmt = $con->prepare("INSERT INTO 
                                                users(Username,Password,Email,FullName,RegStatus ,Date)
                                                VALUES (:zuser , :zpass , :zemail ,:zfullname, 1 ,now())");
                            $stmt->execute(array(
                                        
                                'zuser'     => $user,
                                'zpass'     => $hashedpass,
                                'zemail'    => $email,
                                'zfullname' => $fullname

                            ));                        

                            // Echo Succes Message

                            $infoMsg =  $stmt->rowCount() .' row is inserted'; 
                            redirectMembers($infoMsg,1);
                            
                        }

                        
                        

                    }


                    

                    

                }
                else{
                    $erorrMsg = 'sorry you are not trusted';
                    redirect($erorrMsg,2);
                }
                echo "</div>";
            }

            


            elseif($do=='edit'){    /////////// edit Members Design   ////////////////

                if(isset($_GET['UserID']) && is_numeric($_GET['UserID'])){
                    $UserID = $_GET['UserID'];
                    $stmt = $con->prepare('SELECT * FROM users WHERE UserID = ? LIMIT 1');
                    $stmt -> execute(array($UserID));
                    $row = $stmt->fetch();
                    $count = $stmt->rowCount();

                    // if count >0 That main the database contain this record
                    
                    if($count >0){ ?>

                        <section class="members">
                            <h1 class="text-center">Edit Members</h1>
                            <div class="container">

                                <form class="row g-3" action = '?do=update' method = 'POST'>
                                        <div class="col-md-6">
                                            <input type="hidden" name = 'UserID' value='<?php echo $row['UserID']?>'>
                                            <label class="form-label">Username</label>
                                            <input type="text" class="form-control " name="username" value='<?php echo $row['Username']?>' autocomplete="off" >
                                        </div>
                                        <div class="col-md-6">
                                            <label  class="form-label">Password</label>
                                            <input type="hidden"  name="oldpassword" value='<?php echo $row['Password']?>'">
                                            <input type="password" class="password form-control" name="newpassword" placeholder="To Reset Enter New Password"  autocomplete="new-password" >
                                            <i class="show-pass fa fa-eye fa-2x"></i>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" value='<?php echo $row['Email']?>' autocomplete="off" required = "required">
                                        </div>
                                        <div class="col-12">
                                            <label  class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="fullname" value='<?php echo $row['FullName']?>' autocomplete="off" required = "required" >
                                        </div>
                                        
                                        
                                        <div class="col-12">
                                            <input type="submit" value="save" class="btn btn-primary">
                                        </div>
                                        </form>

                            </div>

                        </section>
                    

                        
                        
                           
                    <?php

                    }
                    else{
                            echo 'Error ,the user Is Not Available';
                    }


                }
                else{
                    
                        $erorrMsg = 'Error ,the user Is Not Available';
                        redirect($erorrMsg,2);
                }

                ?>
                
                

                <?php
            }

            elseif($do=='update'){  //////////  update Members Code ///////////////

                //check if is it requestd method or not 

                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                    echo "<div class = 'members'><h1 class='text-center'>Update Members</h1></div>";
                    echo "<div class = 'container'>";

                    $id = $_POST['UserID'];
                    $user = $_POST['username'];
                    $email = $_POST['email'];
                    $fullname = $_POST['fullname'];

                    //password Trick

                    $pass = '';
                    if(empty( $_POST['newpassword'])){

                        $pass = $_POST['oldpassword'];

                    }
                    else{
                        $pass = sha1($_POST['newpassword']) ;
                        
                    }

                    // Validate The Form

                    $formErrors = array();

                    if(strlen($user) < 3 ){
                       
                        $formErrors[] =  'user must be more than <strong> 4 character </strong>';

                    }
                    if(strlen($user) > 20 ){

                        $formErrors[] = 'user must be less than <strong> 20 character </strong>';

                    }
                    if(empty($user)){
                        $formErrors[] = '<strong> User </strong>cant be empty';
                    }
                    if(empty($email)){
                        $formErrors[] = '<strong> Email </strong> cant be empty';
                    }
                    if(empty($fullname)){
                        $formErrors[] = '<strong> Full Name </strong> cant be empty';
                    }

                    foreach($formErrors as $error){

                        echo '<div class ="alert alert-danger text-center w-75 m-auto">' . $error . '</div>';

                    }


                    // Update users table with new data if there is No Errors

                    if(empty($formErrors)){

                        $stmt = $con->prepare("UPDATE users SET Username =?,Password =?,Email =?, FullName =? WHERE UserID=?");
                        $stmt->execute(array($user,$pass,$email,$fullname,$id));

                        // Echo Succes Message

                        
                        $infoMsg =  $stmt->rowCount() .' row is Updated'; 
                        redirectMembers($infoMsg,1);

                    }


                    

                    

                }
                else{
                    
                    $erorrMsg = 'sorry you are not trusted';
                    redirect($erorrMsg,1);
                }
                echo "</div>";

            }



            elseif($do=='delete'){   //////////  Delete Members Code ///////////////

                if(isset($_GET['UserID']) && is_numeric($_GET['UserID'])){
                    $UserID = $_GET['UserID'];

                    // check function
                    $select = $UserID;
                    $from = "users";
                    $value = $UserID;
                    $check = checkItem($select,$from,$value);

                    // if count >0 That main the database contain this record
                    
                    if($check >0){ 

                        echo "<div class = 'members'><h1 class='text-center'>Delete Members</h1></div>";
                        echo "<div class = 'container'>";
                        $stmt = $con->prepare("DELETE FROM users WHERE UserID = ?");
                        $stmt -> execute(array($UserID));
                        

                        // Echo Succes Message
                       
                        
                        $infoMsg =  $stmt->rowCount() .' row is Deleted'; 
                        redirectMembers($infoMsg,1);

                        echo "</div>";
                    }

                    

                    else{
                        
                        $erorrMsg = 'Error ,the user Is Not Available';
                        redirect($erorrMsg,1);
                    }


                }

                else{

                    $erorrMsg = 'sorry you are not trusted';
                    redirect($erorrMsg,1);
                }

               

            }

            
            elseif($do=='activate'){   //////////  Delete Members Code ///////////////

                if(isset($_GET['UserID']) && is_numeric($_GET['UserID'])){
                    $UserID = $_GET['UserID'];

                    // check function
                    $select = $UserID;
                    $from = "users";
                    $value = $UserID;
                    $check = checkItem($select,$from,$value);

                    // if count >0 That main the database contain this record
                    
                    if($check >0){ 

                        echo "<div class = 'members'><h1 class='text-center'>Activate Members</h1></div>";
                        echo "<div class = 'container'>";
                        $stmt = $con->prepare("UPDATE users SET RegStatus = 1  WHERE UserID = ?");
                        $stmt -> execute(array($UserID));
                        

                        // Echo Succes Message
                       
                        
                        $infoMsg =  $stmt->rowCount() .' row is Activated'; 
                        redirectMembers($infoMsg,1,'members.php?do=manage&page=pending');
                        

                        echo "</div>";
                    }

                    

                    else{
                        
                        $erorrMsg = 'Error ,the user Is Not Available';
                        redirect($erorrMsg,1);
                    }


                }

                else{

                    $erorrMsg = 'sorry you are not trusted';
                    redirect($erorrMsg,1);
                }

                

            }

                
                
                
               

            

           
            


             

            
            


            include( $tpl .'footer.php');
 
        
    }
            
            
    
    else{

        header('Location:index.php');
        exit();
    }

?>
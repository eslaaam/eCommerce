<?php


        /*
        ** title function 
        **
        */

        function getTitle(){
            global $titlePage;
            if(isset($titlePage)){

                echo $titlePage;

            }
            else{
                
                echo 'default';
            }

        }

        /*
        ** Redirect Home function 
        **
        */

        function redirect($errorMsg , $seconds = 2,$url = 'index.php' ){

            echo "</br>";
            echo "<div class='alert alert-danger w-75 m-auto text-center'> $errorMsg </div>";
            echo "</br>";
            echo "<div class='alert alert-info w-75 m-auto text-center'> you will be directed To $url after $seconds Seconds </div>";
            header("refresh:$seconds;url= $url");
            exit();


        }

        /*
        ** Redirect members function 
        **
        */

        function redirectMembers($infoMsg , $seconds = 2, $url = 'members.php'){

            echo "</br>";
            echo "<div class='alert alert-success w-75 m-auto text-center'> $infoMsg </div>";
            echo "</br>";
            echo "<div class='alert alert-info w-75 m-auto text-center'> you will be redirected To $url after $seconds Seconds </div>";
            header("refresh:$seconds;url= $url");
            exit();


        }



        
        /*
        ** Check User,Item,Category, and Cetra function 
        **
        */

        function checkItem($select,$from,$value){

            global $con;
            $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
            $statment->execute(array($value));
            $count = $statment->rowCount();
            return $count;
        }


        /*
        ** Count User,Item,Category, and Cetra function 
        **
        */

        function countItem($item , $from){

            global $con;
            $stmt2 = $con->prepare("SELECT count($item) FROM $from");
            $stmt2->execute();
            return $stmt2->fetchColumn();


        }

?>


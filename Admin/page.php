<?php

/* categories => [manage | edit | update | add | insert | delete | statistics]*/


$do = '';
if(isset($_GET['do'])){

    $do = $_GET['do'];
    
}
else{
    $do = 'manage';
}

if($do == 'manage'){
    echo'welcome to manage page';
    echo'<a href="page.php?do=add">   add an item</a>';

}
elseif($do == 'add'){
    echo'welcome to add page';
}
elseif($do == 'insert'){
    echo'welcome to insert page';
}
else{
    echo ' Error There \'s No page with this name ';
}


?>
<?php
 

    include('connect.php');

    // Routes

    $tpl = 'Includes/Templates/'; //template directory
    $lang = 'Includes/Languages/'; //language directory
    $func = 'Includes/Funcs/'; //language directory
    $css = 'Layout/css/';  // css directory
    $js = 'Layout/js/';   // js directory
    

    // Includes The Important Files 

    include( $func .'functions.php');
    //include( $lang .'Arabic.php');
    include( $lang .'English.php');
    include( $tpl .'header.php');
    

    //include navbar in all page except the selected one
    if(!isset($noNavbar)){include( $tpl .'navbar.php');}
    

    


?>
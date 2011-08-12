<?php

/**
 * Check for properly set content.
 *
 * We are first going to check the type and the type will be set using simple
 * single characters to tell us what we are loading. We can do this by pulling
 * the GET values from the URL. Options will be t->ulb for user long banner. or
 * type->usb for user short banner.
 * Type will be declared as t
 *
 * URL example:
 *      http://atmoicbucket.com/dreamincode/?t=usb&id=175017
 *
 * This will generate a short banner and will load the user information of
 * code: 175017.
 * 
 */




if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    require_once('class.UserBadge.php');
    
    $user = new UserBadge($_GET['id']);
    
    if($user->userLoaded)
    {
        //echo $user->__print();
        echo $user->display();
    }
    
}else{
    
    echo '<iframe scrolling="no" style="width: 284px;height: 78px;border: none;"src="http://atomicbucket.com/dreamincode/?id=34"></iframe>';
    
}



?>
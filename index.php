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

//local variables.
$size = "";

//check for the id.
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    //bring in the userbadge class
    require_once('class.UserBadge.php');
    
    //check to see if a size is set.
    if(isset($_GET['s']))
    {
        $size = $_GET['s'];
    }
    
    //create the new object and pass required var to it.
    $user = new UserBadge($_GET['id'], $size);
    
    //if loaded : display
    if($user->userLoaded)
    {
        //echo $user->__print();
        echo $user->display();
    }
    
}else{
    
    echo '<p>Looks like you are trying to access the dream in code widget improperly.
    Please read through the documentation on github.<a href="https://github.com/calebjonasson/Dream-In-Code-User-API/wiki">HERE!</a></p>';
    
    echo '<iframe scrolling="no" style="width: 284px;height: 78px;border: none;" src="http://atomicbucket.com/dreamincode/?id=175017"></iframe>';
}



?>
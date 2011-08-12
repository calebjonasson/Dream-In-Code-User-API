<?php

/**
 * This class is going to load the user information based on the values passed
 * into the constructor of the class.
 */

class UserBadge
{
    
    /* VARIABLES */
    
    //values
    public $userNid;
    public $name;
    public $posts;
    public $joined;
    public $views;
    public $postsPerDay;
    public $title;
    public $photo;
    public $reputation;
    public $group;
    
    
    
    //booleans
    public $userLoaded = false;
    
    //display values
    public $size;
    
    
    
    
    //construct
    public function __construct($user_nid, $size = '')
    {
        //set the user nid.
        $this->userNid = $user_nid;
        
        //unset the user_nid
        unset($user_nid);
        
        //set the url
        $url = 'http://www.dreamincode.net/forums/xml.php?showuser='.$this->userNid;
        
        //get the contents of the xml
        if(!$xml = file_get_contents($url))
        {
            die('unable to load xml : '.__LINE__);
        }
        
        //create the xml object to work with.
        if(@!$xml = new SimpleXMLElement($xml))
        {
            die('unable to create xml object : '.__LINE__);
        }
        
        //If we have gotten this far we know that we do have an xml file loaded.
        $this->userLoaded = true;
        
        //load user values.
        $this->posts = (string)$xml->profile[0]->posts;
        $this->photo = (string)$xml->profile[0]->photo;
        $this->name = (string)$xml->profile[0]->name;
        $this->joined = (string)$xml->profile[0]->joined;
        $this->views = (string)$xml->profile[0]->views;
        $this->postsPerDay = (string)$xml->profile[0]->postsperday;
        $this->title = (string)$xml->profile[0]->title;
        $this->reputation = (string)$xml->profile[0]->reputation;
        $this->group = (string)$xml->profile[0]->group[0]->span;
        
        //remove the xml variable.
        unset($xml);
        
        //TODO
        $this->size = 'usb';
    }
    
    
    //function
    public function checkSize()
    {
        /**
         * This function is going to check the size that is passed set the value
         * of the size accordingly.
         */
    }
    public function __print()
    {
        /**
         * Print the object and all of it's contents.
         */
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }
    
    public function display()
    {
        //Check the type of display and return proper values.
        if($this->size = 'usb')
        {
            //user small banner
            return '
            <html>
            <head>
                <link href="http://atomicbucket.com/dreamincode/usb.css" rel="stylesheet" type="text/css" />
            </head>
            <body>
            <a href="http://www.dreamincode.net/forums/user/'.$this->userNid.'-'.$this->name.'/" target="_parent">
                <div class="cwj_container">
                    <div class="cwj_top">
                        <div class="cwj_photo left">
                            <img src="http://www.dreamincode.net/forums/uploads/av-'.$this->userNid.'.jpg">
                        </div>
                        <div class="cwj_top_right left">
                            
                            <div class="cwj_name left">'.$this->name.'</div>
                            <div class="cwj_img right">
                                '.$var = ($this->loadGroupImage() != '' ? '<img src="'.$this->loadGroupImage().'">' : '').'
                            </div>
                            <div class="clear"></div>
                            <div class="cwj_title">
                                '.$this->title.'
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="cwj_bottom">
                        <div class="cwj_rep cwj_pos_rep left">
                            <p>Reputation: '.$this->reputation.'</p>
                        </div>
                        <div class="cwj_rep cwj_posts right">
                            <p>Posts: '.$this->posts.'</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </a>
            </body>
            </html>';
            
        }
    }
    private function loadGroupImage()
    {
        
        //load the images with a case statement.
        switch($this->group)
        {
            case 'Expert w/DIC++':
                return 'http://cdn2.dreamincode.net/dreamincode/forums/public/style_extra/group_icons/expert_group.gif.pagespeed.ce.FoAO90i5Rq.gif';
                break;
            case 'Expert' :
                return 'http://cdn2.dreamincode.net/dreamincode/forums/public/style_extra/group_icons/expert_group.gif.pagespeed.ce.FoAO90i5Rq.gif';
                break;
            case 'Author' :
                return 'http://cdn2.dreamincode.net/dreamincode/forums/public/style_extra/group_icons/author_group.gif.pagespeed.ce.mwMUIrHI0a.gif';
                break;
            case 'Author w/DIC++' :
                return 'http://cdn2.dreamincode.net/dreamincode/forums/public/style_extra/group_icons/author_group.gif.pagespeed.ce.mwMUIrHI0a.gif';
                break;
            case 'Contributors';
                return 'http://cdn2.dreamincode.net/dreamincode/forums/public/style_extra/group_icons/contributor_group.gif.pagespeed.ce.Qg1-UpavDq.gif';
                break;
            default :
            return "";
                break;
        }
        
    }
}

?>
<?php
/*========================
#  
#  REPLACE THIS WITH YOUR
#  ID AND FOLDER NAME
#
#========================*/

namespace Noidexe\Autogal;

class Config 
    {
    //Your name
    const username = 'Lisandro Lorea';
    //Your Dropbox user id, ie. what follows https://dl.dropbox.com/u/
    const userid = '1165389';
    //The name of your autofolio folder inside Dropbox/public/
    const folder_name = 'Portfolio';
    const max_retries = 20;

    //DO NOT EDIT UNLESS YOU KNOW WHAT YOU'RE DOING
    static function getDirURL(){
	//return "http://localhost/~noid/autogal/dir.txt";
    	return 'https://dl.dropboxusercontent.com/u/' . self::userid . '/' . self::folder_name . '/dir.txt';
    }
}

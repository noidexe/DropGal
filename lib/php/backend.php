<?php
namespace Noidexe\Autogal;

require_once('../../config.php');
require_once('Database.php');
require_once('HTMLGenerator.php');


//Get the dir.txt file from dropbox
//and compare its hash with the one 
//in autogal.lastmod to see if the
//gallery cache needs to be rebuilt 
$dirhash = md5(file_get_contents(Config::getDirURL() ));

//If dir.txt hasn't changed do nothing...
if ( file_exists('../../autogal.lastmod') && $dirhash == file_get_contents('../../autogal.lastmod') ) {
	;
}

//..otherwise rebuild the gallery cache
else
{
    	$retries = 0;
	//if autogal.lock there probably
	//another instance of the script
	//running. Give it some seconds
	//to finish
	while (file_exists('../../autogal.lock') && $retries < Config::max_retries) {
	    //echo 'sleeping';
    	sleep(1);
    	$retries++;
	}

	//create a lock file so two
	//instances of the script don't 
	//try to rebuild the galleries at
	//the same time
	$filelock = fopen('../../autogal.lock', 'w');
	
	$myDatabase = new Database();
	$myGenerator = new HTMLGenerator();
	$myDatabase->generateFromFile(Config::getDirURL());
	$myGenerator->generatePages( $myDatabase->getCategories(), $myDatabase->getCollection() );
	//Open autogal.lastmod and write the new hash of dir.txt
	$lastmod = fopen('../../autogal.lastmod', 'w');
	fwrite($lastmod, $dirhash);
	fclose($lastmod);
	fclose($filelock);
}

//Remove the lock
unlink('../../autogal.lock');

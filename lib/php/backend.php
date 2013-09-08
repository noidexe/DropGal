<?php
namespace Noidexe\Autogal;

require_once('../../config.php');
require_once('Database.php');
require_once('HTMLGenerator.php');


//$file = file_get_contents("https://dl.dropbox.com/u/1165389/Portfolio/dir.txt") or exit("Unable to open file!");
//echo $file;


$retries = 0;
while (file_exists('../../autogal.lock') && $retries < Config::max_retries) {
    echo 'sleeping';
    sleep(1);
    $retries++;
}

$filelock = fopen('../../autogal.lock', 'w');
$dirhash = md5(file_get_contents(Config::getDirURL() ));

if ( file_exists('../../autogal.lastmod') && $dirhash == file_get_contents('../../autogal.lastmod') ) {
	;
}
else
{
	$myDatabase = new Database();
	$myGenerator = new HTMLGenerator();
	$myDatabase->generateFromFile(Config::getDirURL());
	$myGenerator->generatePages( $myDatabase->getCategories(), $myDatabase->getCollection() );
	$lastmod = fopen('../../autogal.lastmod', 'w');
	fwrite($lastmod, $dirhash);
	fclose($lastmod);
}
fclose($filelock);
while (unlink('../../autogal.lock') === false) { ; }

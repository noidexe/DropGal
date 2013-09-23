<?php
namespace Noidexe\Autogal;

class Database
 {
 	private $categories = array();
 	private $collection = array();

 	public function getCategories() {
 		return $this->categories;
 	}

 	public function getCollection() {
 		return $this->collection;
 	}

 	public function addCategory($newcat) {
 		array_push($this->categories, $newcat);
 	}

 	public function addItemToCollection($newitem) {
 		array_push($this->collection, $newitem);
 	}
	

	//--------------------------
	//parses a text file with a list
	//of paths to the images. Replaces local
	//paths with dropbox urls.
	//--------------------------
 	public function generateFromFile($file) {
    try {
        $dirfile = fopen($file, 'r' );
    }
    catch (Exception $e)
    {
        throw new Exception( "Can't get $file");
    }
		$cur_file = '';
		$cur_pair = '';
		$item = array('category' => '', 'name' => '', 'url' => '');
					

		while (!feof($dirfile)) {
			$cur_file = fgets($dirfile);
			//get next line
			$cur_file = str_replace("\\", "/", $cur_file);
			//replace windows '\' with unix '/'
			$cur_file = str_replace(" ", "%20", $cur_file);
			//and spaces with the correspondent htmlentity
			$cur_file = preg_replace("/[^[:alnum:][:punct:]]/", "", $cur_file);
			//remove windows CRLF
			$cur_file = strstr($cur_file, Config::folder_name . '/');
			//drop everything in the path before $folder_name
			$cur_file = str_replace(Config::folder_name . '/', '', $cur_file);
			//drop the folder name
			$cur_pair = explode('/', $cur_file);
			if (count($cur_pair) > 2) 
				;
			elseif (count($cur_pair) == 1) {
				$item['category'] = 'Home';
				$item['name'] = $cur_pair[0];
				
				

			} else {
				$item['category'] = str_replace("%20", "_", $cur_pair[0]);
				$item['name'] = $cur_pair[1];
			}
			
			$item['url'] = $cur_file;
			if (!in_array($item['category'], $this->getCategories() )) $this->addCategory($item['category']);
			$this->addItemToCollection($item);
		}
		fclose($dirfile);
 	}
 	
 }

 

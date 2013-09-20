<?php
namespace Noidexe\Autogal;

require_once('../../config.php');

class HTMLGenerator {
	public function generatePages ($categories, $collection) {
		
		//Generate html for the category selector.
		$this->category_menu ($categories);

		//Generate html for each gallery.
		foreach ($categories as $cat) {
			$this->new_category($cat, $collection);
		}
	}
	
	private function new_category ($cat_name, $col) {
		//Create a new [Category_Name].html file
		$page = fopen("../../cache/" . $cat_name . ".html" , 'w');
		//For each item in the collection
		//if the category matches $car_name
		//insert it in the page with an <img> tag
		foreach ($col as $item) {   
		 	if ($item["category"] == $cat_name) {
		 		fwrite($page, "<img class='gal_item' alt='${item['name']}' src='https://dl.dropboxusercontent.com/u/" . Config::userid . '/' . Config::folder_name . '/' . $item['url'] . "'/>\n");
		 	}
		 }

		

		fclose($page);
	}

	private function category_menu ($categories) {
		$page = fopen("../../cache/category_menu.html", w);
			//For each category create a menu entry
			//using <li> tags.
			foreach ($categories as $cat) {
				fwrite($page, "<li class='menu_item black'><a href='#" . $cat .  "'>". $cat . "</a></li>\n");
			}
		fclose($page);			
	}
}

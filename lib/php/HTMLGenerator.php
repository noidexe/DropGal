<?php
namespace Noidexe\Autogal;

require_once('../../config.php');

class HTMLGenerator {
	public function generatePages ($categories, $collection) {
		$page = fopen("../../cache/page.html", 'w');
		$json_categories = json_encode($categories);
		$json_collection = json_encode($collection);
		fwrite($page, "<h1>Test</h1>" . $json_categories . $json_collection);
		fclose($page);
		foreach ($categories as $cat) {
			$this->new_category($cat, $collection);
		}
	}
	private function new_category ($cat_name, $col) {
		echo $cat_name;
		$page = fopen("../../cache/" . $cat_name . ".html" , 'w');
		fwrite($page, "<div class='category'>\n");
		 foreach ($col as $item) {
		 	if ($item["category"] == $cat_name) {
		 		fwrite($page, "<img class='gal_item' alt='${item['name']}' src='https://dl.dropboxusercontent.com/u/" . Config::userid . '/' . Config::folder_name . '/' . $item['url'] . "'/>\n");
		 	}
		 }

		fwrite($page, "</div> <!-- category -->\n");

		fclose($page);
	}
	private function write_gal_content_($cat_name) {
        

	}
}
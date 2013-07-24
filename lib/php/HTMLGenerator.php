<?php
namespace Noidexe\Autogal;

class HTMLGenerator {
	public function generatePages ($categories, $collection) {
		$page = fopen("../../cache/page.html", 'w');
		fwrite($page, "<h1>Test</h1><h2>" . json_encode($categories) . "</h2><p>" . json_encode($collection) . "</p>");
		fclose($page);
	}
}
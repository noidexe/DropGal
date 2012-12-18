<!DOCTYPE html>
<?php
			require_once("config.php");

			$file = fopen("https://dl.dropbox.com/u/$userid/$folder_name/dir.txt", "r") or exit("Unable to open file!");
			//$file = fopen("dir.txt", "r") or exit("Unable to open file!");
			//Open directory listing generated with batch script
			$cur_file = '';
			//Read each line of the directory listing
			$json_list = '';
			$cur_pair = '';

			$categories = array();
			$collection = array();
			$item = array('category' => '', 'name' => '', 'url' => '');
			

			while (!feof($file)) {
				$cur_file = fgets($file);
				//get next line
				$cur_file = str_replace("\\", "/", $cur_file);
				//replace windows '\' with unix '/'
				$cur_file = str_replace(" ", "%20", $cur_file);
				//and spaces with the correspondent htmlentity
				$cur_file = preg_replace("/[^[:alnum:][:punct:]]/", "", $cur_file);
				//remove windows CRLF
				$cur_file = strstr($cur_file, $folder_name . '/');
				//drop everything in the path before $folder_name
				$cur_file = str_replace($folder_name . '/', '', $cur_file);
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
				if (!in_array($item['category'], $categories)) $categories[] = $item['category'];
				$collection[] = $item;

				//echo "<img src='https://dl.dropbox.com/u/$userid/" . $cur_file . "' style='height: 200px; padding: 5px' onMouseOver=\"this.style.cssText='height: 500px'\" onMouseOut=\"this.style.cssText='height: 200px'\" />&nbsp;";
			}
			//echo json_encode($categories);
			fclose($file);
			?>

<html>
	<head>
		<title>Autofolio</title>
		<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<!--<script src="jquery.js"></script>-->
		<script type="text/javascript">
		 $(document).ready(function(){
		 	<?php
		 	
		 	foreach ($categories as $cat) {
		 		echo "\$('.".$cat."').hide();\n";
		 	}
		 	
		 	echo "\$('.".$categories[0]."').show();\n";
		 	?>	
		});
		
		function showCategory() {

			<?php
		 	foreach ($categories as $cat) {
		 		echo "\$('.".$cat."').hide();\n";
		 	}
		 	?>	

		 	<?php
		 	foreach ($categories as $cat) {
		 		echo "if(document.getElementById('".$cat."').checked) {\$('.".$cat."').show(); }\n";
		 	}

		 	?>	

		}

	</script>
	<style type="text/css">
	body { color: #e2a540; }
	</style>
	</head>
	<body style="background: #222222">
		<h1 style="color: #e2a540; border-bottom: solid 1px #e2a540"><?= $yourname ?>
		- Portfolio</h1>
		<form action="">

		<?php
		 foreach ($categories as $i) {
			
			if ($i == 'Home') {
				echo "<input type='radio' name='categoria' id='$i' onChange='showCategory();' value='$i' checked='checked' />$i</input>";
			}
			else echo "<input type='radio' name='categoria' id='$i' onChange='showCategory();' value='$i' />$i</input>";
		}

		?>
		
		</form>
		<div>
			
			<?php
			foreach ($collection as $item) {
				echo "<img src='https://dl.dropbox.com/u/$userid/$folder_name/" . $item['url'] . "' style='height: 200px; padding: 5px' class='" . $item['category'] . "' />&nbsp;";				
			}
			

			?>
		</div>
	</body>
	
</html>
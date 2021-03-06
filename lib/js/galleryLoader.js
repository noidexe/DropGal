      $( document ).ready(function() {

		// Bind the event.
        $(window).hashchange( function(){
        // Load the appropiate gallery section whenever the hash changes
        $("#dg_gallery").load('cache/' + location.hash.substring(1, location.hash.length) + '.html');
        })

	//If there is no hash in the URL set it to "Home", the main section
        if (location.hash == "") {
        	location.hash =  "#Home";
        }
	
	//Manually triger hashchange() when the page first loads.
        $(window).hashchange();
	
	//Load the gallery navigation menu.
		$("#dg_menu").load('cache/category_menu.html');

	//Zoom and Tile View button behavior
        $("#dg_dropgal").on("click", ".zoom", function(e) { 
			$('.gal_item').css({
				"height":"inherit",
				"max-height": "inherit",
				"width":"100%"
			});
		});

		$("#dg_dropgal").on("click", ".tiles", function(e) {
			$('.gal_item').css({
				"max-height": "250px",
				"max-width": "100%",
				"height":"inherit",
				"width": "inherit"
			});
		});
		
      });	

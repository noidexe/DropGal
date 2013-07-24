/// <reference path="jquery.d.ts" />

module Autogal {
    export class Frontend {
        constructor(){
            // Using the core $.ajax method
            $.ajax({
                // the URL for the request
                url: "lib/php/backend.php",
             
                // the data to send (will be converted to a query string)
                //data: {
                  //  id: 123
                //},
             
                // whether this is a POST or GET request
                type: "GET",
             
                // the type of data we expect back
                dataType : "text",
             
                // code to run if the request succeeds;
                // the response is passed to the function
                success: function( text ) {
                    $( "body" ).text(text);
                },
             
                // code to run if the request fails; the raw request and
                // status codes are passed to the function
                error: function( xhr, status ) {
                    alert( "Sorry, there was a problem!" );
                },
             
                // code to run regardless of success or failure
                complete: function( xhr, status ) {
                    alert( "The request is complete!" );
                }
            });
        }
    }   
}
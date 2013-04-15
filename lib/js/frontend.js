var Autogal;
(function (Autogal) {
    var Frontend = (function () {
        function Frontend() {
            $.ajax({
                url: "lib/php/backend.php",
                type: "GET",
                dataType: "text",
                success: function (text) {
                    $("body").text(text);
                },
                error: function (xhr, status) {
                    alert("Sorry, there was a problem!");
                },
                /*complete: function (xhr, status) {
                    alert("The request is complete!");
                }*/
            });
        }
        return Frontend;
    })();
    Autogal.Frontend = Frontend;    
})(Autogal || (Autogal = {}));

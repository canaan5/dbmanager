$(document).ready(function() {

	$("#dbs a").click( function(e) {
		e.preventDefault();

		var db = $(this).attr("href").split('db=')[1];

		// Set the database name as the header
        $("#page .tableHolder").html("");
		$("#page h1.page-header").html("");
		$("#page h1.page-header").html($(this).attr("href").split('db=')[1]);

		$.ajax({
			url: $(this).attr("href"),
			type: "GET",
            cache: false,
            dataType: "html",
			success: function(result) {
                $("#page .tableHolder").html(result);
			},
            async: false
		});

	});
});

function viewTable(url) {

    // Set the database name as the header
    $("#page .tableHolder").html("");
    //$("#page h1.page-header").html("");
    //$("#page h1.page-header").html($(this).attr("href").split('db=')[1]);

    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        dataType: "html",
        success: function(result) {
            $("#page .tableHolder").html(result);
        },
        async: false
    });
}
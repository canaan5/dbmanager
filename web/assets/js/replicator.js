$(document).ready(function(e) {
	$("#sb1").on("click", function() {
		getdatabases("first");
	})

	$("#sb2").on("click", function() {
		getdatabases("second");
	})

	$("#doitnow").on("click", function() {

		$("#tablez1").html("");
		$("#tablez2").html("");

		var host1 = $("#host1").val();
		var username1 = $("#user1").val();
		var password1 = $("#pass1").val();
		var dbs1 = $("#dbs1").val();
		var url = "/replicator/getTables?db=" + dbs1 + "&username=" + username1 + "&password=" + password1 + "&host=" + host1
		$.ajax({
			url: url,
			dataType: 'jsonp',
			jsonpCallback: 'text',
			jsonp: 'callback',
			success: function(data, status) {
				console.log(data)
				$.each(data, function(index, value) {
					$("#tablez1").append("<tr><td>" + value + "</td><td id='first" + value + "' style='text-align:right'>Loading</td></tr>");
					new vali.gettablesize1(value);
				})

				// Load Tables for the second database
				var host2 = $("#host2").val();
				var username2 = $("#user2").val();
				var password2 = $("#pass2").val();
				var dbs2 = $("#dbs2").val();
				var url2 = "/replicator/getTables?db=" + dbs2 + "&username=" + username2 + "&password=" + password2 + "&host=" + host2
				$.ajax({
					url: url2,
					dataType: 'jsonp',
					jsonpCallback: 'text',
					jsonp: 'callback',
					success: function(data, status) {
						console.log(data)
						$.each(data, function(index, value) {
							$("#tablez2").append("<tr><td>" + value + "</td><td id='second" + value + "' style='text-align:right'>Loading</td></tr>");
							new vali.gettablesize2(value);
						})
					},
					error: function(err) {
						console.log("error happend herre")
						console.log(err);
					}
				});
			},
			error: function(err) {
				console.log("the first table didnt load")
				console.log(err);
			}
		});

	});


// Compare Tables

	$("#compare").click(function() {
		$("#tablez1").html("");
		
		var host1 = $("#host1").val();
		var u1 = $("#user1").val();
		var p1 = $("#pass1").val();
		var dbs1 = $("#dbs1").val();

		var host2 = $("#host2").val();
		var u2 = $("#user2").val();
		var p2 = $("#pass2").val();
		var dbs2 = $("#dbs2").val();

		var dsn1 = "mysql:host=" + host1 + ";dbname=" + dbs1;
		var dsn2 = "mysql:host=" + host2 + ";dbname=" + dbs2;

		$.ajax({
			url: "/replicator/compareTables",
			dataType: 'jsonp',
			jsonpCallback: 'text',
			jsonp: 'callback',
			data: {
				"dsn1": dsn1,
				"dsn2": dsn2,
				"u1": u1,
				"u2": u2,
				"p1": p1,
				"p2": p2,
			},
			type: "POST",
			success: function(data) {
				console.log(data)
				$.each(data, function(index, value) {
					$("#tablez1").append("<tr><td>" + value + "</td><td id='first" + value + "' style='text-align:right'>Loading</td></tr>");
					// new vali.gettablesize1(value);
				})
			},
			error: function(err) {
				console.log(err);
			}
		});
	})

});

function getdatabases(hostname) {
	try {
		var varretun;
		var username;
		var password;
		if (hostname === "first") {

			hostname = $("#host1").val();
			varretun = $("#dbs1");
			username = $("#user1").val();
			password = $("#pass1").val();

		} else if (hostname === "second") {

			hostname = $("#host2").val();
			varretun = $("#dbs2");
			username = $("#user2").val();
			password = $("#pass2").val();

		}

		$.ajax({
			url: "/replicator/getDatabase",
			data: {
				"hostname": hostname,
				"username": username,
				"password": password
			},
			type: "POST",
			success: function(data) {
				console.log(data)
				varretun.html(data);
			},
			error: function(err) {
				console.log(err);
			}
		});
	} catch (e) {
		alert(e)
	}
}


var vali = {
	gettablesize1: function(id) {
		var host = $("#host1").val();
		var username = $("#user1").val();
		var password = $("#pass1").val();
		var dbname = $("#dbs1").val();
		$.ajax({
			url: "/replicator/getRowCount",
			data: {
				"getdatasize": id,
				"username": username,
				"password": password,
				"host": host,
				"dbname": dbname
			},
			type: "POST",
			success: function(data) {
				console.log(data)
				$("#first" + id).html(data);
			},
			error: function(err) {
				console.log(err);
				$("#first" + id).html("error");
			}

		})
	},
	gettablesize2: function(id) {
		var host = $("#host2").val();
		var username = $("#user2").val();
		var password = $("#pass2").val();
		var dbname = $("#dbs2").val();
		$.ajax({
			url: "/replicator/getRowCount",
			data: {
				"getdatasize": id,
				"username": username,
				"password": password,
				"host": host,
				"dbname": dbname
			},
			type: "POST",
			success: function(data) {
				console.log(data)
				$("#second" + id).html(data);
			},
			error: function(err) {
				console.log(err);
				$("#second" + id).html("error");
			}

		})
	}
}



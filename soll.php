<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Replicator</title>
<style type="text/css">
body{
	padding:0;
	margin:0;
}
.container{
	width:700px;
	height:490px;
	position:absolute;
	margin:auto;
	top:-110px;
	left:0;
	right:0;
	bottom:0;
	overflow:hidden;
}
.randomimage{
position:relative;
	width:615px;
	height:283px;
	display:block;
	margin:0 auto;
	border:1px solid #eeeeee;
	background-size:100% 100%;
	background-repeat:no-repeat;
	background-position:center center;
}
#dfile{
	position:absolute;
	visibility:hidden;
	width:1px;
}
#description{
padding:10px 3px;
font-size:22px;
width:610px;
text-transform:capitalize;
margin:0 auto;
display:block;
margin-top:4px;
}
#uploadbtn{
display:block;
padding:5px 12px;
margin:0 auto;
margin-top:8px;
font-size:18px;
}
#image-caption{
	position:absolute;
	margin:auto;
	top:auto;
	bottom:0;
	width:100%;
	  font-weight: 200;
    font-size: 18px;
    width:100%;
    background:rgba(153,153,153,.50);
    margin:0 auto;
    /*width: 400px;*/
    text-align: center;
    padding-top: 15px;
    padding-bottom: 15px;
    color:#ffffff;
text-transform:capitalize;
    text-shadow:0px 1px 1px #222222;
}
#randomimage:hover #image-caption{
    background:rgba(153,153,153,.90) !important;
}
#randomimage:hover .infobox{
	top:0px;
}
.infobox{
	width:100%;
	padding:5px 0px;
	text-align:center;
	background:#069;
	color:#FFFFFF;
	margin:0 auto;
	position:absolute;
	margin:auto;
	left:0;
	right:0;
	top:-50px;
	transition:1s top;
	-webkit-transition:1s top;
	-moz-transition:1s top;
	-o-transition:1s top;
	-ms-transition:1s top;

}
.footerinstruction p{
	text-transform:capitalize;
	background:white;
	padding:8px 4px;
	width:60%;
	margin:0 auto;
	margin-top:12px;
	text-align:center;
}
.footerinstruction p span{
	color:rgba(255,0,0,1);
	font-weight:bolder;

}
#testimg{
	position:absolute;
visibility:hidden;
}
#jre{

width:700px;
margin:0 auto;
}
.zoe{
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
}
</style>
</head>

<body >
<div class="dbinfo1" id="jre">
<table align="center"><tr><td style="border:1px solid #eeeeee;background:#9F9"><table class="zoe"><caption>Master Database</caption>
<tr><td>Host:</td><td><input type="text" id="host1" placeholder="Host IP"/></td></tr>
<tr><td>Username:</td><td><input type="text" id="user1" placeholder="Username"/></td></tr>
<tr><td>Password:</td><td><input type="password" id="pass1" placeholder="Password"/></td></tr>
<tr><td>SelectDB:</td><td><select id="dbs1">
<option selected value="">SelectDB:</option>
</select><input type="button" id="sb1" value="GetDB's"/></td></tr>
</table>
</td><td style="border:1px solid #eeeeee;background:#F9F">
<table><caption>Slave Database</caption>
<tr><td>Host:</td><td><input type="text" id="host2" placeholder="Host IP"/></td></tr>
<tr><td>Username:</td><td><input type="text" id="user2" placeholder="Username"/></td></tr>
<tr><td>Password:</td><td><input type="password" id="pass2" placeholder="Password"/></td></tr>
<tr><td>SelectDB:</td><td><select id="dbs2">
<option selected value="">SelectDB:</option>
</select><input type="button" id="sb2" value="GetDB's"/></td></tr>
</table></td><td><input type="button" value="Load Tables" id="doitnow"/>
<input type="button" value="Compare Tables" id="doitnow"/>
<input type="button" value="Update Slave" id="doitnow"/>
</td></tr>


<tr style="vertical-align:top"><td><table border="" width="100%"><thead><tr><th>Name</th><th>Size</th></tr></thead>
<tbody id="tablez1"></tbody>
</table></td>

<td><table border="" width="100%"><thead><tr><th>Name</th><th>Size</th></tr></thead>
<tbody id="tablez2"></tbody>
</table></td>

</tr>
</table>

</div>
<div class="dbinfo2"></div>
</body>
</html>
<script type="text/javascript" src="/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="/jquery.pin.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#sb1").on("click",function(){
		getdatabases("first");
	})

	$("#sb2").on("click",function(){
		getdatabases("second");
	})

    $("#doitnow").on("click",function(){
	 var host1=$("#host1").val();
	 var username1=$("#user1").val();
	var password1=$("#pass1").val();
	 var dbs1=$("#dbs1").val();
	var url="/getdata.php?gettables="+dbs1+"&username="+username1+"&password="+password1+"&host="+host1
	 $.ajax({
        url: url,
        dataType: 'jsonp',
        jsonpCallback: 'text',
        jsonp: 'callback',
		success: function(data,status){
			console.log(data)
			$.each(data,function(index,value){
				$("#tablez1").append("<tr><td>"+value+"</td><td id='first"+value+"' style='text-align:right'>Loading</td></tr>");
				new vali.gettablesize1(value);
				})

				var host2=$("#host2").val();
	 var username2=$("#user2").val();
	var password2=$("#pass2").val();
	 var dbs2=$("#dbs2").val();
	var url2="/getdata.php?gettables="+dbs2+"&username="+username2+"&password="+password2+"&host="+host2
	 $.ajax({
        url: url2,
        dataType: 'jsonp',
        jsonpCallback: 'text',
        jsonp: 'callback',
		success: function(data,status){
			console.log(data)
			$.each(data,function(index,value){
				$("#tablez2").append("<tr><td>"+value+"</td><td id='second"+value+"' style='text-align:right'>Loading</td></tr>");
				new vali.gettablesize2(value);
				})



			},error: function(err){
				console.log("error happend herre")
				console.log(err);
				}
    });



			},error: function(err){
				console.log("the first table didnt load")
				console.log(err);
				}
    });



	 });



});
  function getdatabases(hostname){
	  try{
	  var varretun;
	   var username;
	var password;
		 if(hostname === "first"){

			hostname = $("#host1").val();
			varretun = $("#dbs1");
			username = $("#user1").val();
			password = $("#pass1").val();

		 } else if(hostname === "second"){

			hostname = $("#host2").val();
			varretun = $("#dbs2");
			username = $("#user2").val();
			password = $("#pass2").val();

		 }

	 	$.ajax({
		 url:"/getdata.php",
		 data:{"hostname":hostname,"username":username,"password":password},
		 type:"POST",
		 success:function(data){
			console.log(data)
			varretun.html(data);
			 },error: function(err){
			 	console.log(err);
			 }
		});
	}catch(e){alert(e)}
}


		  var vali={
		 gettablesize1:function(id){
			  var host=$("#host1").val();
	 var username=$("#user1").val();
	var password=$("#pass1").val();
	 var dbname=$("#dbs1").val();
			 $.ajax({
				 url:"/getdata.php",
				 data:{"getdatasize":id,"username":username,"password":password,"host":host,"dbname":dbname},
				 type:"POST",
				 success:function(data){
					console.log(data)
					$("#first"+id).html(data);
					 },error: function(err){
						 console.log(err);
				$("#first"+id).html("error");
						 }

				 })
			 },
			  gettablesize2:function(id){
			  var host=$("#host2").val();
	 var username=$("#user2").val();
	var password=$("#pass2").val();
	 var dbname=$("#dbs2").val();
			 $.ajax({
				 url:"/getdata.php",
				 data:{"getdatasize":id,"username":username,"password":password,"host":host,"dbname":dbname},
				 type:"POST",
				 success:function(data){
					console.log(data)
					$("#second"+id).html(data);
					 },error: function(err){
						 console.log(err);
				$("#second"+id).html("error");
						 }

				 })
			 }
		 }
</script>
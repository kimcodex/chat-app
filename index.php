<?php 
	require_once'db.php';

	$message = new Message;

	if(isset($_POST['submit'])) {
		if(!empty($_POST['name']) && !empty($_POST['msg'])){
			
			$name = $_POST['name'];
			$msg = $_POST['msg'] ;

			$message->insert($name,$msg);
		}
	}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Chat System</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

 	<style>
 		#chat {
 			overflow: auto;
 			max-height: 300px;
 		}
 	</style>
 </head>

 <body onload="loadMessages();" >
 	
 	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 	  <a class="navbar-brand" href="#">Chat v1</a>
 	</nav>
 	<div class="container py-3">
 		<div class="jumbotron" ">

 		  <div id="chat" ></div>
 		  
 		  <hr class="my-3">
 		  <form action="" method="POST">
 		  	  	<div class="col-m-12 py-2">
 		  	  	  <input type="text" class="form-control" id="name" placeholder="Name" name="name" autocomplete="off" tabindex="1"> 
 		  	  	</div>
 		  	  	<div class="input-group mb-3">
 		  	  	  <input type="text" class="form-control" id="message" placeholder="Write a message" name="msg" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" tabindex="2">
 		  	  	  <div class="input-group-append">
 		  	  	  	<input type="submit" class="btn btn-outline-primary" id="send" value="Send" name="submit" tabindex="3" disabled="true">
 		  	  	  </div>
 		  	  	</div>
 		  </form>  
 		</div>
 	</div>
 	<script src="loadmessage.js"></script>	
 
 </body>
 </html>
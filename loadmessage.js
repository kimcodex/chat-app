
function loadMessages() {
	 		
	var req = new XMLHttpRequest();

	req.open('GET','load.php',true);
	req.send();

	req.onreadystatechange = function (){
		if (this.status == 200 && this.readyState == 4) {
			// var messages = JSON.parse(this.responseText);
			var messages = (this.responseText);

		    	var chatbox = document.getElementById('chat');
		    	chatbox.innerHTML = messages;
		    	chatbox.scrollTop = chatbox.scrollHeight;

		} 
	}

} 

setInterval(function () {
	loadMessages();
},1000);

// disable 'send' button if inputs are empty
var elements = document.querySelectorAll("#name, #message");

elements.forEach(function(i) {

	i.addEventListener("keyup", function() {

		var send = document.getElementById('send');

		if(elements[0].value.length !== 0 && elements[1].value.length !== 0){   

			send.removeAttribute('disabled');
		}else {

			send.setAttribute('disabled',true);
		}
	});
});




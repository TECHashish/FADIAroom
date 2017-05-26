 function sendMessage(){  
 
  if(window.XMLHttpRequest){
	   xmlhttp = new XMLHttpRequest();
   }else{
	   xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
   }

    params = "userId=" + document.getElementById("userId").value + 
             "&message=" + document.getElementById("messageBox").value; 
			 
   xmlhttp.open('POST', 'index.php', true);
   xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
   xmlhttp.send(params);
   
 }
 function loadMsg(){
   if(window.XMLHttpRequest){
	   xmlhttp = new XMLHttpRequest();
   }else{
	   xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
   }
   
   xmlhttp.onreadystatechange = function(){
	   if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
		   document.getElementById('chat1').innerHTML = xmlhttp.responseText;
	   }
   }
   xmlhttp.open('POST', 'chat.php', true);
   xmlhttp.send();
   
 }
 setInterval(function(){loadMsg()}, 1000);
 
 
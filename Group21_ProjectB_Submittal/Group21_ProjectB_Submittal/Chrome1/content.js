function addText(){
	var node = document.body;
	var text = node.textContent;
	return text;
	
}

function sendToPHP(sendObject){
	var req = new XMLHttpRequest();
	var url = 'http://localhost:80/tldr/receive.php';
	var toSendObject = sendObject;
	req.open("POST", url, true);
	req.setRequestHeader('Content-Type', 'application/json');
	req.addEventListener('load',function(){
		if(req.status >= 200 && req.status < 400){
		var response = JSON.parse(req.responseText);
		console.log(response);
		} 
		else {
		console.log("something went wrong with the request");
		}
	});
	req.send(JSON.stringify(toSendObject));
}
 
 //source: http://stackoverflow.com/questions/19197652/chrome-extension-to-send-message-from-popup-to-content-script
chrome.runtime.onMessage.addListener(
    function(request, sender, sendResponse) {
        console.log(sender.tab ?
                "from a content script:" + sender.tab.url :
                request.greeting + " from the extension");

        if (request.greeting == "hello")
            sendResponse({farewell: "goodbye"});
		
		
		if (request.method == "all"){
			var text = addText();
			console.log(text);
			var toSendObject = {"text": "strawberry fields forever"};
			sendToPHP(toSendObject);
		}
		else if (request.method == "selected"){
			var textSel = window.getSelection().toString();
			if (textSel.length < 1){
				alert("Select some text and try again, or click the whole T&C button");
			}
			else {
				alert(textSel);
				var toSendObject = {"text": "strawberry fields forever"};
				sendToPHP(toSendObject);
			}
		}
		else {
			console.log("I don't know what you want, sorry.");
		}
});
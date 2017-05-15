var buttonAll = document.getElementById("checkPage");
var buttonSel = document.getElementById("checkSelect");
//source: http://stackoverflow.com/questions/19197652/chrome-extension-to-send-message-from-popup-to-content-script
function sendClicksAll() {
    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
        chrome.tabs.sendMessage(tabs[0].id, {greeting: "hello", method:"all"}, function(response) {
            console.log(response.farewell);
        });
    });    
}

function sendClicksSel() {
    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
        chrome.tabs.sendMessage(tabs[0].id, {greeting: "hello", method:"selected"}, function(response) {
            console.log(response.farewell);
        });
    });    
}


buttonAll.addEventListener("click", function(){
	buttonAll.textContent = "Legalese be gone";
	buttonSel.textContent = "Check selected text";
	sendClicksAll();
});

buttonSel.addEventListener("click", function(){
	buttonSel.textContent = "Legalese be gone";
	buttonAll.textContent = "Check your T&C";
	sendClicksSel();
});
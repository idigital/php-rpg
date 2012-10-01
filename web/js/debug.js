var debug=true;
var debugWindow;
if ( debug == true )
	debugWindow = window.open("debugWindow.html","debugWindow","status=0,toolbar=0,location=0,menubar=0,directories=0,height=300,width=300");

function jsDebug(txt){
	if ( debug == true && debugWindow != null ){
		debugTxt = debugWindow.document.getElementById('debugTextBox').value;
		debugTxt = debugTxt + txt + "\r\n";
		debugWindow.document.getElementById('debugTextBox').value = debugTxt;
	}
}
var xmlHttp;
var ajaxResult = false;
var ajaxTip = false;		// whether a tooltip is showing that needs to be turned off when the ajax request finishes
var jsRepid = null;
var cronXmlHttp = null;
var json = false;
var jsonResult = null;
var callbackFunction = null;
function ajaxRequest(module,funct,params,sync,callback){
xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null){
		alert ("Browser does not support HTTP Request");
		return;
	}

	callbackFunction = callback;
	
	if ( sync == null )
		sync = false;

	if ( document.getElementById('global_throbber') )
		document.getElementById('global_throbber').style.visibility='visible';

//if (navigator.userAgent.indexOf("Firefox")!=-1)
//	sync=true;

	if ( navigator.userAgent.indexOf("Firefox/3") > -1 )
		xmlHttp.onload=stateChanged;
	else
		xmlHttp.onreadystatechange=stateChanged;
	
	xmlHttp.open("POST","ajaxFunctions.php?module=" + module + "&function="+funct,sync);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//xmlHttp.setRequestHeader("Content-length", params.length);
	//xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(params);	
	// workaround for firefox 3 not working in sync mode	
/*
	if ( sync == false && navigator.userAgent.indexOf("Firefox/3")!=-1 ){
		 i = 0;		 
        while( (xmlHttp.readyState != 4) && i<12 ) {
            i++;
            stateChanged()  ;
        }
        if (xmlHttp.readyState == 4 && i > 12) {
           if  (xmlHttp.status == 200){
               stateChanged();
           }
        }
	}	
*/
}

function GetXmlHttpObject(){

	var objXMLHttp=null;
	if (window.XMLHttpRequest)	{
		objXMLHttp=new XMLHttpRequest();
	} else if (window.ActiveXObject){
		objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

return objXMLHttp;

}

function stateChanged(){		
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){
		var responseCode=xmlHttp.responseText;
		//document.getElementById("debug").innerHTML = responseCode;
		//alert(responseCode);
		if ( callbackFunction != null ){
			cbfn = window[callbackFunction];
			cbfn(responseCode);
		} else {
			eval(responseCode);
		}
		
		if ( document.getElementById('global_throbber') )
			document.getElementById('global_throbber').style.visibility='hidden';
			
		if ( ajaxTip == true ){
			ajaxTip = false;
			hide_tooltip();
		}
		responseCode=null;
		callbackFunction = null;
	}
	
}

function elVal(elId){
	return document.getElementById(elId).value;
}

function getXMLDataObj(xmlData){
		xmlObj = new XML.ObjTree();
		return xmlData = xmlObj.parseXML(xmlData);
}
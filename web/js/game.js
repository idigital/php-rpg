var mapObj;
var userObj;
var gameSettings;
var exits = new Array('north','south','east','west','up','down');

function initializeGame(){
	jsDebug("initializeGame");
	params = "&user_id=" + $('#user_id').val();
	//ajaxRequest("game","initializeGame",params,false,"initializeGame_callback");
	$.post("ajaxFunctions.php?module=game&function=initializeGame",params, function(data, status){
		gameSettings = data;
		loadTile($('#tile_id').val());
		/* UNCOMMENT THIS LINE FOR PRODUCTION! */
		updateStats();
		setInterval("updateGame()",2000);
		setInterval("updateStats()",20000);
	}, 'json');
}

function updateStats(){
	$.post("ajaxFunctions.php?module=game&function=updateStats",null,function (data){
		$.each(data, function( k, v ){
			va = parseFloat(v) * 100
			$("#" + k).val( va.toFixed(0) );
				//alert(k);
				//alert(v);
						
		});
		//updateFields(data);
	}, 'json');
	//ajaxRequest("game","updateStats","",false,"updateStats_callback");
}

function clearTile(){
	$('#tile_users').html('');
	$('#messages').html('');
	//document.getElementById('tile_title').innerHTML = "";
	//document.getElementById('tile_desc').innerHTML = "";
}

function loadTile(tile_id){
	disableExits();
	jsDebug("loadTile");
	params = "&tile_id=" + tile_id;
	//ajaxRequest("map","getTileInfoById",params,false,"loadTile_callback");
	$.post("ajaxFunctions.php?module=map&function=getTileInfoById",params, function(data){
		$("#tile_title").html(data.tile.tile_title);
		$("#tile_desc").html(data.tile.tile_desc);
		$.each(data.tile.tile_exits, function (k, v){
			enableExit(k,v.tile_id);
		});
		
		$.each(data.users,function(k,v){
			showUser(v.user_id,v.user_cname,v.user_avatar);
		});
		
		$.each(data.mobs,function(k,v){
			showMob(v.mob_id,v.mob_name,v.mob_avatar);
		});
	},'json');
}

function showUser(user_id,user_name,user_avatar){
	if ( !document.getElementById(user_id) )
		document.getElementById('tile_users').innerHTML = document.getElementById('tile_users').innerHTML + "<span id=\"" + user_id + "\" class=\"game_avatar\"><img src=\"" + gameSettings.avatar_url + "/" + user_avatar + "\" title=\"" + user_name + "\" />";
}

function showMob(mob_id,mob_name,mob_avatar){
	if ( !document.getElementById('mob_' + mob_id) )
		document.getElementById('tile_users').innerHTML = document.getElementById('tile_users').innerHTML + "<span id=\"mob_" + mob_id + "\" class=\"game_avatar\"><img src=\"" + gameSettings.avatar_url + "/mobs/" + mob_avatar + "\" title=\"" + mob_name + "\" />";
}

function removeMob(mob_id){
	if ( mobEl = document.getElementById("mob_" + mob_id) ){
		document.getElementById('tile_users').removeChild(mobEl);
	}
}

function move(direction){

	jsDebug("move(" + direction + ")");
	params = "&tile_id=" + elVal(direction + "_tile_id");
	params = params + "&direction=" + direction;
	//ajaxRequest("map","move",params,false);
	$.post("ajaxFunctions.php?module=map&function=move",{ "tile_id" : $("#" + direction + "_tile_id").val(), "direction" : direction }, 
		function(data) { 
			if ( data.success == true ){
				clearTile();
				loadTile(data.tile_id);
				updateStats();
				$('#tile_id').val(data.tile_id);
				//eval(js_data) 
			} else {
				addMessage(data.message);
			}
		}, 'json');
}

function enableExit(direction,tile_id){
jsDebug("enableExit(" + direction + "," + tile_id + ")");
	document.getElementById(direction).disabled=false;
	document.getElementById(direction).className="enabled-direction";
	document.getElementById(direction + "_tile_id").value = tile_id;
}

function disableExits(){
	$(".dir-tile-id").val('');
	$(".enabled-direction").attr("disabled","true");
	$(".enabled-direction").attr("class","disabled-direction");
}

function disableExit(direction){
	document.getElementById(direction).disabled=true;
	document.getElementById(direction).className="disabled-direction";
	document.getElementById(direction + "_tile_id").value = "";
}

function updateGame(){
	//jsDebug("updateGame");
	params = "&last_id=" + $("#last_id").val();
	$.post("ajaxFunctions.php?module=game&function=updateGame",params,function (data){
		if ( data ) {
			$('#last_id').val(data.last_id);
			$(data.activity).each( function(index, el){
				addMessage(el.activity_message);
				if ( el.activity_js != "" )
					eval(el.activity_js);
			});
		}
	}, 'json');
	//ajaxRequest("game","updateGame",params,true,"updateGame_callback");
	/*
	$.getJSON('/ajaxFunctions.php',{"last_update":$("#last_update")}, function (){
		
	});
	*/
}
/*
function updateGame_callback(responseXML){
	// process the XML... this is going to end up being where a lot of the meat for the game javascript is
	if ( responseXML != "" ){
		jsDebug("updateGame_callback");
		jsDebug(responseXML);
		
		xmlData = getXMLDataObj(responseXML);
		document.getElementById('last_update').value = xmlData.activity.update_time;
		if ( typeof(xmlData.activity.activity_row.length) != "undefined" ){
			// multiple rows of activity
			for ( i = 0; i<xmlData.activity.activity_row.length; i++ ){
				addMessage(xmlData.activity.activity_row[i].activity_message);
				if ( xmlData.activity.activity_row[i].activity_js != "" )
					eval(xmlData.activity.activity_row[i].activity_js);
			}
		} else {
			// single row of activity
			addMessage(xmlData.activity.activity_row.activity_message);
			if ( xmlData.activity.activity_row.activity_js != "" )
				eval(xmlData.activity.activity_row.activity_js);
		}
		
	}
	setTimeout("updateGame()",2000);
	responseXML = null;
	xmlData = null;
}
*/
function addMessage(txt){
	if ( typeof(txt) != "undefined" && txt != "" ){
		var htm = $('#messages').html();
		htm = htm + txt + "<br />";
		$("#messages").html(htm);
		$("#messages").scrollTop($("#messages")[0].scrollHeight);
	}
	txt=null;
}

function removeUser(user_id){
	if ( userEl = document.getElementById(user_id) ){
		document.getElementById('tile_users').removeChild(userEl);
	}
}

function checkKeyPress(e){
	if ( e.keyCode == 13 ){
		params = "&message=" + escape(document.getElementById('chat_input').value)
		ajaxRequest("game","doChat",params,true);
		addMessage("You say, &quot;" + document.getElementById('chat_input').value + "&quot;");
		document.getElementById('chat_input').value='';
		return false;
	}
}

$(document).ready( function () {
	initializeGame();
});
var x = 0;
var y = 0;

function loadMap(fx,fy){
	params = "&x=" + fx + "&y=" + fy;
	ajaxRequest("mapEditor","loadMap",params,true,"loadtile_callback");
}

function loadtile_callback(responseXML){
	// label all of the tiles with their x,y coordinate
	for ( iy = 0; iy < 10; iy++ ){
		niy = (iy * -1) + y;
		for ( ix = 0; ix < 10; ix++ ){
			nix = ix + x;
			//alert(getTileNumFromCoord(ix,niy));
			document.getElementById('tile_' + getTileNumFromCoord(nix,niy)).title = nix + ", " + niy;
		}
	}
	
	xmlObj = new XML.ObjTree();
	xmlData = xmlObj.parseXML(responseXML);
	if ( typeof(xmlData.maps.tile) != "undefined" ){	// if there are no tiles loaded skip all this stuff and all the errors it would cause without any tiles
		if ( typeof(xmlData.maps.tile.length) != "undefined" ){	// if it is an array it will have a length
			for ( i=0; i<xmlData.maps.tile.length; i++ ){
				document.getElementById('tile_' + getTileNumFromCoord(xmlData.maps.tile[i].tile_x,xmlData.maps.tile[i].tile_y)).className='occupied_tile';
			}
		} else {
			document.getElementById('tile_' + getTileNumFromCoord(xmlData.maps.tile.tile_x,xmlData.maps.tile.tile_y)).className='occupied_tile';
		}
	}
}

function updateOrigin(){
	x = parseInt(document.getElementById('orig_x').value);
	y = parseInt(document.getElementById('orig_y').value);
	clearMap();
	loadMap(x,y);
}

function clearMap(){
	for ( i=0; i<100; i++ ){
		tile = document.getElementById('tile_' + i);
		tile.className = "map_tile";
	}
}

function clickTile(tileNum){
	var coords = getCoordFromTileNum(tileNum);
	params = "&x=" + coords[0] + "&y=" + coords[1] + "&z=0";
	ajaxRequest("map","getTileInfoByCoord",params,true,"tileInfo_callback");
}

function tileInfo_callback(responseXML){
		xmlObj = new XML.ObjTree();
		xmlData = xmlObj.parseXML(responseXML);
		
		// see if it's a new tile or an existing tile
		if ( typeof(xmlData.tile.new_tile)=="undefined" ){
			document.getElementById('tile_id').value = xmlData.tile.tile_id;
		} else {
			document.getElementById('tile_id').value = "new";
		}
		
		document.getElementById('tile_title').value = xmlData.tile.tile_title;
		document.getElementById('tile_x').value = xmlData.tile.tile_x;
		document.getElementById('tile_y').value = xmlData.tile.tile_y;
		document.getElementById('tile_z').value = xmlData.tile.tile_z;
		document.getElementById('tile_desc').value = xmlData.tile.tile_desc;
}

function saveTile(){
		params = "&tile_id=" + elVal('tile_id');
		params = params + "&tile_title=" + elVal('tile_title');
		params = params + "&tile_x=" + elVal('tile_x');
		params = params + "&tile_y=" + elVal('tile_y');
		params = params + "&tile_z=" + elVal('tile_z');
		params = params + "&tile_desc=" + elVal('tile_desc');		
		
		ajaxRequest("mapEditor","saveTile",params,true,"saveTile_callback");
}

function saveTile_callback(responseXML){
		xmlData = getXMLDataObj(responseXML);
		if ( xmlData.tile.error == "1" ){
			//alert("ERROR!\r\n" + xmlData.tile.msg);
		} else {
			//alert(xmlData.tile.msg);
			tileNum = getTileNumFromCoord(xmlData.tile.tile_x,xmlData.tile.tile_y);
			document.getElementById('tile_' + tileNum).className="occupied_tile";
		}
}

function getCoordFromTileNum(tileNum){
	offsetY = Math.floor((tileNum / 10));
	offsetX = parseInt(tileNum % 10);
	
	return Array((offsetX + x),((offsetY * -1) + y));
}

function getTileNumFromCoord(fx,fy){
	tileNum =  parseInt((Math.abs(fy - y) * 10)) + parseInt(fx - x);
	return tileNum;
}

function moveMap(xdiff,ydiff){
	document.getElementById('orig_x').value = (x + xdiff);
	document.getElementById('orig_y').value = (y + ydiff);
	updateOrigin();
}

window.onload= function() { loadMap(x,y); }

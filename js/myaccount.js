function showAddForm(){
	document.getElementById('shading').style.display='block';
	document.getElementById('addForm').style.display='block';
}

function hideAddForm(user_id){
	
	document.getElementById('addForm').style.display='none';
	document.getElementById('shading').style.display='none';
	
	if ( document.getElementById('action').value=='2' )
		window.location='myaccount/items/?user_id=' + user_id;
	
}
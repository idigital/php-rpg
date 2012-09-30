function addRow(){
	// adds a row to the times table
	tr = document.createElement('tr');
	
	tr.style.backgroundColor='eeeeee';
	
	td = new Array();
	td[0] = document.createElement('td');
	td[0].innerHTML = "<input type=\"text\" size=\"12\" name=\"sale_times[]['sale_time_date]\" />";
	
	td[1] = document.createElement('td');
	td[1].innerHTML = "<input type=\"text\" size=\"5\" name=\"sale_times[][sale_time_start]\" />";
	
	td[2] = document.createElement('td');
	td[2].innerHTML = "<input type=\"text\" size=\"5\" name=\"sale_times[][sale_time_end]\" />";
	
	td[3] = document.createElement('td');
	td[3].innerHTML = "<input type=\"text\" size=\"20\" name=\"sale_times[][sale_time_desc]\" />";
	
	for (i=0;i<td.length;i++)
		tr.appendChild(td[i]);
	
	document.getElementById('time_table').appendChild(tr);
}
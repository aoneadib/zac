	if(view=="info")
	{
	document.write('<table border="1"><tbody>'+
	'<tr><th>Name: </th><td>'+user['name']+'</td></tr>'+
	'<tr><th>Email: </th><td>'+user['email']+'</td></tr>'+
	'<tr><th>Gender: </th><td>'+user['gender']+'</td></tr>'+
	'<tr><th>Date of Birth: </th><td>'+user['dobday']+'/'+user['dobmonth']+'/'+user['dobyear']+'</td></tr>'+
	'<tr><th>Phone No.: </th><td>'+user['phoneno']+'</td></tr>'+
	'</tbody></table>');
	}
	else if(view=="orders")
	{
	if(!isOrderEmpty)
	{
	document.write('<table border="1">'+
	'<thead></tr>'
			+'<th>Order Id</th>'
			+'<th>Item Names</th>'
			+'<th>Item IDs</th>'
			+'<th>Order Date</th>'
			+'<th>Order Time</th>'
			+'<th>Order Status</th>'
			+'<th>Bill</th>'+
		'</tr></thead><tbody>');
	for(var index in orders){
	document.write(
	'<tr><td>'+orders[index]['id']+'</td>'+
	'<td>'+orders[index]['item_names']+'</td>'+
	'<td>'+orders[index]['item_ids']+'</td>'+
	'<td>'+orders[index]['date']+'</td>'+
	'<td>'+orders[index]['time']+'</td>'+
	'<td>'+orders[index]['status']+'</td>'+
	'<td>'+orders[index]['bill']+'</td></tr>');
	}
	document.write('</tbody></table>');
	}
	else
	{
		alert("There are no orders to show.");
	}
	}
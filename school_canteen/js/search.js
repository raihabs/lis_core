
function load_search_history()
{
	var search_query = document.getElementsByName('search_value')[0].value;

	if(search_query == '')
	{

		fetch("process_data.php", {

			method: "POST",

			body: JSON.stringify({
				action:'fetch'
			}),

			headers:{
				'Content-type' : 'application/json; charset=UTF-8'
			}

		}).then(function(response){

			return response.json();

		}).then(function(responseData){

			if(responseData.length > 0)
			{

				var html = '<ul class="list-group">';

				html += '<li class="list-group-item d-flex justify-content-between align-items-center"><b class="text-primary"><i>Your Recent Searches</i></b></li>';

				for(var count = 0; count < responseData.length; count++)
				{

					html += '<li class="list-group-item text-muted" style="cursor:pointer"><i class="fas fa-history mr-3"></i>  <span onclick="get_text(this)">'+responseData[count].search_query+'</span></li>';

				}

				html += '</ul>';

				document.getElementById('search_result').innerHTML = html;

			}

		});

	}
}

function get_text(event)
{
	var string = event.textContent;

	//fetch api

	fetch("process_data.php", {

		method:"POST",

		body: JSON.stringify({
			search_query : string
		}),

		headers : {
			"Content-type" : "application/json; charset=UTF-8"
		}
	}).then(function(response){

		return response.json();

	}).then(function(responseData){

		document.getElementsByName('search_value')[0].value = string;
	
		document.getElementById('search_result').innerHTML = '';

	});

	

}

function load_data(query)
{
	if(query.length > 2)
	{
		var form_data = new FormData();

		form_data.append('query', query);

		var ajax_request = new XMLHttpRequest();

		ajax_request.open('POST', 'process_data.php');

		ajax_request.send(form_data);

		ajax_request.onreadystatechange = function()
		{
			if(ajax_request.readyState == 4 && ajax_request.status == 200)
			{
				var response = JSON.parse(ajax_request.responseText);

				var html = '<div class="list-group">';

				if(response.length > 0)
				{
					for(var count = 0; count < response.length; count++)
					{
						html += '<a href="#" class="list-group-item list-group-item-action" onclick="get_text(this)">'+response[count].productName+'</a>';
					}
				}
				else
				{
					html += '<a href="#" class="list-group-item list-group-item-action disabled">No Data Found</a>';
				}

				html += '</div>';

				document.getElementById('search_result').innerHTML = html;
			}
		}
	}
	else
	{
		document.getElementById('search_result').innerHTML = '';
	}
}
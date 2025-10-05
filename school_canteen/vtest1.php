
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<title>Autocomplete with Recent Searches using JavaScript PHP MySQL</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="v.js" defer></script>
</head>
<body>
    <div class="container">
    	<h2 class="text-center mt-4 mb-4">Autocomplete with Recent Searches using JavaScript PHP MySQL</h2>
    	<div class="row mt-5 mb-5">
    		<div class="col col-sm-2">&nbsp;</div>
    		<div class="col col-sm-8">
    			<div class="dropdown">
    				<input type="text" name="search_box" class="form-control form-control-lg" placeholder="Type Here..." id="search_box" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onkeyup="javascript:load_data(this.value)" onfocus="javascript:load_search_history()" />
    				<span id="search_result"></span>
    			</div>
    		</div>
    	</div>    	
    </div>
</body>
</html>

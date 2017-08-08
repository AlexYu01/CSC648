<?php 
	$arrayURL = parse_url($_SERVER['REQUEST_URI']);
	$pathParts = explode('/', $arrayURL['path']);

	if(count($arrayURL) >= 2){
		$queryParts = explode('&', $arrayURL['query']); 
    
    	$params = array(); 
    	foreach ($queryParts as $param) { 
        	$item = explode('=', $param); 
        	$params[$item[0]] = $item[1]; 
    	} 
	}
?>

<ol class="breadcrumb">
	<span style="color: #ccc;">You are currently at:&nbsp;</span>
	<li><a href="<?= $this->url->build(['controller' => 'Homepage', 'action' => 'index'])?>">Home</a></li>
	
	<?php if($pathParts[2] == "search"){ ?>
		<li class="active">Search</li>
	<?php } ?>
	
	
</ol>
<hr
	style="margin-left: 35px; height: 1px; background-color: rgba(32, 48, 60, 0.1);">
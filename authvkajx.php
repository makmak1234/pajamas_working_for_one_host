<?php
	if(isset($_GET[nocache])){
		$scope = 'offline,notes,nohttps';
		echo file_get_contents("https://oauth.vk.com/authorize?v=5.29&client_id=4857278&redirect_uri=http://pajamas.esy.es/index.php&scope=" . $scope . "&display=page");
	}
?>


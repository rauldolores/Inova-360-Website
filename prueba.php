<?php

	$datos['valor1'] = "a";
	$datos['valor2'] = "b";
	
	
	$code = "AAACmWZBo3SiIBACO84SwddmlisYZB7ELZBHvNBZBRbMuiseRj8xthJ3vA8mbLlWjSra859lhesAqhJZBhdzJ1yCPz978UhekZAmq8MjDQHwAZDZD";
	
	$graph_url = "https://graph.facebook.com/me?access_token=" . $code;
     $user = json_decode(file_get_contents($graph_url));
	
	echo json_encode($user);

?>
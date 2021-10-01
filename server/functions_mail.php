<?php

	function send_mail($email, $username, $password, $gemini_id, $activation_code){
	
		$activation_url = "http://gemiini.org/Active,$activation_code";

		$html = '
		<html>
			<head>
				<title>Gemiini - Acount Activation</title>
			</head>
			<body>
				<img src="http://gemiini.org/multimedia/img/gemini_logo.jpg" border="0"/><br/><br/>
				Hello '.$username.', <br /><br/>
				Welcome to GemIIni Educational Systems. We are excited to get you started with our program.<br/>
				You have been registered as the following user: <br/><br/>

				USER NAME: '.$username.'<br/>
				PASSWORD: '.$password.'<br/>
				GEMID #: '.$gemini_id.'<br/><br/>

				You are now ready to use the GemIIni program.  If you registered yourself
				and a student simultaneously with GemIIni, there are now two separate accounts:
				yours and the student’s.<br/><br/>

				To activate your account(s), please follow the link below<br/><br/>
				Click here to activate account(s): 
				<a href="'.$activation_url.'">'.$activation_url.'</a><br/><br/>

			</body>
		</html>';

		$title = "Gemiini - Acount Activation";

		$header = "From: admin@gemiini.com\r\nContent-type: text/html\r\n";
		
		mail($email,$title,$html,$header);

	}
	
?>
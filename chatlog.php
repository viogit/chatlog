<!DOCTYPE html>
<html lang="en">
<head>
<!-- title -->
<title>q3a chatlog</title>
<!-- title -->
<!-- meta -->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width">
<!-- meta -->
<!-- style -->
<style type="text/css">
html, body, div {
	padding: 0;
	margin: 0;
}

body {
	color: #FFF;
	background-color: #222;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
}

a, a:active {
	color: #6699CC;
	outline-style: none;
	text-decoration: none;
}

a:hover {
	color: #FF9000;
}

hr {
	border: none;
	border-top: 1px #1A1A1A solid;
	height: 2px;
	color: #2A2A2A;
	background-color: #2A2A2A;
}

button::-moz-focus-inner,
input::-moz-focus-inner {
	padding: 0;
	border: 0;
}

#content {
	margin: 20px;
	padding: 20px;
	box-shadow: 0px 0px 6px rgba(0, 0, 0,.6);
	-o-box-shadow: 0px 0px 6px rgba(0, 0, 0,.6);
	-webkit-box-shadow: 0px 0px 6px rgba(0, 0, 0,.6);
	-moz-box-shadow: 0px 0px 6px rgba(0, 0, 0,.6);
}

::selection { background-color: #000; color: #FFF; }
::-moz-selection { background-color: #000; color: #FFF; }
::-webkit-selection { background-color: #000; color: #FFF; }
</style>
<!-- style -->
</head>
<body>

<div id="content">
chatlog 
[<a href="javascript:document.location.reload();">reload page</a>] 
[<a href="https://github.com/viogit/chatlog" target="_blank">github</a>]
<hr />
<?php
$char_trans = array(
"\x01" => "(", "\x02" => "▀", "\x03" => ")", "\x04" => "█", "\x05" => " ", "\x06" => "█", "\x07" => "(", "\x08" => "▄", "\x09" => ")", "\x0b" => "_", "\x0b" => "■", "\x0c" => " ", "\x0d" => "►", "\x0e" => "·", "\x0f" => "·",
"\x10" => "[", "\x11" => "]", "\x12" => "|¯", "\x13" => "¯", "\x14" => "¯|", "\x15" => "▌", "\x16" => " ", "\x17" => "▐", "\x18" => "|_", "\x19" => "_", "\x1a" => "_|", "\x1b" => "¯", "\x1c" => "·", "\x1d" => "(", "\x1e" => "-", "\x1f" => ")",
"\x7f" => "<-",
"\x80" => "(", "\x81" => "=", "\x82" => ")", "\x83" => "|", "\x84" => " ", "\x85" => "·", "\x86" => "▼", "\x87" => "▲", "\x88" => "◄", "\x89" => " ", "\x8a" => " ", "\x8b" => "■", "\x8c" => " ", "\x8d" => "►", "\x8e" => "·", "\x8f" => "·",
"\x90" => "[", "\x91" => "]", "\x92" => "0", "\x93" => "1", "\x94" => "2", "\x95" => "3", "\x96" => "4", "\x97" => "5", "\x98" => "6", "\x99" => "7", "\x9a" => "8", "\x9b" => "9", "\x9c" => "·", "\x9d" => "(", "\x9e" => "-", "\x9f" => ")",
"\xa0" => " ", "\xa1" => "!", "\xa2" => "\"", "\xa3" => "#", "\xa4" => "$", "\xa5" => "%", "\xa6" => "&", "\xa7" => "'", "\xa8" => "(", "\xa9" => ")", "\xaa" => "*", "\xab" => "+", "\xac" => ",", "\xad" => "-", "\xae" => ".", "\xaf" => "/",
"\xb0" => "0", "\xb1" => "1", "\xb2" => "2", "\xb3" => "3", "\xb4" => "4", "\xb5" => "5", "\xb6" => "6", "\xb7" => "7", "\xb8" => "8", "\xb9" => "9", "\xba" => ":", "\xbb" => ";", "\xbc" => "<", "\xbd" => "=", "\xbe" => ">", "\xbf" => "?",
"\xc0" => "@", "\xc1" => "A", "\xc2" => "B", "\xc3" => "C", "\xc4" => "D", "\xc5" => "E", "\xc6" => "F", "\xc7" => "G", "\xc8" => "H", "\xc9" => "I", "\xca" => "J", "\xcb" => "K", "\xcc" => "L", "\xcd" => "M", "\xce" => "N", "\xcf" => "O",
"\xd0" => "P", "\xd1" => "Q", "\xd2" => "R", "\xd3" => "S", "\xd4" => "T", "\xd5" => "U", "\xd6" => "V", "\xd7" => "W", "\xd8" => "X", "\xd9" => "Y", "\xda" => "Z", "\xdb" => "[", "\xdc" => "\\", "\xdd" => "]", "\xde" => "^", "\xdf" => "_",
"\xe0" => "'", "\xe1" => "A", "\xe2" => "B", "\xe3" => "C", "\xe4" => "D", "\xe5" => "E", "\xe6" => "F", "\xe7" => "G", "\xe8" => "H", "\xe9" => "I", "\xea" => "J", "\xeb" => "K", "\xec" => "L", "\xed" => "M", "\xee" => "N", "\xef" => "O",
"\xf0" => "P", "\xf1" => "Q", "\xf2" => "R", "\xf3" => "S", "\xf4" => "T", "\xf5" => "U", "\xf6" => "V", "\xf7" => "W", "\xf8" => "X", "\xf9" => "Y", "\xfa" => "Z", "\xfb" => "{", "\xfc" => "|", "\xfd" => "}", "\xfe" => "\"", "\xff" => "->");

function msg_color($get) {
	$cget = preg_replace("/\^x([a-fA-F0-9]{6})/i", "<span style=\"color:#\\1\">", $get);

	$cget = preg_replace_callback("/\^([^\^<])/",
	function($m) {
		$colors = array("gray", "red", "lime", "yellow", "dodgerblue", "aqua", "fuchsia", "white", "orange");
		return "<span style=\"color:".$colors[ord($m[1]) % 8]."\">";
	}, $cget);

	$search = array("/</", "/^(.*?)<\/span>/");
	$replace = array("</span><", "\\1");
	$cget = preg_replace($search, $replace, $cget);

	if ($cget != $get) {
		$cget = preg_replace("/$/", "</span>", $cget);
	}

	return $cget;
}

/* tac,grep,tail faster */
$log = shell_exec("grep \"say:\" \"./excessiveplus/games.log\" | tail -n3000 | grep -oP \"say:\s+\K.*\s+\" | uniq | tail -n1000 | tac");
$log = explode("\n", $log);
if (count($log) > 1) {
	foreach($log as $get) {
		if (!empty($get)) {
			$msg = preg_replace("/\^(a[1-9]|[fFrRbBoOlL])/", "", $get);
			$msg = preg_replace("/\^s(\^x[a-fA-F0-9]{6}|\^[^\^])/", "\\1", $msg);

			preg_match('/^(.*?): (.*?) $/', $msg, $omg);
			if (!empty($omg[1]) && !empty($omg[2])) {
				$cname = preg_replace("/\^s/", "^7", $omg[1]);
				if ($cname[0] != "^") {
					$cname = "^7".$cname;
				}
				$cmsg = preg_replace("/\^s/", "^2", $omg[2]);
				if ($cmsg[0] != "^") {
					$cmsg = "^2".$cmsg;
				}
				$msg = $cname."^7: ".$cmsg;

				$msg = preg_replace("/(\^(x[a-fA-F0-9]{6}|[^\^]))\^(x[a-fA-F0-9]{6}|[^\^])/", "\\1", $msg);
				$msg = strtr($msg, $char_trans);
				$msg = htmlspecialchars($msg);
				$msg = msg_color($msg);
				echo $msg."<br />\r\n";
			}
		}
	}
} else {
	echo "message empty :(";
}
?>
</div>

</body>
</html>

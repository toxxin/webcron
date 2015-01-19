<?php

$subject = "01.01.1970";

function checkExp($s)
{
	$pattern = "/^((((\*|[0-9]){2})|(\*))\.){2}((\*|[0-9]){4})$/";
	
	echo $s."</br>";
	echo strlen($s)."</br>";
	echo preg_match($pattern, $s)."</br>";
	return (preg_match($pattern, $s) == 1) ? True : False;
}

function genReg($s)
{
	if (!checkExp($s))
		echo "Wrong format";

	list($dd, $mm, $yyyy) = split("\.", $s, 3);
	
	if ((strlen($dd) == 1) and ($dd == "*"))
	 	$dd = $dd."*";	

	if ((strlen($mm) == 1) and ($mm == "*"))
		$mm = $mm."*";

	if ((strlen($yyyy) == 1) and ($yyyy == "*"))
		$yyyy = $yyyy."***";

	$n = "/^".$dd."\.".$mm."\.".$yyyy."/";
	$n = str_replace("*", "([0-9])", $n);

	echo $n;

	return $n;
}


if (preg_match(genReg("**.08.197*"), $subject))
	echo "Ok</br>";
else
	echo "Fail</br>";

?>

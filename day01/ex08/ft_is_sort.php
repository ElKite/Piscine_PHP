#!/usr/bin/php
<?PHP
function ft_is_sort($tab)
{
	$tmp = $tab;
	sort($tmp);
	if ($tmp === $tab) {
		return true;
	}
	else {
		return false;
	}
}

//$tab = array("!/@#;^", "42", "Hello World", "salut", "zZzZzZz");
//$tab[] = "Et qu’est-ce qu’on fait maintenant ?";
//if (ft_is_sort($tab) === true) {
//	echo "Le tableau est trie\n";
//}
//else {
//	echo "Le tableau n'est pas trie\n";
//}

?>
<?php


echo "<HTLM><TITLE>Error</TITLE>";
echo "<BODY>";


$MyCase=$_GET['error'];

switch($MyCase){

	case 1:
		echo "Cal accedir a aquesta pàgina utilitzant la <a href=\"index.php\">pàgina inicial</a>";
		break;
	default:
		echo "Heu fet un error. Torneu a la <a href=\"index.php\">pàgina inicial</a>";

} //end of switch

echo "</BODY></HTML>";
?>
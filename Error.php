<?php


echo "<HTLM><TITLE>Error</TITLE>";
echo "<BODY>";


$MyCase=$_GET['error'];

switch($MyCase){

	case 1:
		echo "Cal accedir a aquesta p�gina utilitzant la <a href=\"index.php\">p�gina inicial</a>";
		break;
	default:
		echo "Heu fet un error. Torneu a la <a href=\"index.php\">p�gina inicial</a>";

} //end of switch

echo "</BODY></HTML>";
?>
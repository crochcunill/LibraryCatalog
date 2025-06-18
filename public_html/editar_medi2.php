<?php
		session_start();

		$validacio=$_POST['validacio'];

//********* FUNCTIONS *******************************
function checkvalues($myvalue){
			//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...
			
			//Signes de puntuació i altres caracters que son valids.			
			//$signes = array("?","!","@","#","$","%","\\","\/","'","&","-",";","¥","\"",",","\s",".","∑",";",":","(",")"," ","‡","·","‰","‚","ˆ","˙","˘","˚","¸","«","—","¿","¡","ƒ","¬","…","»"," ","Œ","œ","”","“","‘","÷","⁄","Ÿ","€","‹");

			//$tamany_array=count($signes);
			//for($counter=0;$counter<$tamany_array;$counter++){
			
			//	$pattern=$signes[$counter];				
			//	$myvalue2=str_ireplace_replace($pattern,"",$myvalue2);
			//}
			
		
			$correct=preg_match("[^0-9A-Za-z_]", $myvalue); //es a dir, si no son lletres i/o numeros, aixo es cert

			if ($correct)
				{return "false";}
			else
				{return trim($myvalue);}
				
	} //end function checkvalues
	
function checklenght($myvalue){	
			if (strlen(trim($myvalue))<1)
				{return "false";}
			else
				{return trim($myvalue);}
	} //end function checklenght
	

//********* END FUNCTIONS ***************************



if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		}  

//At least the medi description name must exists!
if (checklenght($_POST['medi_nom'])=="false" || checkvalues($_POST['medi_nom'])=="false") {
		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caracters no valids en la <I>nom</I> del medi. Intenteu de nou";				include("peu2.txt");					
		}		
else{
		include("common_variables.php");	
		$query_string="UPDATE medis set  medi_nom='" . $_POST['medi_nom']. "' where medi_ID=".$_POST['medi_ID'];	
		$resultats=mysqli_query($link_ID,$query_string,1);

		$mysqli_error=mysqli_error($link_ID);				
		if (!empty($mysqli_error)){				
			echo "<BR>query string ".$query_string;	
			echo "===> $mysqli_error<BR>";
			}
		else{
			header("Location: ./tots_medis.php?validacio=".$validacio."&flag=3&medi_nom=".$_POST['medi_nom']); /* Redirect browser */
			exit;
			}
			
	} //end else (checklenght($_POST['medi....		

	
?>			
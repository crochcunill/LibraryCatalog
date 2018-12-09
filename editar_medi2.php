<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];

//********* FUNCTIONS *******************************
function checkvalues($myvalue){
			//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...
			
			//Signes de puntuació i altres caracters que son valids.			
			$signes=array("[\s]","[\.]","[\"]","[']","[,]","[;]","[,]","[à]","[á]","[ä]","[â]","[é]","[è]","[ê]","[ë]","[í]","[ì]","[î]","[ï]","[ó]","[ò]","[ô]","[ö]","[ú]","[ù]","[û]","[ü]","[ç]","[Ç]","[ñ]","[Ñ]" );			
			
			$tamany_array=count($signes);
			for($counter=0;$counter<$tamany_array;$counter++){
			
				$pattern=$signes[$counter];				
				$myvalue2=preg_replace($pattern,"",$myvalue2);
			}
			
		
			$correct=ereg("[^0-9A-Za-z_]", $myvalue2); //es a dir, si no son lletres i/o numeros, aixo es cert

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
if (checklenght($HTTP_POST_VARS['medi_nom'])=="false" || checkvalues($HTTP_POST_VARS['medi_nom'])=="false") {
		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caracters no valids en la <I>nom</I> del medi. Intenteu de nou";				include("peu2.txt");					
		}		
else{
		$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");						
		$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);		$query_string="UPDATE medis set  medi_nom='" . $HTTP_POST_VARS['medi_nom']. "' where medi_ID=".$HTTP_POST_VARS['medi_ID'];	
		$resultats=mysql_query($query_string, $link_ID);
		
		$MYSQL_ERRNO=mysql_errno($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){				echo "<BR>query string ".$query_string;	
				echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
				}
		else{
				header("Location: ./tots_medis.php?validacio=".$validacio."&flag=3&medi_nom=".$HTTP_POST_VARS['medi_nom']); /* Redirect browser */
				exit;
				}
			
	} //end else (checklenght($HTTP_POST_VARS['medi....		

	
?>			
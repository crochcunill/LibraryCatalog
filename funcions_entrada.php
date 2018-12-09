<?php
//********* FUNCTIONS *******************************
function checkvalues($myvalue){
		//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...			
		//tanmateix, permeto que signes de puntuació i altres caracters que son valids
		//siguin acceptats.			
		
		//$signes=array("[\s]","[\.]","[\"]","[']","[,]","[;]","[,]","[à]","[á]","[ä]","[â]","[é]","[è]","[ê]","[ë]","[í]","[ì]","[î]","[ï]","[ó]","[ò]","[ô]","[ö]","[ú]","[ù]","[û]","[ü]","[ç]","[Ç]","[ñ]","[Ñ]" );						
		$signes = array("?","!","@","#","$","%","\\","\/","'","&","-",";","´","\"",",","\s",".","·",";",":","(",")"," ","à","á","ä","â","é","è","ê","ë","í","ì","î","ï","ó","ò","ô","ö","ú","ù","û","ü","ç","Ç","ñ","Ñ","À","Á","Ä","Â","É","È","Ê","Ë","Í","Ì","Î","Ï","Ó","Ò","Ô","Ö","Ú","Ù","Û","Ü");
	
	$myvalue2=$myvalue;
	
		$tamany_array=count($signes);
	//	for($counter=0;$counter<$tamany_array;$counter++){			
	//			$pattern=$signes[$counter];				
	//			$myvalue2=str_replace($pattern,"",$myvalue2);
	//		}		
		
		for($counter=0;$counter<$tamany_array;$counter++){
			$mypattern =$signes[$counter];
			$myvalue2 = str_replace($mypattern, "", $myvalue2);
		
		}	
		
//Em penso que aquests dos caracters son el line feed/carriage return
//Perque no m'els elimina el "\s", no ho se....		
$myvalue2 = str_replace(chr(13), "", $myvalue2);
$myvalue2 = str_replace(chr(10), "", $myvalue2);



			
		$correct=ereg("[^0-9A-Za-z_]", $myvalue2,$myarray); //es a dir, si no son lletres i/o numeros, aixo es cert
	
		if ($correct)
				{
				
				//return "false"; //Es a dir, si hi han numeros, aixo tornara "false"
		
				$myanswer=array('false',$myarray);
				
				return $myanswer;
				
				
			}
		else
				{return trim($myvalue);}
				
	} //end function checkvalues
	
	
	
	
	
	
function checklenght($myvalue){	
			if (strlen(trim($myvalue))<1)
				{return "false";}
			else
				{return trim($myvalue);}
	} //end function checklenght

function isnumber($myvalue){
					
			$correct=ereg("[^0-9]", $myvalue); 
			
			if ($correct){//si aixo es veritat vol dir que hi han caracter no numerics
				return "false";}
			else{
				return trim($myvalue);}
	} //end function checklenght
	

//********* END FUNCTIONS ***************************	
?>
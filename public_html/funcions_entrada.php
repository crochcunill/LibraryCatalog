<?php
//********* FUNCTIONS *******************************
function checkvalues($myvalue){
		//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...			
		//tanmateix, permeto que signes de puntuació i altres caracters que son valids
		//siguin acceptats.			
		
		$signes = array("?","!","@","#","$","%","\\","\/","'","&","-",";","¥","\"",",","\s",".","∑",";",":","(",")"," ","‡","·","‰","‚","È","Ë","Í","Î","Ì","Ï","Ó","Ô","Û","Ú","Ù","ˆ","˙","˘","˚","¸","Á","«","Ò","—","¿","¡","ƒ","¬","…","»"," ","À","Õ","Ã","Œ","œ","”","“","‘","÷","⁄","Ÿ","€","‹");
	
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
			
	
	$correct=preg_match("[^0-9A-Za-z_]", $myvalue2); //es a dir, si no son lletres i/o numeros, aixo es cert

		if ($correct)
				{
				
				//return "false"; //Es a dir, si hi han numeros, aixo tornara "false"
		
				$myanswer=array('false',$myvalue2);
				
				return $myanswer;
				
				
			}
		else {return trim($myvalue2);}
				
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
	

function escapeComma($myvalue){
	$myvalue = str_replace(chr(39), "\'", $myvalue);// So it can accept aphostrophes
	return trim($myvalue);
	} //end function escapeComma



//********* END FUNCTIONS ***************************	
?>
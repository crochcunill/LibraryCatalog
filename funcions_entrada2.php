<?php
//********* FUNCTIONS *******************************
function checkvalues($myvalue){
		//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...			
		//tanmateix, permeto que signes de puntuació i altres caracters que son valids
		//siguin acceptats.			
	
		//$signes = array(" ",";" ,",",'\s',"." ,"à","á","ä","â","é","è","ê","ë","í","ì","î","ï","ó","ò","ô","ö","ú","ù","û","ü","ç","Ç","ñ","Ñ");
		$signes = array("!","@","#","$","%","\\","\/","'","&","-",";" ,",","\s","." ," ","à","á","ä","â","é","è","ê","ë","í","ì","î","ï","ó","ò","ô","ö","ú","ù","û","ü","ç","Ç","ñ","Ñ");
	
		$sentence=$myvalue;
	
		for($counter=0;$counter<count($signes);$counter++){
			$mypattern =$signes[$counter];
			$sentence = str_replace($mypattern, "", $sentence);
		
		}	
	
		//$signes=array("[\s]","[\.]","[\"]","[']","[,]","[;]","[,]","[à]","[á]","[ä]","[â]","[é]","[è]","[ê]","[ë]","[í]","[ì]","[î]","[ï]","[ó]","[ò]","[ô]","[ö]","[ú]","[ù]","[û]","[ü]","[ç]","[Ç]","[ñ]","[Ñ]" );						
		//$tamany_array=count($signes);
		//for($counter=0;$counter<$tamany_array;$counter++){			
		//		$pattern=$signes[$counter];				
		//		$myvalue2=str_replace($pattern,"",$myvalue2);
		//	}
			
		$correct=ereg("[^0-9A-Za-z_]", $sentence,$myarray); //es a dir, si no son lletres i/o numeros, aixo es cert
	
		if ($correct)
				{
				
				$myanswer=array('false',$myarray, $sentence);
				
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
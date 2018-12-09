<?php
//********* FUNCTIONS *******************************
function checkvalues($myvalue){
		//Amb aquesta funci� controlo que ningu entri caracters extranys com ara ! $ #...			
		//tanmateix, permeto que signes de puntuaci� i altres caracters que son valids
		//siguin acceptats.			
		
		$signes=array("[\s]","[\.]","[\"]","[']","[,]","[;]","[,]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]","[�]" );						
		$tamany_array=count($signes);
		for($counter=0;$counter<$tamany_array;$counter++){			
				$pattern=$signes[$counter];				
				$myvalue2=str_replace($pattern,"",$myvalue2);
			}
			
		$correct=ereg("[^0-9A-Za-z_]", $myvalue2); //es a dir, si no son lletres i/o numeros, aixo es cert
	
		if ($correct)
				{return "false";} //Es a dir, si hi han numeros, aixo tornara "false"
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
?>
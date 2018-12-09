<?php
	session_start();

	$validacio=$HTTP_POST_VARS['validacio'];
		
	//******** FUNCIONS***********
	include("funcions_entrada2.php");
	//****************************



	//	$signes = array("!","@","#","$","%","\\","\/","'","&","-",";" ,",","\s","." ," ","à","á","ä","â","é","è","ê","ë","í","ì","î","ï","ó","ò","ô","ö","ú","ù","û","ü","ç","Ç","ñ","Ñ");
	
		$myvalue=$HTTP_POST_VARS['titol_sinopsis'];
	
	//	for($counter=0;$counter<count($signes);$counter++){
	//		$mypattern =$signes[$counter];
	//		$sentence = str_replace($mypattern, "", $sentence);
		
	//	}	
		
//Em penso que aquests dos caracters son el line feed/carriage return
//Perque no m'els elimina el "\s", no ho se....		
//$sentence = str_replace(chr(13), "", $sentence);
//$sentence = str_replace(chr(10), "", $sentence);


//	echo "<P>====>".$sentence;
	
//		$correct=ereg("[^0-9A-Za-z_]", $sentence,$myarray); //es a dir, si no son lletres i/o numeros, aixo es cert
	
	
//	echo "<P>====>".$correct;
	
$myanswer=checkvalues($myvalue);

$correct=$myanswer[0];

	if ($correct)
			{echo "<P>No que conte caracters extranys";
			echo "<P>>>>0  ".$myanswer[0];
			echo "<P>>>>1  ".$myanswer[1][0];
			echo "<P>>>>  ".$myanswer[2];
				}	

		else
			
			
			{echo "<P>Conte caracters extrany >>>".$myanswer[1]."<<<<";
			
		//	for($counter2=0;$counter2<count($counter2);$counter2++){

		//	echo "<P>===>".$counter2."  >>>".ord($myarray[$counter2])."<<<";
			
			}
	
	
	
		
		//$signes=array("[\s]","[\.]","[\"]","[']","[,]","[;]","[,]","[à]","[á]","[ä]","[â]","[é]","[è]","[ê]","[ë]","[í]","[ì]","[î]","[ï]","[ó]","[ò]","[ô]","[ö]","[ú]","[ù]","[û]","[ü]","[ç]","[Ç]","[ñ]","[Ñ]" );						
		//$tamany_array=count($signes);
		//for($counter=0;$counter<$tamany_array;$counter++){			
		//		$pattern=$signes[$counter];				
		//		$myvalue2=str_replace($pattern,"",$myvalue2);
		//	}
		
?>			
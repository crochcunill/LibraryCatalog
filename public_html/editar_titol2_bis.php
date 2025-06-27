<?php
	session_start();

	$validacio=$_POST['validacio'];
		
	//******** FUNCIONS***********
	include("funcions_entrada2.php");
	//****************************



	//	$signes = array("!","@","#","$","%","\\","\/","'","&","-",";" ,",","\s","." ," ","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�","�");
	
		$myvalue=$_POST['titol_sinopsis'];
	
	//	for($counter=0;$counter<count($signes);$counter++){
	//		$mypattern =$signes[$counter];
	//		$sentence = str_replace($mypattern, "", $sentence);
		
	//	}	
		
//Em penso que aquests dos caracters son el line feed/carriage return
//Perque no m'els elimina el "\s", no ho se....		
//$sentence = str_replace(chr(13), "", $sentence);
//$sentence = str_replace(chr(10), "", $sentence);


//	echo "<P>====>".$sentence;
	
//		$correct=preg_match("[^0-9A-Za-z_]", $sentence,$myarray); //es a dir, si no son lletres i/o numeros, aixo es cert
	
	
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

		
?>			
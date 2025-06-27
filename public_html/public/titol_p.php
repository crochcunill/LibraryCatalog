<?php

	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************

	include("common_variables.php");

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera.txt");
    $titol=$_POST['titol'];
    $pagina_actual=$_POST['pagina_actual'];		
	

	if ((trim($titol))==""){
		$titol=$_GET['titol'];
		}
	if (trim($pagina_actual)==""){
		$pagina_actual=$_GET['pagina_actual'];
		}
	
	if (checkvalues($titol)=="false") {
		echo "<P>Hi han caracters no valids en el que heu entrat <I><?php echo $titol ?></I>. Intenteu de nou";				$PerformQuery=0;							}
	elseif (checklenght($titol)=="false" ) {		echo "<P>Heu d'entrar alguna cosa. Intenteu de nou";				$PerformQuery=0;							}				else{		$begin_query="Select titol_ID,titol_nom,autor_nom,autor_cognoms,autor_ID,idioma_nom from titols,autors,idiomes where (";
		$end_query=") AND (titol_autor_ID=autor_ID) AND (titol_idioma_ID=idioma_ID)";							$title_elements=explode(" ",$titol);
			
		$tamany_array=count($title_elements);
		for($counter=0;$counter<$tamany_array;$counter++){			
				$element=$title_elements[$counter];	
				if ($counter<$tamany_array-1){			
					$mid_query=$mid_query. " titol_nom LIKE '%".$element."%' OR ";
					}
				else{
					$mid_query=$mid_query. " titol_nom LIKE '%".$element."%'";
					}	
			}
		
		$mevaquery=$begin_query.$mid_query.$end_query;			
		$PerformQuery=1;		}
								
	if ($PerformQuery!=0){						
		$resultats=mysqli_query($link_ID,$mevaquery);			
		$num_entrades=mysqli_num_rows($resultats);
		$numero_pagines=ceil($num_entrades/$tamany_pagina);				
?>		
	<p>Hi han <B><?php echo $num_entrades?></B> títol/s a la base de dades que 
	 contenen <B>"<?php echo $titol ?>"</B> en el títol. 
	 Els trobareu ordenats pel seu <B>títol</B> i distribuïts en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 

	
	<center class="normal">
	
	<P>Pàgina:	
	<?php
	if ($pagina_actual-$paginacio>=1  and $pagina_actual+$paginacio<$numero_pagines){
		echo  "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=1>"."<<"."</A>"." | ";
		for ($i=$pagina_actual-$paginacio;$i<=$pagina_actual+$paginacio;$i++){
			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=".$i.">".$i."</A>"." | ";
			}
			else {echo " | ". "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=".$i.">".$i."</A>";}
		}	
		echo  " | "."<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=$numero_pagines>".">>"."</A>";
	}
	
	elseif ($pagina_actual-$paginacio<1 and $pagina_actual+$paginacio>$numero_pagines){
		for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=".$i.">".$i."</A>"." | ";
			}
			else {echo " | ". "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=".$i.">".$i."</A>";}
				
		}	
	}
	elseif ($pagina_actual-$paginacio<1 and $pagina_actual+$paginacio<$numero_pagines+1){
		for ($i=1;$i<=$pagina_actual+$paginacio;$i++){
			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=".$i.">".$i."</A>"." | ";
			}
			else {echo " | ". "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=".$i.">".$i."</A>";}	
		}	
		echo  " | "."<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=$numero_pagines>".">>"."</A>";
	}
	else{
		echo  "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=1>"."<<"."</A>"." | ";
		for ($i=$pagina_actual-$paginacio;$i<=$numero_pagines;$i++){
			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./titol_p.php?titol=".$titol."&pagina_actual=".$i.">".$i."</A>"." | ";
			}	
		}

	}
	

?>

	<table width="85%" border="1"> 
		<TR class="normal_table">
			<TD width=30%><B>Titol</B></td>
			<TD width=25%><B>Autor/a</B></td>
			<TD width=10%><B>Llengua</B></td>
			<TD colspan=2><B>Detalls</b></td>
		</TR><?php		
		
	$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
	$mevaquery=$mevaquery.$limit_query;

	$resultats=mysqli_query($link_ID,$mevaquery);
	$color_flag=1;	
	while ($els_resultats=mysqli_fetch_row($resultats)){	
						
		if ($color_flag==1){				
			echo "<TR bgcolor=\"ffffaa\"  class=\"normal\">";
			$color_flag=2;
			}
		else{	
			echo "<TR  class=\"normal\">";
			$color_flag=1;
			}
							
												
		echo "	<TD>". $els_resultats[1]. "</td>";
		echo "	<TD>". $els_resultats[2]. " ".$els_resultats[3]."</td>";
		echo "	<TD>". $els_resultats[5]."</td>";
	
		echo "	<TD align=center valign=middle>";
		echo "		<FORM action=\"detalls_titol.php\" method=POST id=form1 name=form1>";
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";
		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_nom\">";		
		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[3]."\"  name=\"autor_cognoms\">";		
		echo "				<INPUT class=\"petit\" type=\"submit\" value=\"Del títol\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";
						
		echo "	<TD  align=center valign=middle>";
		echo "		<FORM action=\"detalls_autor.php\" method=POST id=form1 name=form1>";
						
		echo "				<INPUT type=\"hidden\" value=1 name=\"pagina_actual\">";											
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[4]."\"  name=\"autor_ID\">";		
		echo "				<INPUT  class=\"petit\" type=\"submit\" value=\"De l'autor\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";

		echo "</TR>";
			
		} //end while	
		
		
	$mysqli_error=mysqli_error($link_ID);
	$MYSQL_ERROR=mysqli_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
		}
	
	echo "</TABLE>";
	echo "</center>";
	echo "<P>";
	//	echo "<P>$mevaquery";					
	} //end if ($PerformQuery!=0)	

			
include("peu.txt");

?>
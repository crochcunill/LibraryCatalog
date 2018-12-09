<?php

	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera.txt");
    $titol=$_POST['titol'];
    $pagina_actual=$_POST['pagina_actual'];		
	
	if (checklenght($titol)=="false" ) {
		$titol=$_GET['titol'];
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
		
		include("common_variables.php");						
		$resultats=mysql_query($mevaquery, $link_ID);			
		$num_entrades=mysql_num_rows($resultats);
		$numero_pagines=ceil($num_entrades/$tamany_pagina);				
?>		
	<p>Hi han <B><?php echo $num_entrades?></B> títol/s a la base de dades que 
	 contenen <B>"<?php echo $titol ?>"</B> en el títol. 
	 Els trobareu ordenats pel seu <B>titol</B> i distribuits en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 

	
	<center class="normal">
	
	<P>Pàgina
	
<?php	
	for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==1){
				if ($i==$pagina_actual){
					echo $i;}
				else{
					echo "<A HREF=./titol_p.php?titol=".urlencode($titol)."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			else{
				if ($i==$pagina_actual){
					echo " | ".$i;}
				else{
					echo " | ". "<A HREF=./titol_p.php?titol=".urlencode($titol)."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			}	
									include("common_variables.php");		$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
	$mevaquery=$mevaquery.$limit_query;	
?>

	<table width="85%" border="1"> 
		<TR class="normal_table">
			<TD width=30%><B>Titol</B></td>
			<TD width=25%><B>Autor/a</B></td>
			<TD width=10%><B>Llengua</B></td>
			<TD colspan=2><B>Detalls</b></td>
		</TR><?php				
	$resultats=mysql_query($mevaquery, $link_ID);
	$color_flag=1;	
	while ($els_resultats=mysql_fetch_row($resultats)){	
						
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
		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_nom\">";		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[3]."\"  name=\"autor_cognoms\">";		
				echo "				<INPUT class=\"petit\" type=\"submit\" value=\"Del títol\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";
						
		echo "	<TD  align=center valign=middle>";
		echo "		<FORM action=\"detalls_autor.php\" method=POST id=form1 name=form1>";
						
				echo "				<INPUT type=\"hidden\" value=1 name=\"pagina_actual\">";											
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[4]."\"  name=\"autor_ID\">";		echo "				<INPUT  class=\"petit\" type=\"submit\" value=\"De l'autor\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";

		echo "</TR>";
			
		} //end while	
		
		
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}
	
	echo "</TABLE>";
	echo "</center>";
	echo "<P>";
	//	echo "<P>$mevaquery";					
	} //end if ($PerformQuery!=0)	

			
include("peu.txt");

?>
<?php

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera.txt");
	
	include("common_variables.php");
	
	if (empty($_POST['autor_ID'])){
				$autor_ID=$_GET['autor_ID'];
				}
	 else {
				$autor_ID=$_POST['autor_ID'];
				}

	if (empty($_POST['pagina_actual'])){
				$pagina_actual=$_GET['pagina_actual'];
				}
	 else {
				    $pagina_actual=$_POST['pagina_actual'];
				}

	
		$query_string="SELECT autor_ID,autor_nom,autor_cognoms,idioma_nom,autor_biografia FROM autors,idiomes WHERE idioma_ID=autor_idioma_ID and autor_id=". $autor_ID;			

	$resultats=mysql_query($query_string, $link_ID);
		
				while ($els_resultats=mysql_fetch_row($resultats)){
						$autor_nom=$els_resultats[1];
						$autor_cognoms=$els_resultats[2];
						$autor_llengua=$els_resultats[3];
						$autor_biografia=$els_resultats[4];
						}	
		
		
				$MYSQL_ERRNO=mysql_errno($link_ID);
				$MYSQL_ERROR=mysql_error($link_ID);
				
				if (!empty($MYSQL_ERROR)){
							echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
					}								
?>		

<center>	<table bgcolor="ffffaa" width="85%" class="normal_table">
		<TR>
			<TD><B>Nom: </B> <?php echo $autor_nom ?></TD>
			<TD><B>Cognoms:</B> <?php echo $autor_cognoms ?></TD>
			<TD><B>Llengua:</B> <?php echo $autor_llengua ?></TD>
		</TR>
		<TR>
			<TD colspan=3 class="normal">					<B>Biografia:</B>				<BR><?php echo $autor_biografia?>			</TD>
		</TR>	</table>		
</center>	
<BR>

<?php
		
		$my_query="SELECT titol_ID, titol_nom,idioma_nom FROM titols, idiomes WHERE titol_idioma_ID=idioma_ID and titol_autor_ID=".$autor_ID." ORDER BY titol_nom";							
		$resultats=mysql_query($my_query, $link_ID);			
		$num_entrades=mysql_num_rows($resultats);
		$numero_pagines=ceil($num_entrades/$tamany_pagina);


?>

<p class="normal">Hi han <B><?php echo $num_entrades?></B> titols a la base de dades per l'autor/a <?php echo $autor_nom." ".$autor_cognoms ?>. 
	Els trobareu ordenats pel seu <B>titol</B> i distribuits en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 


	

	<center>
	<p class="normal">Pàgina:	
<?php
		for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==1){
				if ($i==$pagina_actual){
					echo $i;}
				else{
					echo "<A HREF=./detalls_autor.php?autor_ID=".$autor_ID."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			else{
				if ($i==$pagina_actual){
					echo " | ".$i;}
				else{
					echo " | ". "<A HREF=./detalls_autor.php?autor_ID=".$autor_ID."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			}		

?>	

	
	
<table bgcolor="ffffff" class="normal_table" width="85%">
	<TR>
		<TD><B>Títol</B></TD>
		<TD><B>Llengua:</B></TD>		<TD></TD>
	</TR>
<?php

	$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
	$my_query=$my_query.$limit_query;
	$resultats=mysql_query($my_query, $link_ID);



	$color_flag=2;
		while ($els_resultats=mysql_fetch_row($resultats)){
						
			if ($color_flag==1){				
					echo "<TR>";
					$color_flag=2;
					}
			else{	
					echo "<TR bgcolor=\"ffffaa\">";
					$color_flag=1;
					}

		echo "	<TD>";
		echo 	$els_resultats[1];
		echo "	</TD>";
		
		echo "	<TD>";
		echo 	$els_resultats[2];
		echo "	</TD>";
	
		echo "	<TD valign=middle align=center>";		echo "		<FORM action=\"detalls_titol.php\" method=POST id=form1 name=form1>";
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";
		echo "				<INPUT type=\"hidden\" value=\"". $autor_nom."\"  name=\"autor_nom\">";		echo "				<INPUT type=\"hidden\" value=\"". $autor_cognoms."\"  name=\"autor_cognoms\">";		
				echo "				<INPUT class=\"petit\" type=\"submit\" value=\"Detalls del títol\" id=submit1 name=submit1>";
		echo "		</FORM>";					
		echo "	</TD>";			
		echo "</TR>";
		}
?>	</table>		

</center>

<?php
	include("peu.txt");
?>
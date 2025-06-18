<?php

//$host = 'mysql';
//$user = 'root';
//$pass = 'rootpassword';
//$conn = new mysqli($host, $user, $pass);

//$link_ID=mysqli_connect ('mysql', 'root', 'rootpassword','casalcat_casalbiblioteca');


//mysql_select_db ('casalcat_casalbiblioteca');
//$tamany_pagina=10;
//$paginacio=5;
		
include("common_variables.php");


	$my_query='SELECT titol_ID,titol_nom,autor_nom,autor_cognoms,idioma_nom,autor_ID from titols,autors,idiomes where titol_autor_ID=autor_ID and titol_idioma_ID=idioma_ID ORDER BY titol_nom';	
	
	mysqli_query($link_ID,"SET NAMES 'utf8'");
	$resultats=mysqli_query( $link_ID,$my_query);			
	$num_entrades=mysqli_num_rows($resultats);
	$numero_pagines=ceil($num_entrades/$tamany_pagina);

	if (strlen($_GET['pagina_actual'])<1){
		$pagina_actual=1;
		}
	else {
		$pagina_actual=$_GET['pagina_actual'];
		}
	


	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera.txt");

?>	

	<p>Hi han <B><?php echo $num_entrades?></B> títols a la base de dades. Els trobareu
	ordenats pel seu <B>titol</B> i distribuïts en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 


	
	<center class="normal">	
	
	<P>Pàgina:	
<?php
	if ($pagina_actual-$paginacio>=1  and $pagina_actual+$paginacio<$numero_pagines){
		echo  "<A HREF=./tots_titols.php?pagina_actual=1>"."<<"."</A>"." | ";

		for ($i=$pagina_actual-$paginacio;$i<=$pagina_actual+$paginacio;$i++){

			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>"." | ";
			}
			else {echo " | ". "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>";}	
		}	
		echo  " | "."<A HREF=./tots_titols.php?pagina_actual=$numero_pagines>".">>"."</A>";
	}
	
	elseif ($pagina_actual-$paginacio<1 and $pagina_actual+$paginacio>$numero_pagines){
		for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>"." | ";
			}
			else {echo " | ". "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>";}	
		}	
	
	}
	elseif ($pagina_actual-$paginacio<1 and $pagina_actual+$paginacio<$numero_pagines+1){
		for ($i=1;$i<=$pagina_actual+$paginacio;$i++){
			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>"." | ";
			}
			else {echo " | ". "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>";}	
		}	
		echo  " | "."<A HREF=./tots_titols.php?pagina_actual=$numero_pagines>".">>"."</A>";
	}
	else{
		echo  "<A HREF=./tots_titols.php?pagina_actual=1>"."<<"."</A>"." | ";
		for ($i=$pagina_actual-$paginacio;$i<=$numero_pagines;$i++){
			
			if ($i==$pagina_actual){
				echo $i;
			}
			elseif($i<$pagina_actual){
					echo  "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>"." | ";
			}
			else {echo " | ". "<A HREF=./tots_titols.php?pagina_actual=".$i.">".$i."</A>";}
				
		}

	}
	

?>	
<table width="85%" border="1"> 
	<TR class="normal_table">
		<TD width=30%><B>Titol</B></td>
		<TD width=25%><B>Autor/a</B></td>
		<TD width=10%><B>Llengua</B></td>
		<TD colspan=2><B>Detalls</b></td>

	</TR>
		
	<?php
		$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
		$my_query=$my_query.$limit_query;
	

	$resultats=mysqli_query($link_ID,$my_query);


	$color_flag=1;	
	while ($els_resultats=mysqli_fetch_row($resultats)){	
						
		if ($color_flag==1){				
			echo "<TR bgcolor=\"ffffaa\" class=\"normal\">";
			$color_flag=2;
			}
		else{	
			echo "<TR class=\"normal\">";
			$color_flag=1;
			}
							
		echo "	<TD>". $els_resultats[1]. "</td>";
		echo "	<TD>". $els_resultats[2]. " ".$els_resultats[3]."</td>";
		echo "	<TD>". $els_resultats[4]. "</td>";
		
		echo "	<TD align=center>";
		echo "		<FORM action=\"detalls_titol.php\" method=POST id=form1 name=form1>";
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";
		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_nom\">";		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[3]."\"  name=\"autor_cognoms\">";		
		echo "				<INPUT class=\"petit\" type=\"submit\" value=\"Del títol\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";
						
		echo "	<TD  align=center valign=center>";
		echo "		<FORM action=\"detalls_autor.php\" method=POST id=form1 name=form1>";
						
		echo "				<INPUT type=\"hidden\" value=1 name=\"pagina_actual\">";											
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[5]."\"  name=\"autor_ID\">";		echo "				<INPUT class=\"petit\"  type=\"submit\" value=\"De l'autor\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";

		echo "</TR>";
			
		} //end while	
		
		
		$mysqli_error=mysqli_errno($link_ID);
		$MYSQL_ERROR=mysqli_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){
			echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
		}
				
?>	
	
	</TABLE>		
</center>

<?php
	include("peu.txt");
?>
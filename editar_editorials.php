<?php
	session_start();

	$validacio=$HTTP_GET_VARS['validacio'];



	if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} 



	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera2.txt");
		
	include("common_variables.php");
		$query_string="SELECT * from editorials WHERE editorial_ID=".$HTTP_GET_VARS['editorial_ID'];			
	$resultats=mysql_query($query_string, $link_ID);
		
	while ($els_resultats=mysql_fetch_row($resultats)){
			$editorial_nom=$els_resultats[1];
			$editorial_colleccio=$els_resultats[2];
			$editorial_adreca=$els_resultats[3];
			$editorial_extra=$els_resultats[4];
			}	
		
		
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
			}		
?>		


	<p>En aquesta pàgina podeu editar o esborrar aquesta editorial. Per <B>Editar</B> els 
	valors, premeu el botó <I>Editar</I>. per <B>Esborrar</B> aquesta editorials de 
	la base de dades premeu el boto <i>Esborrar</I></P>
	
	<table bgcolor="ffffaa" class="normal">
<TR>		<FORM action="editar_editorials2.php" method=POST id=form1 name=form1>

	<TD>
		<B>Nom de l'editorial  </B> <font size=-2>(requerit)</font>: 		<BR><INPUT type="text" id=text1 name="editorial_nom" size=30 value="<?php echo $editorial_nom ?>">	</TD>
	<TD>		<B>Col.lecció:</B>&nbsp;&nbsp; &nbsp;&nbsp;		<BR><INPUT type="text" name="editorial_colleccio" size=30 value="<?php echo $editorial_colleccio ?>">	</TD>
</TR><TR>
	<TD>			<B>Adreça:</B>		<BR>
		<TEXTAREA rows=5 cols=30 id=textarea1 name="editorial_adreca"><?php echo $editorial_adreca ?></TEXTAREA>		</TD>
	<TD>			<B>Altre Informació:</B>		<BR>
		<TEXTAREA rows=5 cols=30 id=textarea1 name=editorial_extra><?php echo $editorial_extra?></TEXTAREA>	</TD>

</TR>
<TR bgcolor="FFFFFF">	
	<TD colspan=2>&nbsp;	<TD>
</TR>
<TR>
	<TD valing=bottom>			<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="editorial_ID" value="<?php echo $HTTP_GET_VARS['editorial_ID']?>" >

		<INPUT type="submit" value="Editar" id=submit1 name=submit1>
	</TD>	</FORM>	
	<TD valing=bottom>	<FORM action="esborrar_editorials.php" method=POST id=form1 name=form1>
		
		<INPUT type="hidden" name="editorial_nom" value="<?php echo  $editorial_nom?>" >
		<INPUT type="hidden" name="editorial_colleccio" value="<?php echo  $editorial_colleccio?>" >
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="editorial_ID" value="<?php echo $HTTP_GET_VARS['editorial_ID']?>" >
		<BR>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	
	</TD>
</TR>
</table>




<?php
	include("peu2.txt");
?>
<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];



if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} 


		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		
		
	
	include("common_variables.php");
	
		$query_string="SELECT autor_ID,autor_nom,autor_cognoms,idioma_nom,autor_biografia FROM autors,idiomes WHERE autor_id=".$HTTP_POST_VARS['autor_ID']. " AND autor_idioma_ID=idioma_ID";			

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


	<p>En aquesta pàgina podeu editar o esborrar aquest autor
	
	
<P>Per editar el contingut, modifiqueu les entrades, i després premeu <I>Entrar</I>	
<FORM action="editar_autor2.php" method=POST id=form1 name=form1>

<table bgcolor="ffffaa">
<TR>
	<TD><B>Nom: </B> <font size=-2>(requerit)</font>: <INPUT type="text" id=text1 name="autor_nom" size=30 value="<?php echo $autor_nom ?>"></TD>
	<TD><B>Cognoms:</B>&nbsp;&nbsp; &nbsp;&nbsp;<INPUT type="text" name="autor_cognoms" size=30 value="<?php echo $autor_cognoms ?>"></TD>
</TR>
<TR>
	<TD colspan=2>		<B>Biografia:</B>		<BR><TEXTAREA rows=8 cols=80 id=textarea1 name=autor_biografia><?php echo $autor_biografia?></TEXTAREA>		</TD>
</TR>
<TR>
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="autor_ID" value="<?php echo $HTTP_POST_VARS['autor_ID']?>" >
		<INPUT type="hidden" name="pagina_actual" value="<?php echo $pagina_actual ?>">			<TD><B>Llengua:</B>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
			<SELECT id=select1 name="autor_idioma_ID">
			<?php			$query_string="SELECT * FROM idiomes order by idioma_nom";			

				$resultats=mysql_query($query_string, $link_ID);
					
							while ($els_resultats2=mysql_fetch_row($resultats)){
									if ($els_resultats2[1]==$autor_llengua){
								        echo "<OPTION selected value=".$els_resultats2[0].">". $els_resultats2[1]. "</OPTION>";
									}	
									else{
								      echo "<OPTION value=".$els_resultats2[0].">". $els_resultats2[1]. "</OPTION>";
									}
							} //end while
							$MYSQL_ERRNO=mysql_errno($link_ID);
							$MYSQL_ERROR=mysql_error($link_ID);
							
							if (!empty($MYSQL_ERROR)){
										echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
									}		
			?>		
			</SELECT>

	</TD>	<TD align=right>Premeu el botó per salvar les modificacions &nbsp;&nbsp;<INPUT type="submit" value="Salvar" id=submit1 name=submit1></TD>


</TR></table>		
		
</FORM>	



<?php
include("peu2.txt");
?>
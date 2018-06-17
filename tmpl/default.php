<?php 
// No direct access
defined('_JEXEC') or die; ?>

<?php
// HTML-Output
// ------------
$output = '';
?>

<div>    
	<div class="table-responsive">  
		<div class="col-md-12" align="right">
	    	<form id="form_PDF" method="post" action="modules/mod_userlist/userlist_PDF.php ">
	        	<input type="submit" name="generate_pdf" class="btn btn-success" formtarget="_blank" value="PDF Download">  
	     	</form>  
	    </div>
	    <br/>
	    <br/>
<?php

// Create Table-Header
$output .= '<table class="table table-bordered">
	        	<tr>
	               	<th width="20%">Name</th>
	                <th width="10%">Benutzer</th> 
	                <th width="20%">E-Mail</th>
	                <th width="5%">Frei-gegeben</th>   
	                <th width="5%">Aktiviert</th>
	                <th width="20%">Letzter Besuch</th>
	                <th width="20%">Register-Datum</th> 
	        	</tr>';

// Create Table out of fetched Data from Database
foreach ($items as $key => $entry) {
	$output .= '<tr>
					<td>'.$items[$key]['name'].'</td>
					<td>'.$items[$key]['username'].'</td>
					<td>'.$items[$key]['email'].'</td>
					<td>'.$items[$key]['block'].'</td>
					<td>'.$items[$key]['activation'].'</td>
					<td>'.$items[$key]['lastvisitDate'].'</td>
					<td>'.$items[$key]['registerDate'].'</td>
				</tr>';
}
?>

			<?php echo $output; ?>
		</table>
		<textarea form="form_PDF" name="html_table" readonly style="display: none;">
			<?php echo $output; ?>
		</textarea>
	</div>
</div>

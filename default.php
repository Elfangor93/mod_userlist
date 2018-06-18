<?php 
// No direct access
defined('_JEXEC') or die; ?>

<?php
// HTML-Output
// ------------
$output = '';
$url = JUri::base() . 'modules/mod_userlist/userlist_PDF.php';
?>

<div>    
	<div class="table-responsive">  
		<div class="col-md-12" align="right">
	    	<form id="form_PDF" method="post" action="<?php echo $url;?>">
	        	<input type="submit" name="generate_pdf" class="btn btn-success" formtarget="_blank" value="PDF Download">  
	     	</form>  
	    </div>
	    <br/>
	    <br/>
<?php

// define Table-Style
$output .= '<style>
				table {
				    font-family: arial, sans-serif;
				    border: 2px solid #000000;
				    border-collapse: collapse;
				    width: 100%;
				}

				td, th {
				    border: 1px solid #000000;
				    text-align: left;
				    padding: 8px;
				}

				tr:nth-child(even) {
				    background-color: #dddddd;
				}

				.table_heading {
					font-weight: bold;
					border: 2px solid #000000;
				}
		    </style>';

// Create Table-Header
$output .= '<table border="1">
	        	<tr class="table_heading">
	               	<th width="15%">Name</th>
	                <th width="10%">Benutzer</th> 
	                <th width="25%">E-Mail</th>
	                <th width="10%">Frei-gegeben</th>   
	                <th width="10%">Aktiviert</th>
	                <th width="15%">Letzter Besuch</th>
	                <th width="15%">Register-Datum</th> 
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

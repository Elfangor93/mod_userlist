<?php 
// No direct access
defined('_JEXEC') or die; ?>

<?php
// HTML-Output
// ------------
$output = '';
$url = JUri::base() . 'modules/mod_userlist/userlist_PDF.php';
?>

<style>
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
</style>

<div>    
	<div class="table-responsive">  
		<div class="col-md-12" align="right">
	    	<form id="form_PDF" method="post" action="">
	        	<input type="submit" name="generate_pdf" class="btn btn-success" value="PDF Download">  
	     	</form>  
	    </div>
	    <br/>
	    <br/>
	    <table border="1">
        	<tr class="table_heading">
               	<th width="20%">Name</th>
                <th width="15%">Benutzer</th> 
                <th width="25%">E-Mail</th>
                <th width="10%">Aktiviert</th>   
                <th width="15%">Letzter Besuch</th>
                <th width="15%">Register-Datum</th> 
        	</tr>

<?php
// Create Table out of fetched Data from Database
foreach ($items as $key => $entry) {
	$output .= '<tr>
					<td>'.$items[$key]['name'].'</td>
					<td>'.$items[$key]['username'].'</td>
					<td>'.$items[$key]['email'].'</td>
					<td>'.!$items[$key]['block'].'</td>
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

<script>
jQuery(document).ready(function(){

	jQuery("#form_PDF").submit(function(event) {
	    event.preventDefault();

		var formData = new FormData(document.getElementById('form_PDF'));
		//formData.append('name', 'value');

		var xhr=new XMLHttpRequest();
		xhr.open("POST", "<?php echo $url;?>", true);
		xhr.responseType = 'blob';

		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var blob = xhr.response;
			    var link = document.createElement('a');
			    document.body.appendChild(link);
			    link.href = URL.createObjectURL(blob);
			    link.download="Benutzerliste.pdf";
				link.style = "display: none";
			    link.click();
			} else if (this.status == 403) {
				alert("Antwort vom Server: 403 - Access denied");
			} else {
				console.log(this.readyState);
				console.log(this.status);
			}
		};
		xhr.send(formData);
	});
});
</script>
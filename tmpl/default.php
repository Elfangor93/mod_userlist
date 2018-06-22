<?php
/**
 * VIEW of the Userlist-Module
 * 
 * @package    Userlist
 * @subpackage mod_userlist
 * @version    1.1.0
 *
 * @author     Manuel Haeusler <tech.spuur@quickline.com>
 * @copyright  2018 Manuel Haeusler
 * @license    GNU/GPL, see LICENSE.php
 *
 * mod_userlist is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

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
	        	<input type="submit" name="generate_pdf" class="btn btn-success" value="<?php echo JText::_('MOD_USERLIST_VIEW_BUTTON');?>">  
	     	</form>  
	    </div>
	    <br/>
	    <br/>
	    <table border="1">
        	<tr class="table_heading">
               	<th width="20%"><?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_NAME');?></th>
                <th width="15%"><?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_USERNAME');?></th> 
                <th width="25%"><?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_EMAIL');?></th>
                <th width="10%"><?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_ENABLED');?></th>   
                <th width="15%"><?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_LASTVISIT');?></th>
                <th width="15%"><?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_REGISTERDATE');?></th> 
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
		formData.append('table_heading_name', '<?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_NAME');?>');
		formData.append('table_heading_username', '<?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_USERNAME');?>');
		formData.append('table_heading_email', '<?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_EMAIL');?>');
		formData.append('table_heading_enabled', '<?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_ENABLED');?>');
		formData.append('table_heading_lastvisit', '<?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_LASTVISIT');?>');
		formData.append('table_heading_registerdate', '<?php echo JText::_('MOD_USERLIST_VIEW_TABLEHEADING_REGISTERDATE');?>');
		formData.append('print_date', '<?php echo JText::_('MOD_USERLIST_PDF_PRINTDATE');?>');

		var xhr=new XMLHttpRequest();
		xhr.open("POST", "<?php echo $url;?>", true);
		xhr.responseType = 'blob';

		xhr.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var blob = xhr.response;
			    var link = document.createElement('a');
			    document.body.appendChild(link);
			    link.href = URL.createObjectURL(blob);
			    link.download="<?php echo JText::_('MOD_USERLIST');?>.pdf";
				link.style = "display: none";
			    link.click();
			} else if (this.status == 403) {
				alert("Response from server: 403 - Access denied");
			}
		};
		xhr.send(formData);
	});
});
</script>
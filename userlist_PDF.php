<?php
/**
 * PDF generation script of the Userlist-Module
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

// If Button PDF-Download is clicked: generate PDF
if(isset($_POST["html_table"]))  { 
      
      //load Data from Form submit
      $output = $_POST["html_table"];
      $print_date = $_POST["print_date"];
      //generate PDF
      require_once('TCPDF/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Liste aller Joomla-Benutzer");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
      $obj_pdf->SetFooterData(array(0,64,0), array(0,64,128));  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage('L', 'A4');

      // Create HTML content 
      $content = '<h1>registrierte Benutzer:</h1><br />';
      $content .= '<table>
                    <tr class="table_heading" style="font-weight: bold;">
                        <th width="19%">'.$_POST["table_heading_name"].'</th>
                        <th width="19%">'.$_POST["table_heading_username"].'</th> 
                        <th width="25%">'.$_POST["table_heading_email"].'</th>
                        <th width="7%">'.$_POST["table_heading_enabled"].'</th>   
                        <th width="15%">'.$_POST["table_heading_lastvisit"].'</th>
                        <th width="15%">'.$_POST["table_heading_registerdate"].'</th> 
                    </tr>
                    <tr>
                        <th></th>
                        <th></th> 
                        <th></th>
                        <th></th>   
                        <th></th>
                        <th></th> 
                    </tr>';
      $content .= $output;
      $content .= '<br /><p>'.$print_date.' '.date("d.m.Y, H:i \U\H\R").'</p>';

      //paste content into the PDF 
      //$obj_pdf->setCellHeightRatio(1.25);
      $obj_pdf->writeHTML($content, true, false, true, false, '');
      //output the PDF
      ob_end_clean(); 
      $obj_pdf->Output('userlist.pdf', 'I');
} else {
  echo '<div class="alert alert-danger"><p>This page is only available if it is called from the Joomla module ("Userlist").</p></div><br />';
}

?>
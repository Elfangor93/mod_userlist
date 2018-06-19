<?php

// If Button PDF-Download is clicked: generate PDF
if(isset($_POST["html_table"]))  { 
      //load Table from Form submit
      $output = $_POST["html_table"];
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
      $content .= '<table border="1">
                    <tr class="table_heading">
                          <th width="15%">Name</th>
                          <th width="10%">Benutzer</th> 
                          <th width="25%">E-Mail</th>
                          <th width="10%">Frei-gegeben</th>   
                          <th width="10%">Aktiviert</th>
                          <th width="15%">Letzter Besuch</th>
                          <th width="15%">Register-Datum</th> 
                    </tr>';
      $content .= $output;
      $content .= '<br /><p>Druckdatum: '.date("d.m.Y, H:i \U\H\R").'</p>';

      //paste content into the PDF 
      $obj_pdf->setCellHeightRatio(1.25);
      $obj_pdf->writeHTML($content, true, false, true, false, '');
      //output the PDF
      ob_end_clean(); 
      $obj_pdf->Output('Benutzerliste.pdf', 'I');
//  echo '<div class="alert alert-success"><p>PDF erfolgreich generiert</p></div><br />';
} else {
  echo '<div class="alert alert-danger"><p>Diese Seite ist nur verfügbar, wenn sie aus dem Joomla-Modul ("Userlist") aufgerufen wird.</p></div><br />';
}

?>
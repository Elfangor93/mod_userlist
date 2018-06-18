<!DOCTYPE html>
<html lang="de">
<head>
  <title>PDF download-page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
    body {
      padding: 20px;
      max-width: 950px !important;
    }
  </style>
</head>
<body>
  <h1>PDF Download-Seite</h1><br />

  <?php
    // If Button PDF-Download is clicked: load Table
    if(isset($_POST["generate_pdf"]))  {
          $output = $_POST["html_table"];
    }
    
    // If Button PDF-Download is clicked: generate PDF
    if(isset($_POST["generate_pdf"]))  {  
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
          $content = '<h1>registrierte Benutzer:</h1><br /><br /><br />';
          $content .= $output; 
          $content .= '<br /><p>Druckdatum: '.date("d.m.Y, H:i \U\H\R").'</p>';
          $obj_pdf->setCellHeightRatio(1.25);
          $obj_pdf->writeHTML($content, true, false, true, false, '');
          ob_end_clean(); 
          $obj_pdf->Output('Benutzerliste.pdf', 'I');
      echo '<div class="alert alert-success"><p>PDF erfolgreich generiert</p></div><br />';
    } else {
      echo '<div class="alert alert-danger"><p>Uups.. Da hat etwas nicht geklappt</p></div><br />';
    }

    // If Button PDF-Download is clicked: Erstelle HTML
    if(isset($_POST["generate_pdf"]))  {
      echo '<h2>Tabelle:</h2><br />';
      echo $output;
    } else {
      echo 'Diese Seite ist nur verfügbar, wenn sie aus dem Joomla-Modul ("Userlist") aufgerufen wird.';
    }
  ?>
  <br />
  <a href="<?php echo JUri::base();?>" class="btn btn-primary">Zurück</a>
</body>
</html>  
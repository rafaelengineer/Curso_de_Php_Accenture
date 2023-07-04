<?php

// reference the Dompdf namespace
use Dompdf\Dompdf;

function gerarPdf(string $html, string $nomeArquivo = 'document.pdf', $buffer=false) {

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml(html_entity_decode($html));

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    if (!$buffer) {
        $pdf = $dompdf->output();
        unset($pdf);
        ob_end_clean();
    }
    
    // Output the generated PDF to Browser
    $dompdf->stream($nomeArquivo, ['Attachment'=>1]);
}
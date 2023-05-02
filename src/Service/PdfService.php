<?php

namespace App\Service;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService{

    private $domPdf;

    public function __construct(){
        $this->domPdf = new DomPdf();

        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $this->domPdf->setOptions($options);
    }

    public function showPdfFile($html) {
        $this->domPdf->loadHtml($html);
        $this->domPdf->setPaper('A4', 'landscape');
        $this->domPdf->render();
        ob_get_clean();
        $this->domPdf->stream("details.pdf", [
            'Attachment' => 0
        ]);
        // $this->dompdf->clear();
        // exit(0);
    }

    public function generateBinaryPdf($html){
        $this->domPdf->loadHtml($html);
        $this->domPdf->setPaper('A4', 'landscape');
        $this->domPdf->render();
        $this->domPdf->output();
    }
}
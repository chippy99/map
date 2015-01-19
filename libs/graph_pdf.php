<?php
require_once('tcpdf/tcpdf.php');
class MYPDF2 extends TCPDF {

    public function Header() {
        // Logo
        $image_file = 'images/logo.png';
        $this->Image($image_file, 17, 10, '', '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, 'Meta-LUCID Ltd', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Copyright Meta-LUCID Ltd ' . date('Y') , 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

function make_pdf_graph($name) {
    

    $pdf = new MYPDF2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    if ($score < 25)
        {
            $pg = "F5";
        }
    elseif ($score >= 25 and $score <= 33)
        {
            $pg = "F4";
        }
    elseif ($score >= 34 and $score <= 42)
        {
            $pg = "F3";

        }
    elseif ($score >= 43 and $score <= 50)
        {
            $pg = "F2";
        }
    elseif ($score >= 51 and $score <= 59)
        {
            $pg = "F1";
        }
    elseif ($score >= 60 and $score <= 68)
        {
            $pg = "G1";
        }
    elseif ($score >= 69 and $score <= 77)
        {
            $pg = "G2";
        }
    elseif ($score >= 78 and $score <= 86)
        {
            $pg = "G3";
        }
    elseif ($score >= 87 and $score <= 95)
        {
            $pg = "G4";
        }
    elseif ($score >= 96)
        {
            $pg = "G5";
        }

    $beliefs = array("You strongly believe that intelligence is fixed - it does not change much. If you can't perform perfectly you would rather not do something. You think smart people don't have to work hard.",
                     "You lean towards thinking that your intelligence does not change much. You prefer not to make mistakes if you can help it and you also don't really like to put in a lot of work. You may think that learning should be easy.",
                     "You have not really decided for sure whether you can change your intelligence. You care about results and you also want to learn, but you don't really want to have to work too hard for it.",
                     "You believe that your intelligence is something that you can increase. You care about learning and you are willing to work hard. You do want to do well, but you think it is more important to learn than to always achieve high results.",
                     "You feel sure that you can increase your intelligence by learning and you like a challenge. You believe that the best way to learn is to work hard, and you don't mind making mistakes while you do it."
                     );

    // set document information

    $pdf->SetCreator('MetaLucid');

    $pdf->SetAuthor('John Carpenter');

    $pdf->SetTitle('MAP');

    $pdf->SetSubject('');

    $pdf->SetKeywords('');
    

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set cell padding
    $pdf->setCellPaddings(1, 1, 1, 1);

    // set cell margins
    $pdf->setCellMargins(0, 0, 0, 0);

    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(20);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->AddPage('L');

    $ncol = 30;
    $wcol = 90;
    $txt = "Name: " . $name . "\nDate: " .  date('jS F Y') . "\nMAP Profile Group: " . $pg . "\nProfile Number: " . $score; 

    $pdf->Ln(18);
   $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(160,160,160), 'opacity'=>1, 'blend_mode'=>'Normal'));
    $pdf->Write(0, 'Mindset Assessment Profile', '', 0, 'L', true, 0, false, false, 0);
    $pdf->setTextShadow(array('enabled'=>false));
    $pdf->SetFont('helvetica', 'R', 14);
    $pdf->Ln(5);
    //$pdf->SetFont('helvetica', 'B', 12);
    //$pdf->SetFillColor(224,224,224);
    //$pdf->MultiCell(0,0,$txt,1,'L',true,1);
    //$pdf->Ln(10);
    

    $pdf->SetFont('helvetica', 'B', 8);
   
    
    $pdf->MultiCell(36, 18, 'Your profile number falls into this range', 1, 'C', true, 0, '', '', true ,0,false, true,18,'M');
    $pdf->MultiCell(40, 18, 'Your Mindset Assessment Profile (MAP) group', 1, 'C', true, 0,'', '', true, 0, false, true, 18, 'M');
    $pdf->MultiCell(0, 18, 'People in this MAP group usually believe the following things', 1, 'C', true, 1, '', '', true, 0, false, true, 18, 'M');

    
    $h = 10;
    $pdf->SetFont('helvetica', 'R', 8);
    $pdf->MultiCell(36, $h, '16 - 24', 1, 'C', false, 0, '', '', true ,0,false, true,$h,'M');
    $y = $pdf->GetY();
    $pdf->SetFillColor(228,108,10);
    $pdf->MultiCell(40, $h, 'F5', 1, 'C', true, 0,'', '', true, 0, false, true, $h, 'M');
    $pdf->MultiCell(0, $h*2, $beliefs[0], 1, 'L', false, 1, '', '', true, 0, false, true, $h*2, 'M');

    $pdf->MultiCell(36, $h, '25 - 33', 1, 'C', false, 0, '', $y + $h, true ,0,false, true,$h,'M');
    $pdf->SetFillColor(255,153,0);
    $pdf->MultiCell(40, $h, 'F4', 1, 'C', true, 1,'', '', true, 0, false, true, $h, 'M');


    
    $pdf->MultiCell(36, $h, '34 - 42', 1, 'C', false, 0, '', '', true ,0,false, true,$h,'M');
    $y = $pdf->GetY();
    $pdf->SetFillColor(255,192,0);
    $pdf->MultiCell(40, $h, 'F3', 1, 'C', true, 0,'', '', true, 0, false, true, $h, 'M');
    $pdf->MultiCell(0, $h*2, $beliefs[1], 1, 'L', false, 1, '', '', true, 0, false, true, $h*2, 'M');

    $pdf->MultiCell(36, $h, '43 - 50', 1, 'C', false, 0, '', $y + $h, true ,0,false, true,$h,'M');
    $pdf->SetFillColor(255,255,0);
    $pdf->MultiCell(40, $h, 'F2', 1, 'C', true, 1,'', '', true, 0, false, true, $h, 'M');

    
    $pdf->MultiCell(36, $h, '51 - 59', 1, 'C', false, 0, '', '', true ,0,false, true,$h,'M');
    $y = $pdf->GetY();
    $pdf->SetFillColor(0,230,104);
    $pdf->MultiCell(40, $h, 'F1', 1, 'C', true, 0,'', '', true, 0, false, true, $h, 'M');
    $pdf->MultiCell(0, $h*2, $beliefs[2], 1, 'L', false, 1, '', '', true, 0, false, true, $h*2, 'M');

    $pdf->MultiCell(36, $h, '60 - 68', 1, 'C', false, 0, '', $y + $h, true ,0,false, true,$h,'M');
    $pdf->SetFillColor(146,208,89);
    $pdf->MultiCell(40, $h, 'G1', 1, 'C', true, 1,'', '', true, 0, false, true, $h, 'M');


   
    $pdf->MultiCell(36, $h, '69 - 77', 1, 'C', false, 0, '', '', true ,0,false, true,$h,'M');
    $y = $pdf->GetY();
    $pdf->SetFillColor(155,187,89);
    $pdf->MultiCell(40, $h, 'G2', 1, 'C', true, 0,'', '', true, 0, false, true, $h, 'M');
    $pdf->MultiCell(0, $h*2, $beliefs[3], 1, 'L', false, 1, '', '', true, 0, false, true, $h*2, 'M');

    $pdf->MultiCell(36, $h, '78 - 86', 1, 'C', false, 0, '', $y + $h, true ,0,false, true,$h,'M');
    $pdf->SetFillColor(0,176,240);
    $pdf->MultiCell(40, $h, 'G3', 1, 'C', true, 1,'', '', true, 0, false, true, $h, 'M');
   
   
    
    $pdf->MultiCell(36, $h, '87 - 95', 1, 'C', false, 0, '', '', true ,0,false, true,$h,'M');
    $y = $pdf->GetY();
    $pdf->SetFillColor(0,112,192);
    $pdf->MultiCell(40, $h, 'G4', 1, 'C', true, 0,'', '', true, 0, false, true, $h, 'M');
    $pdf->MultiCell(0, $h*2, $beliefs[4], 1, 'L', false, 1, '', '', true, 0, false, true, $h*2, 'M');

    $pdf->MultiCell(36, $h, '96 - 104', 1, 'C', false, 0, '', $y + $h, true ,0,false, true,$h,'M');
    $pdf->SetFillColor(0,32,96);
    $pdf->SetTextColor(255,255,255);
    $pdf->MultiCell(40, $h, 'G5', 1, 'C', true, 1,'', '', true, 0, false, true, $h, 'M');
   
    $pdf->SetTextColor(0,0,0);
    //$pdf->Output('reports/rep_' . $rep_id . '.pdf', 'I');
    $content = $pdf->Output("", "S");
    //header("Content-Length: ".strlen($content));
    //header("Content-type: application/pdf");
    return $content;

}
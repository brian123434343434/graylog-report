<?php

require('datos.php');
include("mpdf/mpdf.php");
$mpdf = new mPDF();
$html=stats::newReg();

$mpdf->SetWatermarkText("Confidencial"); //Marca de agua

$mpdf->showWatermarkText = true; // activar/Desactiuvar marca de agua (True/false)

$mpdf->watermarkTextAlpha = 0.1;
$mpdf->setFooter('{PAGENO}');

$mpdf->SetHTMLHeader('
<div style="text-align: right; font-weight: bold;">
    Informe 
</div>');
$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="25%">{DATE j-m-Y}</td>
        <td width="25%" align="center">{PAGENO}/{nbpg}</td>
        <td width="25%" style="text-align: right;">Informe Mensual</td>
        <td width="25%" style="text-align: right;"><img src="logo13.png" 
         /></td>
    </tr>
</table>');

$html1='

<style>


/* For Table of Contents */
div.mpdf_toc {
 font-family: sans-serif;
 font-size: 11pt;
}
a.mpdf_toc_a {
 text-decoration: none;
 color: black;
}
/* Whole line level 0 */
div.mpdf_toc_level_0 {
 line-height: 1.5;
 margin-left: 0;
 padding-right: 2em;
}
/* Title level 0 - may be inside <a> */
span.mpdf_toc_t_level_0 {
 font-weight: bold;
}
/* Page no. level 0 - may be inside <a> */
span.mpdf_toc_p_level_0 { }
/* Whole line level 1 */
div.mpdf_toc_level_1 {
 margin-left: 2em;
 padding-right: 2em;
}
/* Title level 1 */
span.mpdf_toc_t_level_1 {
 font-style: italic;
 font-weight: bold;
}
/* Page no. level 1 - may be inside <a> */
span.mpdf_toc_p_level_1 { }
/* Whole line level 2 */
div.mpdf_toc_level_2 {
 margin-left: 4em;
 padding-right: 2em;
}
/* Title level 2 */
span.mpdf_toc_t_level_2 { }
/* Page no. level 2 - may be inside <a> */
span.mpdf_toc_p_level_2 { }


</style>

                <div class="mpdf_toc" id="mpdf_toc_0">
                <div class="mpdf_toc_level_0">
                <a class="mpdf_toc_a" href="#__mpdfinternallink_1">
                <span class="mpdf_toc_t_level_0">Section 1</span>
                </a>
                <dottab outdent="2em" />
                <a class="mpdf_toc_a" href="#__mpdfinternallink_1">
                <span class="mpdf_toc_p_level_0">5</span>
                </a>
                </div>
                <div class="mpdf_toc_level_1">
                <a class="mpdf_toc_a" href="#__mpdfinternallink_2">
                <span class="mpdf_toc_t_level_1">Chapter 1</span>
                </a>
                <dottab outdent="2em" />
                <a class="mpdf_toc_a" href="#__mpdfinternallink_2">
                <span class="mpdf_toc_p_level_1">6</span>
                </a>
                </div>
                <div class="mpdf_toc_level_2">
                <a class="mpdf_toc_a" href="#__mpdfinternallink_3">
                <span class="mpdf_toc_t_level_2">Topic 1</span>
                </a>
                <dottab outdent="2em" />
                <a class="mpdf_toc_a" href="#__mpdfinternallink_3">
                <span class="mpdf_toc_p_level_2">7</span>
                </a>
                </div>
                </div>
';


$mpdf->WriteHTML($html1);
$mpdf->WriteHTML($html[0]);
$mpdf->Bookmark('Section 1', 0);
$mpdf->WriteHTML('<div>Section 1 text</div>');

$mpdf->Bookmark('Chapter 1', 1);
$mpdf->WriteHTML('<div>Chapter 1 text</div>');

$mpdf->Bookmark('Chapter 2', 1);
$mpdf->WriteHTML('<div>Chapter 2 text</div>');

$mpdf->Bookmark('Section 2', 0);
$mpdf->WriteHTML('<div>Section 2 text</div>');

$mpdf->Bookmark('Chapter 3', 1);
$mpdf->WriteHTML('<div>Chapter 3 text</div>');

$mpdf->Output();
?>

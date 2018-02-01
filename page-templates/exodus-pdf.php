<?php
/*
  Template Name: Exodus PDF
*/

$get_id = get_page_ID_by_page_template('page-templates/exodus.php');
$quotations = get_post_meta($get_id, 'exodus_quotations', TRUE);
$text = get_post_meta($get_id, 'exodus_text', TRUE);

require_once(TEMPLATEPATH."/includes/dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();

$dompdf->set_option('enable_remote', TRUE);

$html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="image/x-icon" href="'.TEMPLATEPATH.'/dist/images/favicon.ico" rel="shortcut icon">
    <meta content="telephone=no" name="format-detection">
    <title>TCM | PDF</title>

</head>
<body>';

$html .= $quotations;
$html .= $text;

$html .= '</body>
</html>';

$dompdf->set_paper('A3','portrait');
$dompdf->load_html($html);
$dompdf->render();

$type = ($_SERVER['QUERY_STRING'] == 'view') ? false : true;
$dompdf->stream("exodus.pdf", array("Attachment" => $type));

exit(0);
?>




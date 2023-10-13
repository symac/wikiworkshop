<?php

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'c',
    'margin_left' => 20,
    'margin_right' => 20,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 0,
    'margin_footer' => 0
]);

$mpdf->SetDisplayMode('fullpage');

$mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list

$table = '<table border="1" cellpadding=1em cellspacing=0 class="bpmTopnTail tallcells" style="width:100%"><tbody><tr>';

$data = $_POST["data"];
$data = html_entity_decode($data);
$data = json_decode($data, true);

$errors = [];
foreach ($data as $row) {
    $errors[] = [
        $row[0], $row[1], $row[2]
    ];
}

$count = 0;
foreach ($errors as $error) {
    if (($count % 2) == 0) {
        $table .= "</tr><tr>";
    }
    $table .= "<td style='width:50%; text-align:center'><strong style='font-size:2em'>" . $error[0] . "</strong><br/>" . $error[1] . " &rarr; " . $error[2] . "</td>";
    $count++;
}

$table .= "</tr></tbody></table>";

// Load a stylesheet
$mpdf->WriteHTML($table);

$mpdf->Output('mpdf.pdf', \Mpdf\Output\Destination::DOWNLOAD);
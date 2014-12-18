<?php
set_include_path( "/home/metaluci/public_html/map/ezcomponents" . PATH_SEPARATOR .  get_include_path());



require 'Base/src/ezc_bootstrap.php';

$graph = new ezcGraphBarChart();
$graph->title = 'Elections 2005 Germany';
$graph->data['2005'] = new ezcGraphArrayDataSet( array(
'CDU' => 35.2,
'SPD' => 34.2,
'FDP' => 9.8,
'Die Gruenen' => 8.1,
'PDS' => 8.7,
'NDP' => 1.6,
'REP' => 0.6,
) );
//$graph->options->label = '%3$.1f%%';
//$graph->options->sum = 100;
//$graph->options->percentThreshold = 0.02;
//$graph->options->summarizeCaption = 'Others';
$graph->renderToOutput( 400, 150 );

?>
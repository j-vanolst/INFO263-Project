<?php
function generate_xml($vehicles)
{
$writer = new XMLWriter();
$writer->openURI('test.xml');
$writer->startDocument('1.0','UTF-8');
$writer->setIndent(true);
$writer->startElement('markers');
foreach ($vehicles as $vehicle)
{
    $writer->startElement('marker');
    $writer->writeAttribute('id', $vehicle->vehicle_id);
    $writer->writeAttribute('lat', $vehicle->latitude);
    $writer->writeAttribute('lng', $vehicle->longitude);
    $writer->writeAttribute('type', 'vehicle');
    $writer->endElement();
};
$writer->endElement();
$writer->endDocument();
$writer->flush();
}
/*function generate_xml($vehicles)
{
    echo '<markers>';
    foreach ($vehicles as $vehicle)
    {
        echo '<marker ';
        echo 'id="' . $vehicle->vehicle_id . '" ';
        echo 'latitude="' . $vehicle->latitude . '" ';
        echo 'longitude="' . $vehicle->longitude . '" ';
        echo 'type="vehicle"';
        echo '/>';
    }
    echo '</markers>';
}
*/?>
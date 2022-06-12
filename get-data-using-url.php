<?php 
$html = file_get_contents('https://www.trustpilot.com/review/rejuvenatehairclinics.com');


$dom = new DOMDocument();
libxml_use_internal_errors(1);
$dom->formatOutput = True;
$dom->loadHTML( $html );
$xpath = new DOMXPath( $dom );

foreach( $xpath->query( '//div[@class="review-body"]' ) as $node )
{
    echo trim( $node->nodeValue ) . '<br><br>';
}


?>
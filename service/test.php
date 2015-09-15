<?php
header('content-type:text/html;charset=gb2312');
$dom = new DOMDocument();
$element = $dom->appendChild(new DOMElement('root'));
$comment = $element->appendChild(new DOMComment('好12'));

echo $dom->save('text.xml');


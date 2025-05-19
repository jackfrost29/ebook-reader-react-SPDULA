<?php
$path=$_SERVER['DOCUMENT_ROOT'];
include_once($path.'/__php/forms.php');
include_once($path.'/__php/book_reader.php');

// echo $path;

// phpinfo();
// imagecreate()

// top screenshot
forms::getNewHeader("resources/ss/header.jpg", "/__css/bundle.css");

/**
 * acc_no stands for accession number
 * list of acc_no that are valid are ----->> [536194, 536195, 536196, 536197, 536198, 536199]
 * these are the books that have been given entry into the DULIS system
 */
BookReader::getDemoBody(536196, "__js/bundle.js", "__js/bundle.js.map");


// bottom screenshot
forms::getDemoTail("resources/ss/footer.png");



?>
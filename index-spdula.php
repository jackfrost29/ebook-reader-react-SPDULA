<?php
/*
 * Created on Dec 18, 2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $path = $_SERVER['DOCUMENT_ROOT'];
 include_once($path.'/sections/common/etc/session.php');
 include_once($path.'/dispatcher/dispatcher.php');
 include_once($path.'/sections/common/etc/MVC.php');
 include_once($path.'/sections/common/default/ui_default.php');
 $session = Session::getInstance();
 $session->init();
 if(isset($_REQUEST['id_lang']) && $_REQUEST['id_lang']=="en_US"){
        $_SESSION['lang']="en_US";
 }
 if(isset($_REQUEST['id_lang']) && $_REQUEST['id_lang']=="bn_BD"){
        $_SESSION['lang']="bn_BD";
 }
 if(!isset($_SESSION['lang'])){
        $_SESSION['lang']="en_US";
 }
 if(isset($_POST['_width']) &&  isset($_POST['_height'])){
 	setWidthHeight();
 	return;
 }
//print_r($_REQUEST);
/** this block below is injected to handle page fetch */
/*if ($_REQUEST["id"] == "get-pdf-page") {
       file_put_contents($path . 'log/log.json', json_encode($_REQUEST));
       $acc_no = $_REQUEST['acc_no'];
       $page_no = $_REQUEST['page_no'];

       BookReader::set_page_for_fetch($acc_no);

       // $file = '../image.jpg';
       $file_path = '/tmp/book_reader/pages/' . $acc_no . '/' . $page_no . '.jpg';
       $type = 'image/jpeg';
       header('Content-Type:' . $type);
       header('Content-Length: ' . filesize($file_path));
       readfile($file_path);
}*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if ($_REQUEST['id'] == "get-pdf-page") {
              file_put_contents($path . 'log/log.json', json_encode($_REQUEST));
              $acc_no = $_REQUEST['acc_no'];
              $page_no = $_REQUEST['page_no'];

              BookReader::set_page_for_fetch($acc_no);

              // $file = '../image.jpg';
	$file_path = '/var/libdata/tmp/book_reader/pages/' . $acc_no . '/' . $page_no . '.jpg';
              $type = 'image/jpeg';
              header('Content-Type:' . $type);
              header('Content-Length: ' . filesize($file_path));
              readfile($file_path);
	      return;	
       }
}


/** this block above is injected to handle page fetch */
if(isset($_REQUEST['eBook']))
{
	ui_default::__display_ebook($_REQUEST['eBook']);
	return;
}
 if(!isset($_REQUEST['id']) || empty($_REQUEST['id'])){
 	ui_default::_Default();
 //do not change this
 }else if($_REQUEST['id']=="ssearch"||$_REQUEST['id']=="23ebe1019e51e146722ab9d2d85c0ee5f41005e8"){
 	ui_default::_ssearch();
 }
 else if($_REQUEST['id']=="bsearch"){
        ui_default::_bsearch();	
 }else{
 	$id=$_REQUEST['id'];
 	dispatcher::dispatch($id);
 }
 function setWidthHeight(){
 	$_SESSION['width']=$_POST['_width'];
 	$_SESSION['height']=$_POST['_height'];
 	//echo "Ok";
 }
?>

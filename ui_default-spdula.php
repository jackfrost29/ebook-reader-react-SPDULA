<?php
/*
 * Created on Mar 4, 2010
 * Author: Mosaddek Hossain Kamal -- Tushar
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $path = $_SERVER['DOCUMENT_ROOT'];
include_once($path.'/sections/common/etc/MVC.php');
include_once($path.'/sections/common/etc/forms.php');
include_once($path.'/sections/circulation/opac/opac.php');
include_once($path.'/sections/common/default/defaultBody.php');
include_once($path.'/sections/circulation/book_reader/book_reader.php');	// newly added
class ui_default extends MVC{
	public static function _Default(){
		//$path = $_SERVER['DOCUMENT_ROOT'];
		//echo $path.'/newDesign/index.html';
		 //include($path.'/newDesign/index.html');
		self::search();
	}
	
	public static function _ssearch()
	{
		
		/* $path = $_SERVER['DOCUMENT_ROOT'];
		 //Sajib should not do this, will creates problem
		 $fname= $path.'/newDesign/newheader.html';
		 $pagecontentsheader = file_get_contents($fname);*/
		 //$pagebody="<div class='box4'><br />".opac::allSearch().$default."</div>";
		 //Sajib should not do this, will creates problem
		 /*$fname1= $path.'/newDesign/newfooter.html';
		 $pagecontentsfooter = file_get_contents($fname1);
		 echo  $pagecontentsheader.$pagebody.$pagecontentsfooter;*/
		 //echo $pagebody;
	}
	private function search(){
		$a=defaultBody::display();
		$str='';
		/*$str="<center><table cellspacing='10' cellpadding='20' width='80%' style='text-align:left;background-color:#FF8000'><caption style='text-align:left;background-color:yellow'><br /><h2 style='color:red'>&nbsp;".label::name("common::ui_default.service.label")."</h2><br /></caption><tr><td><br /></td></tr><tr valign='top'>";
		for($i=0;$i<count($a);$i++){
			if($i==0){
				$str=$str."<td>";
				$str=$str.$a[$i];
			}else if($i%10==0){
				$str=$str."</td><td>";
				$str=$str.$a[$i];
			}else{
				$str=$str.$a[$i];
			}
		}
		$str=$str."</td></tr></table></center><br />";*/
		opac::search($str);
		//quickLinks::libShortCut();
		//opac::search("");
	}

	public static function __display_ebook($__ebook)
	{
		$acc_no = substr($__ebook, 0, -4);
		// need to inject css file, which is not here
		$js_bundle = $path = $_SERVER['DOCUMENT_ROOT'].'/javascript/book-reader-bundle.js';
		$js_bundle_map = $path = $_SERVER['DOCUMENT_ROOT'].'/javascript/book-reader-bundle.js.map';
		BookReader::reader_view($default="", $acc_no);
	//	 $a=defaultBody::display();
        //         $str='';
	}
	protected function getInstance($ins=''){}
	protected function getModel($mod=''){}
	protected function getCss(){}
	protected function getSubmission(){}
}
?>

<?php
/*
 * Created on Mar 4, 2010
 * Author: Mosaddek Hossain Kamal -- Tushar
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class forms{
	public static $httpcss=array();
	public static $httpjs=array();
	public static $earlyhttpjs=array();
	public static $embbededCode="";
	public static $extra_header="";
	public static $header_type=0;
	public static function header($title,$model='',$css='',$javaScript='',$embaddedJs='',$embadedCss="",$csstags="",$beforeJs=""){
		header("Content-Type: application/xhtml+xml; charset=UTF-8");
		if(self::$header_type==1){
			header("Content-Type: text/html; charset=UTF-8");
		}
		printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?><!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\"><html xmlns=\"http://www.w3.org/1999/xhtml\">");
		/*printf("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
		 "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");*/
		//printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
		printf("<head><title>%s</title>",$title);
		//printf("%s",$model);
		printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
		printf(self::$extra_header);
		//printf("%s",$css);
		printf("%s",self::commonCss());
		if($css!=''){
			if(is_array($css)){
				for($i=0;$i<count($css);$i++){
					printf("<link href=\"/css/%s\" rel=\"stylesheet\" />",$css[$i]);
				}	
			}else{
				printf("<link href=\"/css/%s\" rel=\"stylesheet\"/>",$css);
			}
		}
		/*if($embadedCss!=''){
		 if(is_array($css)){
		 for($i=0;$i<count($css);$i++){
		 printf("<link href=\"/css/%s\" rel=\"stylesheet\" />",$css[$i]);
		 }	
		 }else{
		 printf("<link href=\"/css/%s\" rel=\"stylesheet\"/>",$css);
		 }
		 }*/
		if(is_array(self::$earlyhttpjs)){
			for($i=0;$i<count(self::$earlyhttpjs);$i++){
				printf("<script type=\"text/javascript\" src=\"%s\"></script>\n",self::$earlyhttpjs[$i]);
			}
		}else{
			if(self::$earlyhttpjs!=''){
				printf("<script type=\"text/javascript\" src=\"%s\"></script>\n",self::$earlyhttpjs);
			}
		} 
		if(is_array($beforeJs)){
			for($i=0;$i<count($beforeJs);$i++){
				printf("<script type=\"text/javascript\" charset=\"utf-8\">%s</script>\n",$beforeJs[$i]);
			}
		}else{
			if($beforeJs!=''){
				printf("<script type=\"text/javascript\"  charset=\"utf-8\">%s</script>\n",$beforeJs);
			}
		}
		if(is_array($javaScript)){
			for($i=0;$i<count($javaScript);$i++){
				printf("<script type=\"text/javascript\" src=\"/javascript/%s\"   charset=\"utf-8\"></script>",$javaScript[$i]);
			}
		}else{
			if($javaScript!=''){
				printf("<script type=\"text/javascript\" src=\"/javascript/%s\"   charset=\"utf-8\"></script>",$javaScript);
			}
		}
		if($embadedCss!=""){
			printf("<style type=\"text/css\"> %s </style>",$embadedCss);
		}
		if(is_array($embaddedJs)){
			for($i=0;$i<count($embaddedJs);$i++){
				printf("<script type=\"text/javascript\" charset=\"utf-8\">%s</script>\n",$embaddedJs[$i]);
			}
		}else{
			if($embaddedJs!=''){
				printf("<script type=\"text/javascript\"  charset=\"utf-8\">%s</script>\n",$embaddedJs);
			}
		}
		
		printf("<script type=\"text/javascript\" src=\"/javascript/default.js\"></script>");
		printf("<script type=\"text/javascript\" src=\"/javascript/keyboard.js\"></script>");
		
		//printf("<script type=\"text/javascript\" charset=\"utf-8\" src=\"/javascript/jquery-1.9.1.min.js\" ></script>");
		//printf("<script type=\"text/javascript\" charset=\"utf-8\" src=\"/javascript/avro.js\"></script>");
		/*	printf("<script type=\"text/javascript\" charset=\"utf-8\">
		 $(function(){
		 $('textarea, input[type=text]').avro();
		 });
		 </script>
		 ");*/
		
		if(is_array(self::$httpcss)){
			for($i=0;$i<count(self::$httpcss);$i++){
				printf("<link href=\"%s\" rel=\"stylesheet\" type='text/css'/>",self::$httpcss[$i]);
			}
		}
		if(is_array($csstags)){
			for($i=0;$i<count($csstags);$i++){
				printf("%s",$csstags[$i]);
			}
		}
		if(is_array(self::$httpjs)){
			for($i=0;$i<count(self::$httpjs);$i++){
				printf("<script type=\"text/javascript\" src=\"%s\"></script>",self::$httpjs[$i]);
			}
		}
		if(self::$embbededCode!=""){
			echo self::$embbededCode;
		}
		printf("</head>");
		printf("<body><div class='page_body'>");
		/*if(isset($_SESSION['width']) && isset($_SESSION['height'])){
		 printf("<body>");
		 }else{
		 printf("<body onload='loadBanner();'>");
		 }*/
	}

	public static function getDemoHeadTags($css) {
		printf("<head>");
		printf("<link rel='stylesheet' type='text/css' href=%s>", $css);
		printf("</head>");
	}

	public static function getNewHeader($src, $css){
		forms::getDemoHeadTags($css);
		printf("<body><div>");
		printf("<img src=%s></img>", $src);
	}

	// modified by: tanvir-CSEDU-23
	public static function getDemoBody($js){
		printf("<div id='demo-root' class='demo-body' style='width:100vw; height:60vh; background-color:red'>Hello World</div>");
		printf("<script type='text/javascript' src=%s></script>", $js);

	}

	public static function getDemoTail($src){
		printf("<img src=%s></img>", $src);
		printf("</div></body>");
	}
	
	public static function headerSpecificPath($title,$model='',$css='',$javaScript=''){
		header("Content-Type: application/xhtml+xml; charset=UTF-8");
		printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" " .
"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">".
"<html xmlns=\"http://www.w3.org/1999/xhtml\">");
/*printf("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
 "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
 "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");*/
//printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
printf("<head><title>%s</title>",$title);
//printf("%s",$model);
printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
//printf("%s",$css);
printf("%s",self::commonCss());
if($css!=''){
	if(is_array($css)){
		for($i=0;$i<count($css);$i++){
			printf("<link href=\"%s\" rel=\"stylesheet\" />",$css[$i]);
		}	
	}else{
		printf("<link href=\"%s\" rel=\"stylesheet\"/>",$css);
	}
}
if(is_array($javaScript)){
	for($i=0;$i<count($javaScript);$i++){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript[$i]);
	}
}else{
	if($javaScript!=''){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript);
	}
}
printf("<script type=\"text/javascript\" src=\"/javascript/default.js\"></script>");
printf("<script>
	$(function() {
	$( \"#date\" ).datepicker({ dateFormat: \"yy-mm-dd\" });
	
	});
</script>");
//printf("<script type=\"text/javascript\" src=\"/javascript/keyboard.js\"></script>");
printf("</head>");
printf("<body><div class='page_body'>");
}
public static function headerSpecificPath2($title,$model='',$css='',$javaScript=''){
	header("Content-Type: application/xhtml+xml; charset=UTF-8");
	printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" " .
"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">".
"<html xmlns=\"http://www.w3.org/1999/xhtml\">");
/*printf("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
 "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
 "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");*/
//printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
printf("<head><title>%s</title>",$title);
//printf("%s",$model);
printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
//printf("%s",$css);
printf("%s",self::commonCss());
if($css!=''){
	if(is_array($css)){
		for($i=0;$i<count($css);$i++){
			printf("<link href=\"%s\" rel=\"stylesheet\" />",$css[$i]);
		}	
	}else{
		printf("<link href=\"%s\" rel=\"stylesheet\"/>",$css);
	}
}
if(is_array($javaScript)){
	for($i=0;$i<count($javaScript);$i++){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript[$i]);
	}
}else{
	if($javaScript!=''){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript);
	}
}
printf("<script type=\"text/javascript\" src=\"/javascript/default.js\"></script>");
printf("<script>
	$(function() {
	$( \"#date\" ).datepicker({ dateFormat: \"dd-mm-yy\" });
	
	});
	$(function() {
	$( \"#date1\" ).datepicker({ dateFormat: \"dd-mm-yy\" });
	
	});
</script>");
//printf("<script type=\"text/javascript\" src=\"/javascript/keyboard.js\"></script>");
printf("</head>");
printf("<body><div class='page_body'>");
}

public static function headerSpecificPath3($title,$model='',$css='',$javaScript=''){
	header("Content-Type: application/xhtml+xml; charset=UTF-8");
	printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" " .
"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">".
"<html xmlns=\"http://www.w3.org/1999/xhtml\">");
/*printf("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
 "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
 "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");*/
//printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
printf("<head><title>%s</title>",$title);
//printf("%s",$model);
printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
//printf("%s",$css);
printf("%s",self::commonCss());
if($css!=''){
	if(is_array($css)){
		for($i=0;$i<count($css);$i++){
			printf("<link href=\"%s\" rel=\"stylesheet\" />",$css[$i]);
		}	
	}else{
		printf("<link href=\"%s\" rel=\"stylesheet\"/>",$css);
	}
}
if(is_array($javaScript)){
	for($i=0;$i<count($javaScript);$i++){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript[$i]);
	}
}else{
	if($javaScript!=''){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript);
	}
}
printf("<script type=\"text/javascript\" src=\"/javascript/default.js\"></script>");
printf("<script>
	$(function() {
	$( \"#date\" ).datepicker({ dateFormat: \"dd-mm-yy\" });
	
	});
	$(function() {
	$( \"#date1\" ).datepicker({ dateFormat: \"dd-mm-yy\" });
	
	});
	
</script>");
//printf("<script type=\"text/javascript\" src=\"/javascript/keyboard.js\"></script>");
printf("</head>");
printf("<body><div class='page_body'>");
}

public static function headerSpecificPath4($title,$model='',$css='',$javaScript=''){
	header("Content-Type: application/xhtml+xml; charset=UTF-8");
	printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" " .
"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">".
"<html xmlns=\"http://www.w3.org/1999/xhtml\">");
/*printf("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
 "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
 "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");*/
//printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
printf("<head><title>%s</title>",$title);
//printf("%s",$model);
printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
//printf("%s",$css);
printf("%s",self::commonCss());
if($css!=''){
	if(is_array($css)){
		for($i=0;$i<count($css);$i++){
			printf("<link href=\"%s\" rel=\"stylesheet\" />",$css[$i]);
		}	
	}else{
		printf("<link href=\"%s\" rel=\"stylesheet\"/>",$css);
	}
}
if(is_array($javaScript)){
	for($i=0;$i<count($javaScript);$i++){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript[$i]);
	}
}else{
	if($javaScript!=''){
		printf("<script type=\"text/javascript\" src=\"%s\"></script>",$javaScript);
	}
}
printf("<script type=\"text/javascript\" src=\"/javascript/default.js\"></script>");
printf("<script>
	$(function() {
	$( \"#date\" ).datepicker({ dateFormat: \"dd-mm-yy\" });
	
	});
	$(function() {
	$( \"#date1\" ).datepicker({ dateFormat: \"dd-mm-yy\" });
	
	});
	$(function() {
	$( \"#date2\" ).datepicker({ dateFormat: \"yy-mm-dd\" });
	
	});
	$(function() {
	$( \"#date3\" ).datepicker({ dateFormat: \"yy-mm-dd\" });
	
	});
</script>");
printf("<style>
	
	table
	{
	border-collapse:collapse;
	}
</style>");
//printf("<script type=\"text/javascript\" src=\"/javascript/keyboard.js\"></script>");
printf("</head>");
printf("<body><div class='page_body'>");
}	
public static function headerNew($title,$model='',$css='',$javaScript=''){
	header("Content-Type: application/xhtml+xml; charset=UTF-8");
	printf("<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" " .
"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">".
"<html xmlns=\"http://www.w3.org/1999/xhtml\">");
/*printf("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" " .
 "\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
 "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n");*/
//printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
printf("<head><title>%s</title>",$title);
//printf("%s",$model);
printf("<meta http-equiv=\"pragma\" content=\"no-cache\"/>");
//printf("%s",$css);
printf("%s",self::commonCssNew());
if($css!=''){
	if(is_array($css)){
		for($i=0;$i<count($css);$i++){
			printf("<link href=\"/css/%s\" rel=\"stylesheet\" />",$css[$i]);
		}	
	}else{
		printf("<link href=\"/css/%s\" rel=\"stylesheet\"/>",$css);
	}
}
if(is_array($javaScript)){
	for($i=0;$i<count($javaScript);$i++){
		printf("<script type=\"text/javascript\" src=\"/javascript/%s\"></script>",$javaScript[$i]);
	}
}else{
	if($javaScript!=''){
		printf("<script type=\"text/javascript\" src=\"/javascript/%s\"></script>",$javaScript);
	}
}
printf("<script type=\"text/javascript\" src=\"/javascript/default.js\"></script>");
printf("<script type=\"text/javascript\" src=\"/javascript/keyboard.js\"></script>");
printf("</head>");
printf("<body><div class='page_body'>");
}
public static function commonCss(){
	return "<link href=\"/css/menu.css\" rel=\"stylesheet\"/>"."<link href=\"/css/compact.css\" rel=\"stylesheet\"/>"."<link href=\"/css/keyboard.css\" rel=\"stylesheet\"/>";
}
public static function commonCssNew(){
	return "<link href=\"/css/menu1.css\" rel=\"stylesheet\"/>"."<link href=\"/css/compact.css\" rel=\"stylesheet\"/>"."<link href=\"/css/keyboard.css\" rel=\"stylesheet\"/>";
	//return "";
}
public static function getTail(){
	$str="<br/><hr style='height:2px'/><div>".self::tailMenu();
	if(isset($_SESSION['lang']) && $_SESSION['lang']=="en_US"){
		$str=$str."<center>Copyright &#169; Library, University of Dhaka 2009-10, Dhaka, Bangladesh\n</center>\n";
	}else{
		$str=$str."<center>কপিরাইট &#169; গ্রন্থাগার, ঢাকা বিশ্ববিদ্যালয় ২০০৯-১০,ঢাকা, বাংলাদেশ\n</center>\n";
	}
	echo $str."</div></div></body></html>";
}
public static function tailMenu($cstomize=''){
	$str="<table cellspacing='10' style='text-align:left;font-size:9pt;color:blue'>";
	$str=$str."<tr><td><h4>Library Members</h4></td></tr>";
	if(!isset($_SESSION['userId'])){
		$str=$str."<tr><td><a href='/sections/processing/pic/' style='text-decoration:none'>".label::name("menu::footer.login.label")."</a></td></tr>";
		//$str=$str."<td>Membership</td>";
	}
	// about Library
	// Fine menu
	// Login/Registration
	$str=$str."</table>";
	return $str;
}
public static function showBoxArea($str="",$align="",$box=""){
	$myBox="boxad";
	if($box!==""){
		$myBox=$box;
	}
	return ("<div class='".$myBox."' >".$str."</div>");
}
public static function setExtraHeader($str){
	self::$extra_header=self::$extra_header.$str;
}
}
?>

<?php
/*
 * Created on Mar 4, 2010
 * Author: Mosaddek Hossain Kamal -- Tushar
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  abstract class MVC{
 	protected static function view($str=''){
 		self::showNewBanner();
 		if(isset($_SESSION['group'])){
 			$str1=Menu::menuConcat($_SESSION['group']);
 			echo Menu::showMenu($str1);
 		}else{
 			$group=array();
 			$str1=Menu::menuConcat($group);
 			//echo $str1;
 			echo Menu::showMenu($str1);
 		}
 		if(!isset($_SESSION['en_US'])){
 			$_SESSION['LANG']="en_US";
 		}
 		//echo "<br />";
 		if($str!=''){
 			printf("%s",$str);
 		}
 	}
 	protected function showNewBanner(){
 		$exReq='';
 		if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
 			$exReq="id=".$_REQUEST['id']."&amp;";
 		}
 		$wb1=170;
 		$wblogo=55;
 		$wb2=538;
 		$wb3=170;
 		$wb4=140;
 		$baseHt=0.3;
 		$str12="";
 		if(isset($_SESSION['LANG']) && $_SESSION['LANG']=="en_US"){
 			$str12="<a href='index.php?".$exReq."id_lang=bn_BD' style='text-decoration:none'>বাংলা সংস্করণ</a>";
 		}else{
 			$str12="<a href='index.php?".$exReq."id_lang=en_US' style='text-decoration:none'>English</a>";
 		}
 		echo "<table cellspacing=\"0\" valign=\"bottom\" cellpadding=\"0\" border=\"0\" width=\"100%\" style='background-color:white'>" .
 				"<tr style='height:15pt;'><td ></td><td></td><td rowspan='4'><table><tr><td><img style='display:inline-block;' src='/images/library1.jpg' width='590px' height='100px' /></td></tr></table></td><td align='right'></td></tr>".
 				//"<tr><td></td><td></td><td rowspan='3' align='right' width='90%'><label>Username</label><input type='text' name='userId' size='14' value=''/><label>Password</label><input type='password' name='passwd' value='' size='14'/></td><td></td></tr>".
 				"<tr style=\"border-top-style:solid;border-top-color:#FFFFFF;border-top-width:1px;\" valign=\"bottom\" width='100%'>".
 				"<td valign='top' align='center' width='60'><img src='/images/duColorlogo.png' height='".(210*$baseHt)."' width='".($wblogo)."' border=\"0\"/></td>".
 				"<td valign='top' align='left'><a href='/index.php?".$exReq."id_lang=en_US'><img src='/images/du_text_en.png' height='".(80*$baseHt)."' width='".$wb1."' border=\"0\"/><br /><img src='/images/du_library_text_en.png' height='".(100*$baseHt)."' width='".$wb1."' border=\"0\"/></a></td><td></td>" .
 				"<td valign='top' align='right' width='100%'><a href='/index.php?".$exReq."id_lang=bn_BD'><img src='/images/du_text_blue.png' height='".(80*$baseHt)."' width='".$wb3."'  border=\"0\" /><br /><img src='/images/du_library_bn.png' height='".(100*$baseHt)."' width='".$wb3."'  border=\"0\" /></a></td>" .
 				"</tr>".
 				//"<tr width='100%' style='background-color:white;height:8pt'><td >jshdjsd</td><td rowspan='4'></td><td></td></tr>".
 				"<tr width='100%' style='background-color:white;height:2pt'><td></td><td><b><font size='1pt'>Integrated System</font></b></td><td></td><td style='text-align:right;font-family:serif'>".$str12."&nbsp;</td></tr>".
 				"<tr width='100%' style='background-color:white;height:8pt'><td colspan='5'></td></tr>".
 				"<tr width='100%' style='background-color:#FFFF00;height:8pt'><td colspan='5'></td></tr>".
				"</table>";
 	}
 	protected function showBanner(){
 		$wb1=400;
 		$wb2=900;
 		$wb3=300;
 		$baseHt=1;
 		if(isset($_SESSION['width']) && isset($_SESSION['height'])){
 			$baseHt=($_SESSION['height'])/(((1000)*($_SESSION['height']))/768);
 			$wb1=(400/1625)*($_SESSION['width']);
 			$wb2=(900/1625)*($_SESSION['width']);
 			$wb3=(300/1625)*($_SESSION['width']);
 		}
 		$exReq='';
 		if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
 			$exReq="id=".$_REQUEST['id']."&amp;";
 		}
 		echo "<table cellspacing=\"0\" valign=\"bottom\" cellpadding=\"0\" border=\"0\" width=\"100%\">" .
 				"<tr style=\"border-top-style:solid;border-top-color:#FFFFFF;border-top-width:1px;\" valign=\"bottom\" width='100%'>".
 				"<td valign='bottom'><a href='/index.php?".$exReq."id_lang=en_US'><img src='/images/homeBanner1.jpg' height='".(92*$baseHt)."' width='".$wb1."' border=\"0\"/></a></td>" .
 				"<td valign='bottom'><a href='/'><img src='/images/library1.jpg' height='".(91*$baseHt)."' width='".$wb2."' border=\"0\"/></a></td>".
 				"<td valign='bottom' width='100%'><a href='/index.php?".$exReq."id_lang=bn_BD'><img src='/images/last.jpg' height='".(91*$baseHt)."' width='".$wb3."'  border=\"0\" /></a></td>" .
 				"</tr></table>";
 		/*<td height=\"91\" background='/images/banner.jpg' style='background-repeat:no-repeat;'></td></tr></table>";<img src=\"/images/top.jpg\" height=\"90\" width=\"100%\" border=\"0\"/>*/
 	}
 	protected function getXmlToArray($str,$lang){
 		$xml=new DOMDocument();
 		$xml->loadXML($str);
 		$x=array();
 		if($lang=="BEN"){
 			
 		}else{
 			$node=$xml->getElementsByTagName("ENG")->item(0);
 			$children=$node->childNodes;
 			foreach($children as $key){
 				if($key->nodeType == XML_ELEMENT_NODE){
 					$x[$key->nodeName]=$key->nodeValue;
 				}
 			}
 			return $x;
 		}
 	}
 	protected function isError($message=''){
 		$msg='';
 		if($message=='') return '';
 		$xml=new DOMDocument();
 		$xml->loadXML($message);
 		$nodes=$xml->getElementsByTagName("errorMessage");
 		if($nodes->length!=0){
 			$err=$nodes->item(0)->getElementsByTagName("error");
 			$msg="<h4><font color=\"red\"> Error!! ".$err->item(0)->nodeValue."</font></h4>";
 		}
 		return $msg;
 	}
 }
?>

<?php
//  $root = $_SERVER['DOCUMENT_ROOT'];
// use \Imagick;


// script test after comment

include_once($path . '/sections/common/etc/MVC.php');
include_once($path . '/library/label.php');
include_once($path . '/sections/common/etc/forms.php');


class BookReader extends MVC
{


    private static $noteTypes = "";
    private static $phyDesTypes = '';
    private static $emImage = '';
    private static $xmlObj = null;
    private static $collections = '';
    private static $locations = "";
    private static $biblioData = '';

    public static function is_dir_empty($dir)
    {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                closedir($handle);
                return false;
            }
        }
        closedir($handle);
        return true;
    }



    public static function extract_pages($pdf_path, $page_dir, $acc_no)
    {

        //done using pdftoppm
        $query = "pdftoppm -png -r 300 -f 1 -l 20 " . $pdf_path . " " . $page_dir . $acc_no;
        $output = shell_exec($query);


        if ($handle = opendir($page_dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $splited = explode('-', $entry);
                    $name = $splited[1];
                    $t_name = trim($name, "0");


                    $old_name = $page_dir . $entry;
                    $new_name = $page_dir . $t_name;
                    rename($old_name, $new_name);

                }
            }
            closedir($handle);
        }

        /***
        $im = new Imagick();
        $im->setResolution(300, 300);
        for ($i = 1; $i <= 20; $i++) {
            $im->readImage($pdf_path . '[' . ($i - 1) . ']');
            $im->writeImage($page_dir . '/' . $i . '.jpg');
        }
        ***/

    }

    public static function get_meta_data($acc_no)
    {
        $ar = json_decode((file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/images/book_reader/meta.json")));

        foreach ($ar as $entry) { //foreach element in $arr
            if (strcmp(strval($acc_no), $entry->accession) == 0) {
                $ret[0] = preg_replace('/\s+/', '#', $entry->title);
                $ret[1] = preg_replace('/\s+/', '#', $entry->authors);
                return $ret;
            }

        }

        $ret[0] = preg_replace('/\s+/', '#', "Book Title");
        $ret[1] = preg_replace('/\s+/', '#', "Author Name");
        return $ret;
    }

    public static function set_page_for_fetch($acc_no)
    {
        $server_root = $_SERVER['DOCUMENT_ROOT'];
        $page_dir = '/var/libdata/tmp/book_reader/pages/' . $acc_no . '/';   // use /tmp instead of server root
        $pdf_path = '/var/libdata/eBooks/' . $acc_no . '.pdf';
        // check if the pages are there.
        if (!is_dir($page_dir)) {
            mkdir($page_dir);
        }
        if (BookReader::is_dir_empty($page_dir)) {
            BookReader::extract_pages($pdf_path, $page_dir);
        }
    }

    public static function getDemoBody($acc_no, $js, $js_map)
    {
        $server_root = $_SERVER['DOCUMENT_ROOT'];
        // $page_dir = '/var/libdata/images/' . $acc_no . '/';   //backed-up for now
        $page_dir = '/var/libdata/tmp/book_reader/pages/' . $acc_no . '/';   // use /tmp instead of server root
        $pdf_path = '/var/libdata/eBooks/' . $acc_no . '.pdf';
        // check if the pages are there.
        if (!is_dir($page_dir)) {
            mkdir($page_dir);
        }
        if (BookReader::is_dir_empty($page_dir)) {
            BookReader::extract_pages($pdf_path, $page_dir);
        }

        list($title, $author) = BookReader::get_meta_data(($acc_no));



        $str = "";
        $str = $str . "<div><input id='accession_no' type='hidden' value='" . $acc_no . "'/>";
        $str = $str . "<input id='title' type='hidden' value='" . $title . "'/>";
        $str = $str . "<input id='author' type='hidden' value='" . $author . "'/></div>";
        $str = $str . "<div id='book-reader-root' class='EbookReader'></div>";
        $str = $str . "<script id='bundle.js' type='text/javascript' src='" . $js . "'></script>";

        return $str;

        /**
         printf("<div><input id='accession_no' type='hidden' value=%s>", $acc_no);
         printf("<input id='title' type='hidden' value=%s>", $title);
         printf("<input id='author' type='hidden' value=%s></div>", $author);


         printf("<div id='book-reader-root' class='EbookReader'></div>");    // commented style--->>  style='width:100vw; height:60vh; background-color:red'
         printf("<script id='bundle.js' type='text/javascript' src=%s></script>", $js);
         */

    }

    private static function emClearTextField()
    {
        $str = "function clearText(field){
			if (field.defaultValue == field.value) field.value = '';
			else if (field.value == '') field.value = field.defaultValue;
			}";
        return $str;
    }

    public static function reader_view($default = "", $acc_no)
    {
        if (isset($_POST['_option']) && isset($_POST['_pub_id'])) {
            echo self::getDetail();
            return;
        }
        //print_r($_POST);
        $title = label::name("opac.search.page.title");
        $model = '';
        $css = 'jquery.ime.css';
        $emjs = "";
        $javascript[0] = 'search.js';
        $javascript[1] = "jquery-1.11.1.min.js";
        //$javascript[2]="jquery.nivo.slider.js";
        $javascript[2] = "jquery.ime.js";
        $javascript[3] = "jquery.ime.selector.js";
        $javascript[4] = "jquery.ime.preferences.js";
        $javascript[5] = "jquery.ime.inputmethods.js";
        $javascript[6] = "bn-avro.js";
        // $javascript[7]= "book-reader-bundle.js";
        //$javascript[8]="jquery-1.2.6.min.js";
        // $emjs[0]=self::emJsSlider();
        $beforeJs = "";
        $beforeJs = self::emClearTextField();
        if ($_SESSION['lang'] == "bn_BD") {
            $emjs[0] = self::emBanglaTypeJs();
            $emjs[1] = self::emInputBanglaType();
        }
        /*if(isset($_POST['search'])||isset($_POST['refineSearch'])){
                  $emjs="";
              }*/
        $csstags[0] = "<link type='text/css' href='/css/modal/basic.css' rel='stylesheet' media='screen' />";
        /** this is the only line that's been modified here */
        $csstags[1] = "<link type='text/css' href='/css/book-reader-bundle.css' rel='stylesheet' media='screen' />";
        // $emcss=self::emCssSlider();
        if ($_SESSION['lang'] !== "en_US") {
            forms::$header_type = 1;
        }
        forms::header($title, $model, $css, $javascript, $emjs, "", $csstags, $beforeJs);
        //error_log("We are here");
        /*if(isset($_POST['refineSearch']) && isset($_POST['refineSearch'])=="true"){
               $str1=self::refineFormProcess();
               }else{*/
        $js_bundle = "javascript/book-reader-bundle.js";
        $js_bundle_map = "javascript/book-reader-bundle.js.map";
        $str = self::getDemoBody($acc_no, $js_bundle, $js_bundle_map);
        //}
        //$str=$str.quickLinks::display();
        MVC::view($str);

        forms::getTail();
    }

}
?>
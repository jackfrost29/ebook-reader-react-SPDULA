<?php
class label
{
        public static function name($arg)
        {
                $prefix = '';
                $s = preg_split('/\::/', $arg);
                $t = '';
                if (count($s) > 0) {
                        for ($i = 0; $i < (count($s) - 1); $i++) {
                                if ($i == 0) {
                                        $prefix = $prefix . $s[$i];
                                } else {
                                        $prefix = $prefix . '/' . $s[$i];
                                }
                        }
                        $t = preg_split('/\./', $s[(count($s) - 1)]);
                } else {
                        $t = preg_split('/\./', $arg);
                }
                $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : "en_US";
                $locale = $_SERVER['DOCUMENT_ROOT'] . '/library/locale/' . $lang . '/' . ($prefix != '' ? ($prefix . '/') : '') . $t[0] . '.xml';
                //echo $locale."<br />";
                $xml = new DOMDocument();
                if (!$xml->load($locale))
                        return null;
                $labelNode = self::getElementById($xml, $arg);
                if ($labelNode == null) {
                        return null;
                }
                // echo $lang;
                return self::xml_converter($labelNode->nodeValue);
        }
        private static function getElementById($xml, $value)
        {
                $n = $xml->getElementsByTagName("message");
                for ($i = 0; $i < $n->length; $i++) {
                        $attr = $n->item($i)->getAttribute("key");
                        if ($attr == $value) {
                                return $n->item($i);
                        }
                }
                return null;
        }
        public static function getList($args)
        {
                $prefix = '';
                $s = preg_split('/\::/', $arg);
                $t = '';
                if (count($s) > 0) {
                        for ($i = 0; $i < (count($s) - 1); $i++) {
                                if ($i == 0) {
                                        $prefix = $prefix . $s[$i];
                                } else {
                                        $prefix = $prefix . '/' . $s[$i];
                                }
                        }
                        $t = preg_split('/\./', $s[(count($s) - 1)]);
                } else {
                        $t = preg_split('/\./', $arg);
                }
                $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : "en_US";
                $locale = $_SERVER['DOCUMENT_ROOT'] . '/library/locale/' . $lang . '/' . ($prefix != '' ? ($prefix . '/') : '') . $t[0] . '.xml';
                $xml = new DOMDocument();
                if (!$xml->load($locale))
                        return null;
                $a = self::getLabel($xml);
                foreach ($a as $key => $value) {
                        $myValue = self::getElementById($xml, $key . ".value");
                        $a[$key][1] = $myValue->nodeValue;
                }
                return $a;
        }
        private static function getLabel($xml)
        {
                $t = array();
                $n = $xml->getElementsByTagName("message");
                for ($i = 0; $i < $n->length; $i++) {
                        $attr = $n->item($i)->getAttribute("key");
                        $s = preg_split('/\./', $attr);
                        if (count($s) == 2) {
                                $t[$attr][0] = $n->item($i)->nodeValue;
                        }
                }
                if (count($t) > 0) {
                        return $t;
                } else {
                        return null;
                }
        }
        private static function xml_converter($str)
        {
                $str = str_replace("&", "&amp;", $str);
                $str = str_replace("<", "lt;", $str);
                $str = str_replace(">", "gt;", $str);
                return $str;
        }
}
?>
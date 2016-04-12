<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class xml_serialize{
    //--------------------------------------------------------------------------
    /**
     * 
     * The most advanced method of serialization.
     * 
     * @param mixed $obj => can be an objectm, an array or string. may contain unlimited number of subobjects and subarrays
     * @param string $wrapper => main wrapper for the xml
     * @param array (key=>value) $replacements => an array with variable and object name replacements
     * @param boolean $add_header => whether to add header to the xml string
     * @param array (key=>value) $header_params => array with additional xml tag params
     * @param string $node_name => tag name in case of numeric array key
     */
    public function generate_xml_from_array($array, $node_name) {
        $xml = '';

        if (is_array($array) || is_object($array)) {
            foreach ($array as $key=>$value) {
                if (is_numeric($key)) {
                    $key = $node_name;
                }

                $xml .= '<' . $key . '>' . "\n" . $this->generate_xml_from_array($value, $node_name) . '</' . $key . '>' . "\n";
            }
        } else {
            $xml = htmlspecialchars($array, ENT_QUOTES) . "\n";
        }

        return $xml;
    }

    public function generate_valid_xml_from_array($array, $node_block='nodes', $node_name='node', $add_headers = true) {
        $xml = "";
        if($add_headers){
            $xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
        }
        

        $xml .= '<' . $node_block . '>' . "\n";
        $xml .= $this->generate_xml_from_array($array, $node_name);
        $xml .= '</' . $node_block . '>' . "\n";

        return $xml;
    }
    //--------------------------------------------------------------------------
}


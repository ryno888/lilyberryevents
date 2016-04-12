<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class db{
    
    //--------------------------------------------------------------------------
    /**
     * 
     * @param type $table
     * @param type $where
     * @param type $options 
     *                  array(
                            "columns" => select specific columns,
                            "multiple" => return multiple if true,
                            "show_data" => show additional result data,
                        )
     * @return type)
     */
    public static function get_fromdb($table, $where = false, $options = []) {
        if(intval($where)){
            $index_column = db::get_table_prefix($table);
            if($index_column){
                $sql_where = $where ? "WHERE {$index_column}_id = $where" : "";
            }
        }else{
            $sql_where = $where ? "WHERE $where" : "";
        }
        $dbx = new dbx();
        return $dbx->get_fromdb($table, $sql_where, $options);
    }
    //--------------------------------------------------------------------------
    public static function update($obj) {
        $dbx = new dbx();
        return $dbx->update($obj);
    }
    //--------------------------------------------------------------------------
    public static function insert($obj) {
        $dbx = new dbx();
        return $dbx->insert($obj->table_name, $obj);
    }
    //--------------------------------------------------------------------------
    public static function delete($obj) {
        $dbx = new dbx();
        $dbx->delete($obj);
    }
    //--------------------------------------------------------------------------
    public static function delete_multiple($obj_arr) {
        if(!$obj_arr){ return false; }
        $dbx = new dbx();
        $dbx->delete_multiple($obj_arr);
    }
    //--------------------------------------------------------------------------
    public static function get_table_prefix($table, $return_full_id = false) {
        
        $id_suffix = $return_full_id ? "_id" : "";
        $return = false;
        switch ($table) {
            case "person": $return = "per"; break;
            case "album": $return = "alb"; break;
            case "image": $return = "img"; break;
            case "comm": $return = "com"; break;
        }
        return $return.$id_suffix;
    }
    //--------------------------------------------------------------------------
    public static function get_default($table_name){
        $conn = &get_instance();
        $conn->load->database();
        $database = $conn->db->database;
        $sql = "
            SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE table_name = '$table_name'
            AND table_schema = '$database'
        ";

        $query = $conn->db->query($sql);

        $result_arr = $query->result();
        $return = new stdClass();
        $return->table_name = $table_name;
        $table_prefix = db::get_table_prefix($table_name);
        foreach ($result_arr as $key => $value) {
            if($value->COLUMN_NAME == "{$table_prefix}_id"){ continue; }
            $return->{$value->COLUMN_NAME} = false;
        }
        return $return;
    }
    //--------------------------------------------------------------------------
    public static function selectsingle($sql){
        $conn = dbx::get_database();
        $query = $conn->db->query($sql." LIMIT 1");
        $result = $query->result();
        if($result && isset($result[0])){
            foreach ($result[0] as $col_name => $col_val) {
                return $col_val;
            }
        }
        return false;
    }
    //--------------------------------------------------------------------------
}


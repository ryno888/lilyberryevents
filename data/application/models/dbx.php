<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class dbx extends CI_Controller{
    public $obj = false;
    public $name = false;
    public $id = false;
    //--------------------------------------------------------------------------
    public function get_fromdb($table, $where = false, $options = []) {
        
        $options_arr = array_merge([
           "columns" => "*",
           "multiple" => false,
           "left_join" => false,
           "show_data" => false,
           "order_by" => false,
           "limit" => false,
           "offset" => false,
        ],$options);
        
        $this->load->database();
        $index_column = db::get_table_prefix($table);
        $limit = !$options_arr['multiple'] ? " LIMIT 1 " : ($options_arr['limit'] ?" LIMIT {$options_arr['limit']} " : "");
        $offset = $options_arr['offset'] ? " OFFSET {$options_arr['offset']} " : "";
        $query = $this->db->query("
            SELECT {$options_arr['columns']}, 
            {$index_column}_id AS id,
            '{$table}' AS 'name'
            FROM `$table` {$options_arr['left_join']} $where $limit $offset {$options_arr['order_by']}
        ");
        
        if($options_arr['show_data']){
            $return = new stdClass();
            $return->data = $query;
            $return->name = $table;
            $return->resultset = $query->result();
            return $return;
        }else{
            return $query->result();
        }
        return false;
    }
    //--------------------------------------------------------------------------
    public function insert($table, $obj) {

        $columns = false;
        $values = false;
        $return = false;
        
        $this->load->database();

        foreach ($obj as $column_name => $column_value){
            if($column_name == "table_name") { continue; }
            $columns .= $columns ? ", $column_name" : "$column_name";
            $values .= $values ? ", '$column_value'" : "'$column_value'";
        }
        
        if($columns && $values){
            $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

            $query = $this->db->query($sql);
            $index_column = db::get_table_prefix($table, true);
            $obj->id = $this->db->insert_id();
            $obj->{$index_column} = $obj->id;
        }
        return $obj;
    }
    //--------------------------------------------------------------------------
    public function delete($obj) {
        $this->load->database();
        $index_column = db::get_table_prefix($obj->name);
        $this->db->delete($obj->name, ["{$index_column}_id" => $obj->id]);
    }
    //--------------------------------------------------------------------------
    public function delete_multiple($obj_arr) {
        $this->load->database();
        $id_string = false;
        $index_column = false;
        $table = false;
        foreach ($obj_arr as $obj) {
            $index_column = $index_column ? $index_column : db::get_table_prefix($obj->name);
            $id_string .= $id_string ? ", $obj->id" : "$obj->id";
            if(!$table){ $table = $obj->name; }
        }
        if($id_string){
            $sql_where = "{$index_column}_id IN ($id_string)";
            $this->db->delete($table, $sql_where);
        }
    }
    //--------------------------------------------------------------------------
    public function update($obj) {
        $data = false;
        $this->load->database();
        $index_column = db::get_table_prefix($obj->name, true);
        foreach($obj as $col_name => $col_value) {
            if($col_name == "id" || $col_name == "name" || $col_name == $index_column) { continue; }
            $data[$col_name]= $col_value;
        }
        
        if($data){
            $where = "$index_column = $obj->id"; 
            $str = $this->db->update_string($obj->name, $data, $where);
            $this->db->query($str);
        }
    }
    //--------------------------------------------------------------------------
    public static function get_database() {
        $conn = &get_instance();
        $conn->load->database();
        return $conn;
    }
    //--------------------------------------------------------------------------
}


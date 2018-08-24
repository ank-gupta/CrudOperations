<?php

 class ToDoGateway {
    
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "name";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM data ORDER BY $dbOrder ASC");
        
        $todos = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $todos[] = $obj;
        }
        
        return $todos;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        
        $dbres = mysql_query("SELECT * FROM data WHERE id=$dbId");
        
        return mysql_fetch_object($dbres);
		
    }
    
    public function insert( $name, $status ) {
        $dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        $dbStatus = ($status != NULL)?"'".mysql_real_escape_string($status)."'":'NULL';
        
        mysql_query("INSERT INTO DATA (name, status) VALUES ($dbName, $dbStatus)");
        return mysql_insert_id();
    }
    
    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM data WHERE id=$dbId");
    }
    
}




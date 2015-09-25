<?php

class SQLQuery {
    protected $_dbHandle;
    protected $_result;
 
    /** Connects to database **/
 
    function connect($address, $account, $pwd, $name) {
        $this->_dbHandle = new \mysqli($address, $account, $pwd, $name);
        if ($this->_dbHandle->errno == 0) {
            return 1;
        } else {
            return 0;
        }
    }
 
    /** Disconnects from database **/
    function disconnect() {
        unset($this->_dbHandle);
        return 1;
    }
     
    function selectAll() {
        $query = 'select * from `'.$this->_table.'`';
        return $this->query($query);
    }
     
    function select($id) {
        $query = 'select * from `'.$this->_table.'` where `id` = ?';
        return $this->query($query, 'i', [$id]);
    }
     
    /** Custom SQL Query **/
    function query($query = '', $types = '', $params = array()){
        // Get link that was used
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
        // Prepare the query
        $stmt = $this->_dbHandle->prepare($query);
        // Check for query errors
        if (!$this->_dbHandle->errno) {            
            if ($types !== '' && strlen($types) === count($params)) {
                $merged = array_merge(array($types), $params);
                $refs = array();
                foreach($merged as $key => $value) {
                    $refs[$key] = &$merged[$key];
                }
                call_user_func_array(array($stmt, 'bind_param'), $refs);
            }
            if (strlen($types) !== count($params)){
                if (DEVELOPMENT_ENVIRONMENT) {
                    echo "The number of paramaters types does not match the number of paramaters passed.".strlen($types).' !== '.count($params)." Query:".$query;
                }
                return false;
            }
            $stmt->execute();
            if($stmt->errno){
                if (DEVELOPMENT_ENVIRONMENT) {
                    echo "Mysqli Statment Error No.".$this->handler->errno.' - Mysqli Statment Error:'.$this->handler->error." Query:".$query;
                }
                return false;
            }
            return $stmt->get_result();
            
        } else {
            if (DEVELOPMENT_ENVIRONMENT) {
                echo '<pre>'.$query.'</pre>'."Mysqli Error No. ".$this->handler->errno.' - Mysqli Error: '.$this->handler->error." Query: ".$query;
            }
        }
    }
 
    /** Get number of rows **/
    function getNumRows() {
        return mysqli_num_rows($this->_result);
    }
 
    /** Free resources allocated by a query **/
    function freeResult() {
        mysqli_free_result($this->_result);
    }
    
    /** Get error string **/
    function getError() {
        return mysqli_error($this->_dbHandle);
    }
    
    /**
     * Turns resource in to an array
     * @param object $function
     * @param resource $data
     * @return array
     */
    public function getArray($function, $data){
        $returnArray = array();
        $returnData = call_user_func_array(array($this,$function), $data);
        
        if (gettype($returnData) === 'object') {
            while($rs = mysqli_fetch_assoc($returnData)){
                array_push($returnArray, $rs);
            }
        }
        return $returnArray;
        
    }
    
    public function getJSON($function, $data){
        $array = $this->getArray($function, $data);
        return json_encode($array);
    }
    
    public function getObject($function, $data){
        $returnData = call_user_func_array(array($this,$function), $data);
        return $returnData;
    }
}
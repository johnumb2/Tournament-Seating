<?php

class UsersController extends Controller 
{
    
    function details($id = null, $name = null){
        $this->set('name', $name);
        $this->set('title', 'Tournament Seating');
        $query = "
            SELECT users.*
            FROM users
            WHERE users.id = ?
        ";
        $this->set('data',$this->User->getArray('query',[$query, 'i', [$id]]));
    }
    
    function view() {
        $this->set('title','Tournament Seating');
        $query = "
            SELECT users.*
            FROM users
            WHERE removed = 0
        ";
        $this->set('data',$this->User->getArray('query',[$query, '', []]));
    }
     
    function put() {
        $security = new SecurityController('Security', 'SecurityController', '');
        $accounts = new AccountsController('Account', 'AccountController', '');
        $accounts->set('data', $_POST['accounts']);
        $accounts->put();
        
        $users = $_POST['users'];
        $query = '
            SET firstName = ?
                , lastName = ?
                , email = ?
        ';
        $types = 'sss';
        $params = [$users['firstName'], $users['lastName'], $users['email']];
        if($users['password'] !== ''){
            $query .= ' , password = ?
                , salt = ? ';
            
            $random = $security->random();
            $encrypted = $security->encrypt($users['password'], $random);
            
            $types .= 'ss';
            array_push($params, $encrypted);
            array_push($params, $random);
        }
        
        
        if((int)$users['id'] > 0){
            $query = "UPDATE users ".$query;
            $query .= " WHERE id = ? ";
            $types .= 'i';
            array_push($params, $users['id']);
        } else {
            $query = "INSERT INTO users ".$query;
            
        }
        $this->set('title','Tournament Seating');
        $this->User->query($query, $types, $params);
    }
     
    function remove($id = null) {
        $this->set('title','Tournament Seating'); 
    }
}
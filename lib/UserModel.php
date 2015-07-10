<?php

  class UserModel {
    var $db_connection;
    var $table_name;
    
    public function __construct($db_connection, $table_name="users") {
      $this->db_connection = $db_connection;
      $this->table_name = $table_name;
    }
    
    /*
     * return false if login/password are incorrect
     * return array if success
    **/
    function authentificate($login, $password, $duration = 3600) {
      $statement = $this->db_connection->prepare(
        "SELECT * FROM {$this->table_name} users WHERE username=:login AND pwd=MD5(CONCAT(:password, salt))"
      );
      $statement->execute(
        array(
          ':login'      => $login,
          ':password'   => $password, 
        )
      );
      $rows = $statement->fetchAll();
      if(count($rows)!=1) {
        return false;
      }
      else {
        return $rows[0];
      }
    }
    
    /**
     * void
    */
    function save_session($user_id, $session_id) {
      $statement = $this->db_connection->prepare(
        "UPDATE {$this->table_name} SET session_id=:session_id WHERE id=:user_id"
      );
      $statement->execute(
        array(
          ':user_id'    => $user_id,
          ':session_id' => $session_id,
        )
      );
    }
    
    /**
     * void
    */
    function remove_session($user_id) {
      $statement = $this->db_connection->prepare(
        "UPDATE {$this->table_name} SET session_id='' WHERE id=:user_id"
      );
      $statement->execute(
        array(
          ':user_id'    => $user_id,
        )
      );
    }
    
    /**
     * return false if user and session ids are invalid
     * return array if success
    **/
    function authorize($user_id, $session_id) {
      $statement = $this->db_connection->prepare(
        "SELECT * FROM users WHERE id=:user_id AND session_id=:session_id"
      );
      $statement->execute( 
        array(
          ':user_id'    => $user_id,
          ':session_id' => $session_id,
        )
      );
      $rows = $statement->fetchAll();
      if(count($rows)!=1) {
        return false;
      }
      else {
        return $rows[0];
      }
    }

    
  }
   

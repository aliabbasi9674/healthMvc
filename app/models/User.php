<?php

class User {
    private $db;
    public function __construct()
    {
        $this->db=new Database;
    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email=:email');
        //bind param
        $this->db->bind(':email',$email);

        //execute
        $this->db->fetch();

        //check row

        if ($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users ( name, phone,email , password) VALUES (:name ,:phone, :email ,:password)');

        // Bind value
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':phone',$data['phone']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        // Execute
        if( $this->db->execute() ){
            return true;
        }else{
            return false;
        }
    }


    // Login User
    public function login($data)
    {
        $this->db->query('SELECT * FROM users WHERE email= :email');

        // Bind value
        $this->db->bind(':email',$data['email']);

        // Execute
        $row = $this->db->fetch();
        $hash_password = $row->password;

        if( password_verify( $data['password'] , $hash_password ) ){
            return $row;
        }else{
            return false;
        }
    }

}

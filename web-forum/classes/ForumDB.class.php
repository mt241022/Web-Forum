<?php

class ForumDB
{
    private $db;

    function __construct(){
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PW);
        }catch (PDOException $e){
            echo "Verbindung fehlgeschlagen";
            die();
        }
    }

    function addUser($username, $password){
        $stmt = $this->db->prepare('INSERT INTO forum_users (username, password) VALUES (:username, :password)');
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
    }

    function userExists($username){
        $stmt = $this->db->prepare('SELECT id FROM forum_users WHERE username = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    function checkLogin($username, $password){
        $stmt = $this->db->prepare('SELECT * FROM forum_users WHERE username = :username AND password = :password');
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    function getThreads(){
        $stmt = $this->db->prepare('SELECT * FROM forum_threads');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function addThread($name){
        $stmt = $this->db->prepare('INSERT INTO forum_threads (name) VALUES (:name)');
        $stmt->bindValue(":name", $name);
        $stmt->execute();
    }

    function getMessages($threadID){
        $stmt = $this->db->prepare('SELECT * FROM forum_messages WHERE threadID = ?');
        $stmt->execute([$threadID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function addMessage($threadID, $name, $message){
        $stmt = $this->db->prepare('INSERT INTO forum_messages (threadID, name, message) VALUES (:threadID, :name, :message)');
        $stmt->bindValue(":threadID", $threadID);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":message", $message);
        $stmt->execute();
    }

    function deleteMessage($messageID){
        $stmt = $this->db->prepare('DELETE FROM forum_messages WHERE messageID = :messageID');
        $stmt->bindValue(":messageID", $messageID);
        $stmt->execute();
    }
}

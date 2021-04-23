<?php
class ConnexionSqli
{
    private static $_dbname = "user";
    private static $_user = "root";
    private static $_pwd = "";
    private static $_host = "localhost";
    private static $_bdd = null;
    private function __construct()
    {
        try {
            self::$_bdd =  mysqli_connect(self::$_host,self::$_user,self::$_pwd,self::$_dbname);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public static function getInstance()
    {
        if (!self::$_bdd){
            new ConnexionSqli();
            return (self::$_bdd);
        }return (self::$_bdd);
    }
}
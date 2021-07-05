<?php
   class Database{
      public $db;
      private static $dns = "mysql:host=localhost;dbname=colegioispa";
      private static $user = "root";
      private static $pass = "";
      private static $instance;
      
      public function __construct(){
         $this->db = new PDO(self::$dns, self::$user, self::$pass);
     }

     public static function getInstance(){
      if(!isset(self::$instance)){
          $object = __class__;
          self::$instance = new $object;
      }
      return self::$instance;
  }



  public function insertar($nombre){

   try {
       $conexion = database::getInstance();
       $query = $conexion->db->prepare("INSERT INTO  materia (nombre) VALUES (:nombre)");
       $query->execute(
           array(
               
               ':nombre' => $nombre
               
           )
           );
       return 1;

   } catch(PDOexception $error){
       return 0;
   }

}
 
public function validarNombre($nombre){
    $conexion = Database:: getInstance();
    $query = $conexion->db->prepare("SELECT * FROM materia WHERE nombre =:nombre");
    $query->execute(
        array(
            ":nombre" => $nombre
        )
        );
    return ($query);
}


   }




?>
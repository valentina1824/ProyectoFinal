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



  public function insertar( $Numero_de_identificacion, $Nombres, $Apellidos, $Correo_electronico, $Contraseña, $Confirma_tu_contraseña){

   try {
       $conexion = database::getInstance();
       $query = $conexion->db->prepare("INSERT INTO  users ( Numero_de_identificacion, Nombres, Apellidos, Correo_electronico, Contraseña, Confirma_tu_contraseña ) VALUES (  :Numero_de_identificacion, :Nombres, :Apellidos, :Correo_electronico, :Contraseña, :Confirma_tu_contraseña)");
       $query->execute(
           array(
               
               ':Numero_de_identificacion' => $Numero_de_identificacion, 
               ':Nombres' => $Nombres,
               ':Apellidos' => $Apellidos, 
               ':Correo_electronico' => $Correo_electronico,
               ':Contraseña' => $Contraseña,
               ':Confirma_tu_contraseña' => $Confirma_tu_contraseña,
           )
           );
       return 1;

   } catch(PDOexception $error){
       return 0;
   }

}

public function validarNumero_de_dentificacion($Numero_de_identificacion){
    $conexion = Database:: getInstance();
    $query = $conexion->db->prepare("SELECT * FROM users WHERE Numero_de_identificacion=Numero_de_identificacion");
    $query->execute(
        array(
            ":Numero_de_identificacion" => $Numero_de_identificacion
            
        )
        );
    return ($query);
}

public function users(){
    $conexion = Database::getInstance();
    $result = $conexion->db->prepare("SELECT Numero_de_identificacion, Nombres, Apellidos, Correo_electronico, Contraseña, Confirma_tu_contraseña  FROM Numero_de_identificacion, Nombres, Apellidos, Correo_electronico, Contraseña, Confirma_tu_contraseña");
    $result->execute();
    return $result;
}

    }
?>
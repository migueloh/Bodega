<?php
class VinosController{
    
    private $conectar;
    private $conexion;

    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/Vino.php";
        
        $this->conectar=new Conectar();
        $this->conexion=$this->conectar->conexion();

    }

   /**
    * Ejecuta la acción correspondiente.
    *
    */
    public function run($accion){
        switch($accion)
        { 

            case "alta" :
                $this->crear();
                break;
            case "detalleCrearVino" :
                $this->detalleCrearVino();
                break;
            case "actualizar" :
                $this->actualizar();
                break;
            case "delete" :
                $this->delete();
                break;
           
        }
    }
    

    
   /**
    * Crea un nuevo empleado a partir de los parámetros POST 
    * y vuelve a cargar el index.php.
    *
    */
    public function crear(){
        if(isset($_POST["nombre"])){

            $vino=new Vino($this->conexion);
            $vino->setNombre($_POST["nombre"]);
            $vino->setDescripcion($_POST["descripcion"]);
            $vino->setAnio($_POST["anio"]);
            $vino->setTipo($_POST["tipo"]);
            $vino->setPorcentajeAlcohol($_POST["porcentajeAlcohol"]);
            $vino->setIdBodega($_POST["idBodega"]);

            $save=$vino->save();
        }
        header('Location: index.php?controller=bodegas&action=detalleBodega&id='.$vino->getIdBodega());
    }
   
    //FUNCION ACTUALIZAR
    public function actualizar(){
        /*if(!isset($_GET["actualizar"])){          
             //Creamos un usuario
            $bodega=new Bodega($this->conexion);
            $bodega->setIdBodega($_GET["id"]);
            $bodega->setDireccion($_POST["direccion"]);
            $bodega->setNombre($_POST["nombre"]);
            $bodega->setEmail($_POST["email"]);
            $bodega->setTelefono($_POST["telefono"]);
            $bodega->setNombreContacto($_POST["nombrePersonaContacto"]);
            $bodega->setFechaFundacion($_POST["fechaFundacion"]);
            $bodega->setHasRestaurante($_POST["hasRestaurante"]);
            $bodega->setHasHotel($_POST["hasHotel"]);
            $actualizar=$bodega->actualizar();

            
           $this->view('detalleBodega', array(
                "bodega"=>$bodega,
                "titulo" => "INFO BODEGA"
            ));*/

        }
        

    public function detalleCrearVino(){
        if(!isset($_GET["detalleCrearVino"])){
            $id=$_GET["id"];
            //Cargamos la vista index y le pasamos valores
            $this->view("detalleCrearVino",$id);
        }
        
    }   

    //FUNCION DELETE
    public function delete (){
        if(!isset($_GET["delete"])){
            $vino=new Vino($this->conexion);
            $vino->delete($_GET["id"]);
            
            header('Location: index.php?controller=bodegas&action=detalleBodega&id='.$_GET["idBodega"]);
        }   
    }
    
   /**
    * Crea la vista que le pasemos con los datos indicados.
    *
    */
    public function view($vista,$datos){
        $data = $datos;  
        require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }

}
?>

<?php
include "logger.php";
/******************************************************************************
 * @Discription Factoty Design Patter
 ******************************************************************************/
/**
 * Factory Design Pattern Interface
 */
interface Computer {
    public function getRAM();
    public function getHDD();
    public function getCPU();
    public function getConfi();
}
/**
 * Factory Design Pattern Sub Class implementation 
 * @var ram of Pc
 * @var hdd harddrive memory of pc
 * @var cpu of pc memory
 */
class Pc implements Computer 
{
    private $ram;
    private $hdd;
    private $cpu;
    /**
     * constructor of pc class 
     */
    public function __construct($ram ,$hdd ,$cpu){
      $this->ram=$ram;
      $this->hdd=$hdd;
      $this->cpu=$cpu;
    }
    /**
     * Function to get the RAM
     */
    public function getRAM(){
        echo "RAM :" . $this->ram . "\n";
    }
     /**
     * Function to get the hdd memory
     */
    public function getHDD(){
        echo "HDD :" . $this->hdd . "\n";
    }
     /**
     * Function to get the cpu memory
     */
    public function getCPU(){
        echo "CPU :" . $this->cpu . "\n";
    }
     /**
     * Function to get pc config
     */
    public function getConfi(){
        echo "->Pc Config... \n";
        Pc::getRAM();
        Pc::getHDD();
        Pc::getCPU();
    }
}
/**
 * Factory Design Pattern Sub Class implementation 
 * @var ram of server
 * @var hdd harddrive memory of server
 * @var cpu of server memory
 */
class Server implements Computer 
{
    private $ram;
    private $hdd;
    private $cpu;
     /**
     * constructor of pc class 
     */
    public function __construct($ram ,$hdd ,$cpu){
      $this->ram=$ram;
      $this->hdd=$hdd;
      $this->cpu=$cpu;
    }
     /**
     * Function to get the RAM
     */
    public function getRAM(){
        echo "RAM :" . $this->ram . "\n";
    }
     /**
     * Function to get the hdd memory
     */
    public function getHDD(){
        echo "HDD :" . $this->hdd . "\n";
    }
     /**
     * Function to get the cpu memory
     */
    public function getCPU(){
        echo "CPU :" . $this->cpu . "\n";
    }
     /**
     * Function to get the server conmfig
     */
    public function getConfi(){
        echo "->Server Config...\n";
        Server::getRAM();
        Server::getHDD();
        Server::getCPU();
    }
}
/**
 * Factory Design Pattern Sub Class implementation 
 * @var ram of loptop
 * @var hdd harddrive memory of loptop
 * @var cpu of loptop memory
 */
class Laptop implements Computer 
{
    private $ram;
    private $hdd;
    private $cpu;
     /**
     * constructor of pc class 
     */
    public function __construct($ram ,$hdd ,$cpu){
      $this->ram=$ram;
      $this->hdd=$hdd;
      $this->cpu=$cpu;
    }
     /**
     * Function to get the RAM
     */
    public function getRAM(){
        echo "RAM :" . $this->ram . "\n";
    }
     /**
     * Function to get the hdd memory
     */
    public function getHDD(){
        echo "HDD :" . $this->hdd . "\n";
    }
     /**
     * Function to get the cpu memory
     */
    public function getCPU(){
        echo "CPU :" . $this->cpu . "\n";
    }
     /**
     * Function to get the loptop config
     */
    public function getConfi(){
        echo "->Laptop Config...\n";
        Server::getRAM();
        Server::getHDD();
        Server::getCPU();
    }
}/**
 * Factory Class
 */
class ComputerFactory
{
    /**
     * Static Function
     * @return sunclasses implemantation according to the parameter passsed 
     */
    public static function getComputer($type ,$ram ,$hdd ,$cpu)
    {
        if(strcasecmp("Pc", $type) == 0){
            return new Pc($ram,$hdd,$cpu);
        }else if (strcasecmp("Server", $type) == 0){
            return new Server($ram,$hdd,$cpu);
        }else if(strcasecmp("Laptop", $type) == 0){
            return new Server($ram,$hdd,$cpu);
        }else{
            return null;
        }
    }

}
/**
 * Cleint side testing class
 */
class Test
{
    public function testing(Computer $ref){
        
        $ref->getConfi();
    }
}
$reference=new Test();
/**
 * client requrement pc/laptops/server
 */
$reference->testing(ComputerFactory::getComputer("Server","16 GB","1 TB","2.9 GHz"));
$reference->testing(ComputerFactory::getComputer("pc","2 GB","500 GB","2.4 GHz"));
$reference->testing(ComputerFactory::getComputer("laptop","8 GB","1000 GB","2.6 GHz"));





































// interface VehicleMaker
// class Automobile
// {
//     private $vehicleMake;
//     private $vehicleModel;

//     public function __construct($make, $model)
//     {
//         $this->vehicleMake = $make;
//         $this->vehicleModel = $model;
//     }

//     public function getMakeAndModel()
//     {
//         return $this->vehicleMake . " " . $this->vehicleModel;
//     }
// }

// class AutomobileFactory
// {
//     public static function create($make, $model)
//     {
//         return new Automobile($make, $model);
//     }
// }

// // have the factory create the Automobile object
// $veyron = AutomobileFactory::create('Bugatti', 'Veyron');

// print_r($veyron->getMakeAndModel()); // outputs "Bugatti Veyron" -->
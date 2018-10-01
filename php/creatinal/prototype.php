<?php
include "logger.php";
/******************************************************************************
 * @Discription Factoty Design Patter
 ******************************************************************************/
/**
 * Abstract class which clone abstract method
 */
abstract class BookStore {
    protected $topic;
    protected $book;
    abstract function __clone();
    function setTopic($topic) {
        $this->topic = $topic;
    }
}
/**
 * Cloneable Sub class 
 */
class JavaBook extends BookStore {
    /**
     * constructor of the class 
     * decides which book the class represents
     */
    function __construct() {
        $this->book = "JAVA";
    }
    /**
     * making class cloneable
     */
    function __clone() {
    }
    /**
     * function to read the class objects parameters
     */
    public function read($time){
        echo "opening " . $this->book ." book " . $time ." time and \n";
        echo "Reading " . $this->topic . " in " . $this->book . "\n";
    }
}
/**
 * Cloneable Sub class 
 */
class PythonBook extends BookStore {
     /**
     * constructor of the class 
     * decides which book the class represents
     */
    function __construct() {
        $this->book = "Python";
    }
     /**
     * making class cloneable
     */
    function __clone() {
    }
    /**
     * function to read the class objects parameters
     */
    public function read($time){
        echo "opening " . $this->book ." book " . $time ." time and \n";
        echo "Reading " . $this->topic . " in " . $this->book . "\n";
    }
}
 /**
  * Prototype pattern design...
  */
  $javaorig = new JavaBook();
  $pythomorig = new PythonBook();
  /**
   * creating the clone object and accesing
   * @var topicjava1 cloned object reference
   * @var topicJava2 cloned object reference
   */
  $topicJava1 = clone $javaorig;
  $topicJava1->setTopic("basics");
  $topicJava1->read("1st");
  $topicJava2 = clone $javaorig;
  $topicJava2->setTopic("oops");
  $topicJava2->read("2nd");
  echo "\n";
   /**
   * creating the clone object and accesing
   * @var topicPython1 cloned object reference
   * @var topicPython2 cloned object reference
   */
  $topicPython1 = clone $pythomorig;
  $topicPython1->setTopic("basics");
  $topicPython1->read("1st");
  $topicPython2 = clone $pythomorig;
  $topicPython2->setTopic("oops");
  $topicPython2->read("2nd");


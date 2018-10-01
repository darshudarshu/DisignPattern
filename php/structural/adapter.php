<?php 
include "logger.php";
/*******************************************************************
 *@Discription : ADAPTER DESIGN PATTERN
 *******************************************************************/
/**
 * Class to measure voltage which reads and sets voltage
 * @var volt voltage
 */
class Volt
{
   private $volt;
   /**
    * class constructor sets user volts
    */
   public function __construct($volt)
   {
        $this->volt=$volt;
   }
   /**
    * Function to get volts
    */
   public function getVolts()
   {            
       return $this->volt;
   }
    /**
    * Function to set volts
    */
   public function setVolts($volt)
   {
       $this->volt=$volt;
   }

}
/**
 * Class to produce constant volt of 120  voltage
 */
class Socket 
{
    public function getVolt()
    {
        return new Volt(120);
    }
}
/**
 * Adapter interface produce 3 , 12 and default 120 voltage
 */
interface SocketAdapter
{
    public function get120Volt();
    public function get12Volt();
    public function get3Volt();
}
/**
 * TWO WAY ADAPTER PATTERN
 * class adapter
 * which extends Socket class to get the main voltage
 * implements SocketAdapter for conversion purpose
 */
class SocketClassAdapterImpli extends Socket implements SocketAdapter
{
    /**
     * get 120v from Socket
     */
    public function get120Volt(){
        return Socket::getVolt();
    }
     /**
     * get 12v from Socket
     */
    public function get12Volt(){
        $voltref=Socket::getVolt();
        return SocketClassAdapterImpli::convertVolts($voltref,10);
    }
    /**
     * get 3v from Socket
     */
    public function get3Volt(){
        $voltref=Socket::getVolt();
        return SocketClassAdapterImpli::convertVolts($voltref,40);
    }
    /**
     * coversion Process
     */
    public function convertVolts($voltref ,$volt)
    {
        return new Volt($voltref->getVolts()/$volt);
    }
}

/**
 * Object adapter
 * which holds object of Socket class to get the main voltage
 * implements SocketAdapter for conversion purpose
 */
class SocketObjectAdapterImpl implements SocketAdapter
{
    private $sock;
    /**
     * constructor to get the Object of Socket class
     */
    public function __construct(){
        $this->sock = new Socket();
    }
     /**
     * get 120v from Socket
     */
	public function get120Volt() {
		return $this->sock->getVolt();
    }
    /**
     * get 12v from Socket
     */
	public function get12Volt() {
		$voltref= $this->sock->getVolt();
		return SocketObjectAdapterImpl::convertVolt($voltref,10);
    }
     /**
     * get 3v from Socket
     */
	public function get3Volt() {
		$voltref= $this->sock->getVolt();
		return SocketObjectAdapterImpl::convertVolt($voltref,40);
	}
	/**
     * coversion Process
     */
	private function convertVolt($voltref,$volt) {
		return new Volt($voltref->getVolts()/$volt);
	}
}
/**
 * class to test the adapter pattern 
 */
 class AdapterPatternTest {
	/**
     * function calling 
     * @Class type adapter
     * @Object type adapter
     */
    public function test(){
        AdapterPatternTest::testClassAdapter();
        AdapterPatternTest::testObjectAdapter();
    }
    /**
     * object adapter testing
     * @var sockAdapter holds the object adress of SocketObjectAdapterImpl class
     */
    private static function testObjectAdapter() 
    {
        $sockAdapter = new SocketObjectAdapterImpl();
        echo "Choose Object ADAPTER \n";
        echo "Enter 3 : 3V SOCKET ADAPTER\n";
        echo "Enter 12 : 12V SOCKET ADAPTER\n";
        echo "Enter 120 : 120V SOCKET ADAPTER\n";
        $choose=AdapterPatternTest::getInt();
        if ($choose == 3 || $choose == 120 || $choose == 12 )
        {
        $v = AdapterPatternTest::getVolt($sockAdapter,$choose);
        echo $choose . " volts using Class Adapter=" . $v->getVolts() . "v\n\n";
        }else{
            echo "SORRY INVALID SOCKET ADAPTER\n\n";
            AdapterPatternTest::testObjectAdapter();
        }
	}
     /**
     * object adapter testing
     * @var sockAdapter holds the object adress of SocketClassAdapterImpli class
     */
    private static function testClassAdapter() 
    {
        $sockAdapter = new SocketClassAdapterImpli();
        echo "Choose Class ADAPTER \n";
        echo "Enter 3 : 3V SOCKET ADAPTER \n";
        echo "Enter 12 : 12V SOCKET ADAPTER\n";
        echo "Enter 120 : 120V SOCKET ADAPTER\n";
        $choose=AdapterPatternTest::getInt();
        if ($choose == 3 || $choose == 120 || $choose == 12 )
        {
        $v = AdapterPatternTest::getVolt($sockAdapter,$choose);
        echo $choose . " volts using Class Adapter=" . $v->getVolts() . "v\n\n";
        }else{
            echo "SORRY INVALID SOCKET ADAPTER\n\n";
            AdapterPatternTest::testClassAdapter();
        }
	}
	/**
     * function takes type of voltage neeed
     * @return corrresponding voltage
     */
	private static function getVolt(SocketAdapter $sockAdapter, $i) {
		switch ($i){
		case 3: return $sockAdapter->get3Volt();
		case 12: return $sockAdapter->get12Volt();
		case 120: return $sockAdapter->get120Volt();
		default: return $sockAdapter->get120Volt();
		}
    }
    /**
     * function to validate integer
     */
    public function getInt()
    {
        fscanf(STDIN, '%d', $num);
        if (filter_var($num, FILTER_VALIDATE_INT)) {
            return $num;
        } else {
            echo "enter valid number  \n";
            return AdapterPatternTest::getInt();
        }
    }
}
/**
 * User interface
 */
$ref=new AdapterPatternTest();
$ref->test();
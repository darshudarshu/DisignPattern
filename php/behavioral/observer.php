
<?php
include "logger.php";
/*************************************************************************
 * @Discrption : OBSERVER DESIGN PATTERN
 *************************************************************************/
interface Subject
{
/**
 * methods to register and unregister observers
 */  
 public function register($obj);
    public function unregister($obj);
/**
 * method to notify observers of change
 */  
 public function notifyObservers();
/**
 * method to get updates from subject
 */  
 public function getUpdate($obj);
}

/**
 * subject class impli
 * @var observers array of observers
 * @var massage new msg
 * @var changed to check new updates
 */
class MyTopic implements Subject
{
    private $observers;
    private $message;
    private $changed = false;
    /**
     * constructor to initialize observer array
     */
    public function __construct()
    {
        $this->observers = array();
    }
    /**
    * method to register the observers
    */ 
    public function register($obj)
    {
        if ($obj == null) {
            throw new NullPointerException("Null Observer");
        }
        if (!(in_array($obj, $this->observers))) {
            $this->observers[] = $obj;
        }
    }
    /**
    * method to unregister the observers
    */ 
    public function unregister($obj)
    {
        if (in_array($obj, $this->observers)) {
            unset($this->observers[array_search($obj, $this->observers)]);
        }
    }
    /**
    * method to notify to the observers
    */ 
    public function notifyObservers()
    {
        $observersLocal = null;
        if (!$this->changed) {
            return;
        }

        $observersLocal = $this->observers;
        $this->changed = false;

        foreach ($observersLocal as $obj) {
            $obj->update();
        }
    }
    /**
     * function to  show up new msg to observer
     */
    public function getUpdate($obj)
    {
        return $this->message;
    }
    /**
     * function to update msg in subject and notify to the observer
     */
    public function postMessage($msg)
    {
        echo "Message Posted to Subject: ", $msg, "\n";
        $this->message = $msg;
        $this->changed = true;
        MyTopic::notifyObservers();
    }
}
interface Observer
{
/**
 * method to update the observer, used by subject
 */  
 public function update();
/**
 * attach with subject to observe
 */  
 public function setSubject($sub);
}
/**
 * observer class
 */
class MyTopicSubscriber implements Observer
{
    private $name;
    private $topic;
    public function __construct($name)
    {
        $this->name = $name;
    }
    /**
     * function to get the updates of subject
     */
    public function update()
    {
        $msg = (string) $this->topic->getUpdate($this);
        if ($msg == null) {
            echo $this->name, ": No new message", "\n";
        } else {
            echo $this->name, ": Consuming message: ", $msg, "\n";
        }

    }
    /**
     * function to set the subject to the obeserver
     * @var topic hold the subject address 
     */
    public function setSubject($sub)
    {
        $this->topic = $sub;
    }
}
/**
 * testing class
 */
class ObserverPatternTest
{
    public function main()
    {
        /**
         * create subject
         */
        $topic = new MyTopic();
        /**
         * create observers
         */
        $obj1 = new MyTopicSubscriber("Observer1");
        $obj2 = new MyTopicSubscriber("Observer2");
        $obj3 = new MyTopicSubscriber("Observer3");
        /**
         * register observers to the subject
         */
        $topic->register($obj1);
        $topic->register($obj2);
        $topic->register($obj3);
        $topic->unregister($obj3);
        /**
         * attach observer to subject
         */
        $obj1->setSubject($topic);
        $obj2->setSubject($topic);
        $obj3->setSubject($topic);
        /**
         * check if any update is available
         */
        $obj1->update();
        $obj2->update();
        $obj3->update();
        /**
         * now send message to subject
         */
        echo "enter new message to the subject\n";
        $message=readline();
        $topic->postMessage($message);
    }
}
/**
 * user interface
 */
$ref = new ObserverPatternTest();
$ref->main();

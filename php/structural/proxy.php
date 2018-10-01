<?php
include "logger.php";
/*****************************************************************************
 * @Discrption :PROXY DESIGN PATTERN
 ****************************************************************************/
/**
 * Interface provide run command function
 * @var cmd command provided from user
 */
interface CommandExecutor
{
    public function runCommand($cmd);
}
/**
 * implementation class to interface
 */
class CommandExecutorImpl implements CommandExecutor
{
    /**
     * function runs command in terminal prints result
     * @var results terminal results
     */
    public function runCommand($cmd)
    {
        echo "Results :\n";
        $results = shell_exec($cmd);
        echo "'" . $cmd . "' command executed.\n";
        echo $results ;
    }

}
/**
 * Proxy pattern design class
 * @var isAdmin validate the user
 * @var executor holds the object of CommandExecutorImpl class
 */
class CommandExecutorProxy implements CommandExecutor
{

    private $isAdmin = false;
    private $executor;
    /**
     * constructor validate the user and creates the object of CommandExecutorImpl class 
     */
    public function __construct($user)
    {
        if (strcasecmp("darshu", $user) == 0) {
            $this->isAdmin = true;
        }
        $this->executor = new CommandExecutorImpl();
    }
    /**
     * function to execute the valid commands in the terminal according to user
     */
    public function runCommand($cmd)
    {
        if ($this->isAdmin) {
            $this->executor->runCommand($cmd);
        } else {
            if (CommandExecutorProxy::startsWith(trim($cmd), "rm")) {
                throw new Exception("rm command is not allowed for non-admin users.\n");
            } else {
                $this->executor->runCommand($cmd);
            }
        }
    }
    /**
     * logic to check sub string present in given string or not
     * @var main given string
     * @var sub given substring
     */
    public function startsWith($main, $sub)
    {
        $length = strlen($sub);
        return (substr($main, 0, $length) === $sub);
    } 

}
/**
 * test class
 */
class ProxyPatternTest
{
    /**
     * function take command from user
     */
    public static function main($name)
    {
        $executor = new CommandExecutorProxy($name);
        try {
            echo "enter the command\n";
            $command=readline();
            $executor->runCommand($command);
            // $executor->runCommand(" rm -rf abc.pdf");
        /**
         * exception handling
         */
        }catch (Exception $e) {
            echo "Exception Message::" . $e->getMessage() . "\n";
        }

    }

}
/**
 * takeing user entry
 */
echo "enter the user name\n";
$name=readline();
$ref = new ProxyPatternTest();
$ref->main($name);
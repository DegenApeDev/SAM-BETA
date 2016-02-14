<?php

namespace SAM;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
class web extends PluginBase {
  public function onEnable(){
    $this->getServer()->getScheduler()->scheduleRepeatingTask(new Task($this), 20);
  }
  public function action($array){
    $username = $array["username"]; 
    $password = $array["password"]; 
    
  }
}
class Task extends PluginTask {
  public $plugin;
  public function __construct($plugin){
    $this->plugin = $plugin;
    $this->start = false;
    parent::__construct($plugin);
  }
  public function onRun($ticks){
    if ($this->start){
      $requesturl = "yourdomain.com/the/core/directory/to/your/file/example.txt";
      $file_headers = @get_headers($requesturl);
        if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
           $file_exists = false;
        }
        else {
           $file_exists = true;
        }
      if ($file_exists === true){
        $data = json_decode(file_get_contents("yourdomain.com/the/core/directory/to/your/file/data.json"), true);
        if (isset($data["username"])){
          $this->plugin->action($data);
        }
      }
    }
    else{
      $this->start = true;
    }
  }
}
?>
<?php

$username = $_POST["username"];
$password = $_POST["password"];
if (is_file("example.txt")){
  unlink("example.txt");
}
$data = fopen("example.txt", "w+");
fwrite($data, "open"); 
fclose($data);
$login = fopen("data.json", "w+");
fwrite($login, json_encode(array("username" => $username, "pswd" => $password)));
fclose($login);

class MainClass extends PluginBase implements Listener{
    public function onEnable()
    {
        $this->getLogger()->info("[SAM] SAM v0.0.1 enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onDisable()
    {
        $this->getLogger()->info("[SAM] SAM v0.0.1 disabled");
    }
    function onJoin(PlayerJoinEvent $event)
    {
        $name = $event->getPlayer()->getDisplayName();    
        if ($registered = FALSE){
        $name->sendMessage("[{$this->getConfig()->get("prefix")}] Hello " . $name . " this server use SAM by EndKingdom. You must register at " .          $url . " to play");  
    }
    if ($registered = TRUE){
        //$registered is whether or not the player is registered. Set it to retrieve the players info from the $url
        $name->sendMessage("[{$this->getConfig()->get("prefix")}] Hello" . $name . " To play you must login with /login (your password)");  
       //$url is the url of the users website
    }
  }
}

?>

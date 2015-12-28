<?phpnamespace SAM;
use pocketmine\command\Command;
use pocketmine\command\ComamndSender;

class LoginCommand{
public function onCommand(CommandSender $sender, Command $command, $label, array $args){
$commandName = $command->getName();
if($commandName === "login"){
return true;
}
return false;
}
}

<?php
namespace CapricornOfLynx\Sizer\command;

use CapricornOfLynx\Sizer\loader;

use pocketmine\command\PluginCommand;
use pocketmine\plugin\Plugin;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class size extends PluginCommand
{

    public function __construct(Plugin $plugin)
    {
        parent::__construct("size", $plugin);
        $this->setDescription('change your size.');
        $this->setUsage('/size <1-5|about>');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
         if ($sender instanceof Player) 
        {
            if ($sender->hasPermission('playersize.size'))
             {
                if (count($args) == 1) 
                {
                    if (is_numeric($args[0]))
                    {
                        if ($args[0] >= 1 && $args[0] <= 5)
                        {
                            $sender->setScale($args[0]);
                            $sender->sendMessage(loader::PREFIX.'§dYou have set your size to §5'.$args[0]);
                        }
                    }
                    elseif (strtolower($args[0]) == 'about')
                    {
                        $sender->sendMessage(loader::PREFIX.'§cNot showing due to self leak information.');
                    }
                    elseif (strtolower($args[0]) == 'reset')
                    {
                        $sender->setScale(1);
                        $sender->sendMessage(loader::PREFIX.'§dYour size has been reset succesfully!');
                    }
                    else
                    {
                        $sender->sendMessage(loader::PREFIX.'§2You must specify the size numerically!');
                    }
                }
                else
                {
                    $sender->sendMessage(loader::PREFIX.'§bPlease use: §a/size <0.5-5|about>');
                }
            }
            else
            {
                $sender->sendMessage(loader::PREFIX.'§2You are not allowed to execute this command!');
            }
        }
        else
        {
            $sender->sendMessage(loader::PREFIX.loader::CONSOLE_SENDER);
        }
    }
}

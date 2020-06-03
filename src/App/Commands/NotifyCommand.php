<?php
namespace Console\App\Commands;
 
use Console\App\Models\User;
use Console\App\Models\Order;
use Console\App\Factories\NotifierFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Console\App\Exceptions\ModelNotFoundException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NotifyCommand extends Command
{
    protected function configure()
    {
        $this->setName('notify')
            ->setDescription('Notify user about order has been completed!')
            ->setHelp('Notify user through email, sms, pusher and/or firebase.')
            ->addArgument('notifier', InputArgument::REQUIRED, 'Pass the name of notifier.')
            ->addArgument('user_id', InputArgument::REQUIRED, 'Pass the id of customer.')
            ->addArgument('order_id', InputArgument::REQUIRED, 'Pass the id of order.');
            
            //TODO validate arguments    
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("\xE2\x9C\x94 Process strating");
        
        // fetch data
        [$user, $order] = $this->getData($input->getArgument('user_id'), $input->getArgument('order_id'));
        $output->writeln(sprintf("\xE2\x9C\x94 Objects found and loaded: user_name: %s , order_id: %s", $user['name'], $order['id']));
        

        $notifierFactory = new NotifierFactory;
        $notifier = $notifierFactory->getNotifier($input->getArgument('notifier'));
        $output->writeln("\xE2\x9C\x94 Notifier loaded");

        $notifier->setup($user, $order);
        $output->writeln("\xE2\x9C\x94 Notifier has been setup");

        $output->writeln("... Notification sending");
        try{
            $notifier->notify();
        } catch(\Exception $e){
            $output->writeln("\xE2\x9D\x8C Error occured while sending notification");
            return 1;
        }

        $output->writeln("\xE2\x9C\x94 Notification successfully sent");
        return 0;
    }

    // Get data from database with params
    protected function getData($user_id, $order_id)
    {
        // create instanse of model
        $users = new User();
        $orders = new Order();

        // find model with id
        $users = $users
            ->select()
            ->where(['id'=> $user_id])
            ->get();

        // find model with id and user_id
        $orders = $orders
            ->select()
            ->where(['id' => $order_id, 'user_id' => $user_id], 'AND')
            ->get();
        
        if (count($users) == 0){
            throw new ModelNotFoundException('user');
        }

        if (count($orders) == 0){
            throw new ModelNotFoundException('order');
        }

        return [$users[0], $orders[0]];
    }
}
<?php
namespace Console\App\Commands;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class NotifyCommand extends Command
{
    protected function configure()
    {
        $this->setName('Notify')
            ->setDescription('Notify user about order has been completed!')
            ->setHelp('Notify user through email, sms, pusher and/or firebase.')
            ->addArgument('customer_id', InputArgument::REQUIRED, 'Pass the id of customer.');
            ->addArgument('order_id', InputArgument::REQUIRED, 'Pass the id of order.');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Notifying!, %s, %s', $input->getArgument('customer_id'), $input->getArgument('order_id')));
        return 0;
    }
}
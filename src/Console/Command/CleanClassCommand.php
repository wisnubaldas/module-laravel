<?php

namespace Wisnubaldas\CleanClass\Console\Command;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Wisnubaldas\CleanClass\Infrastructure\CleanClass;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Wisnubaldas\CleanClass\Console\CommandTrait;
class CleanClassCommand extends Command
{
    use CommandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cc:make {class_name} {--M|module} {--R|route}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin CRUD clean class base';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle(CleanClass $cc)
    {
        $std = new class{};
        $std->status = 'ok';
        $std->setnya = 'Router apa yg mau di buat...? Default bikin router ';
        // $this->show_status($std);

        $model = $this->argument('class_name');
        $choice = $this->choice(
            $this->yellow($std->setnya),
            ['web', 'api'],
            'web',
            $maxAttempts = null,
            $allowMultipleSelections = false
        );

        $result = $cc::run(
                            $model,
                            $choice,
                            $this->option('module'),
                            $this->option('route')
                        );
                        
        $this->parsing_status($result);
        return Command::SUCCESS;
    }
    
}
/*
custom color bapak
black, red, green, yellow, blue, magenta, cyan, white, default, 
gray, bright-red, bright-green, bright-yellow, 
bright-blue, bright-magenta, bright-cyan, bright-white
*/
<?php

namespace Wisnubaldas\ConsoleInLaravel\Local;

use Illuminate\Console\Command;
use Wisnubaldas\ConsoleInLaravel\Driver\MakeStub;
use Illuminate\Filesystem\Filesystem;
class DriverCommand extends Command
{
    use MakeStub;
    protected $stub_name;
    protected $name_space;
    protected $path_nya;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cc:driver {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin trait driver';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->stub_name = 'driver.stub';
        $this->name_space = 'App\\Driver';
        $this->path_nya = base_path('app/Driver');
    }
    public function handle()
    {
        $path = $this->getSourceFilePath();
        $this->makeDirectory(dirname($path));
        $contents = $this->getSourceFile();
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }
        return Command::SUCCESS;
    }
}

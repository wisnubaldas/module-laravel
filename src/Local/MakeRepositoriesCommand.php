<?php

namespace Wisnubaldas\CleanClass\Local;

use Illuminate\Console\Command;
use Wisnubaldas\CleanClass\Driver\MakeStub;
use Illuminate\Filesystem\Filesystem;

class MakeRepositoriesCommand extends Command
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
    protected $signature = 'make:repositories {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin class repositories ';
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->stub_name = 'repo.stub';
        $this->name_space = 'App\\Repositories';
        $this->path_nya = base_path('app/Repositories');
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
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

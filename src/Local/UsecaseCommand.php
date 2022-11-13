<?php

namespace Wisnubaldas\CleanClass\Local;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
// use App\Driver\MakeStub;
use Wisnubaldas\CleanClass\Driver\CommandStub;

class UsecaseCommand extends Command
{
    use CommandStub;
    protected $stub_name;
    protected $name_space;
    protected $path_nya;
    protected $className;
    protected $interfaceName;
    protected $extendClass;
    protected $useClass;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:usecase {name} {--E|extend=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin class usecase, {-E} extend {nama class}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->stub_name = 'usecase.stub';
        $this->name_space = 'App\\UseCase';
        $this->path_nya = 'app/UseCase';
        
    }
    public function handle()
    {
        $i = $this->argument('name');
        $o = $this->option('extend');
        if(!$o){
            // prepare
            $this->extract_name($i);
            $this->interfaceName = $this->className.'Interface';
            $this->className = $this->className.'Case';

            $path = $this->getSourceFilePath($this->className);
            $this->makeDirectory(base_path($this->path_nya));
            // simpen file nya
            $contents = $this->getSourceFile();
            if (!$this->files->exists($path)) {
                $this->files->put($path, $contents);
                $this->info("File : {$path} created");
            } else {
                $this->info("File : {$path} already exits");
            }
            
            $this->path_nya = 'app/UseCase/Contract';
            $this->stub_name = 'domain_interface.stub';
            $this->name_space = 'App\\UseCase\\Contract';

            $path = $this->getSourceFilePath($this->interfaceName);
            $this->makeDirectory(base_path($this->path_nya));
            $contents = $this->getSourceFile();
            if (!$this->files->exists($path)) {
                $this->files->put($path, $contents);
                $this->info("File : {$path} created");
            } else {
                $this->info("File : {$path} already exits");
            }
        }else{
            $this->stub_name = 'domain_extend.stub';
            
            $this->extract_name($i);
            $this->className = $this->className.'Case';
            
            $this->useClass = $this->name_space.'\\'.str_replace('/','\\',$o);

            $this->extendClass = str_replace('/','\\',$o);
            $path = $this->getSourceFilePath($this->className);
            $this->makeDirectory(base_path($this->path_nya));
            // simpen file nya
            $contents = $this->getSourceFile();
            if (!$this->files->exists($path)) {
                $this->files->put($path, $contents);
                $this->info("File : {$path} created");
            } else {
                $this->info("File : {$path} already exits");
            }
        }
        return Command::SUCCESS;
    }
}

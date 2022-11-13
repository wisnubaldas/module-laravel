<?php

namespace Wisnubaldas\CleanClass\Local;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
// use App\Driver\MakeStub;
use Wisnubaldas\CleanClass\Driver\CommandStub;

class DomainCommand extends Command
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
    protected $signature = 'make:domain {name} {--E|extend=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin class domain, 
                            {name : Nama class untuk domainnya}
                            {--extend|-E : Class domain yg akan di extend} ';
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->stub_name = 'domain.stub';
        $this->name_space = 'App\\Domain';
        $this->path_nya = 'app/Domain';
        
    }
    
    public function handle()
    {
        $i = $this->argument('name');
        $o = $this->option('extend');
        if(!$o){
            // prepare
            $this->extract_name($i);
            $this->interfaceName = $this->className.'Interface';
            $this->className = $this->className.'Domain';

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
            
            $this->path_nya = 'app/Domain/Contract';
            $this->stub_name = 'domain_interface.stub';
            $this->name_space = 'App\\Domain\\Contract';

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
            $this->className = $this->className.'Domain';
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

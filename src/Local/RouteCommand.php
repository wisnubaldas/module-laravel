<?php

namespace Wisnubaldas\CleanClass\Local;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Wisnubaldas\CleanClass\Driver\CommandStub;
class RouteCommand extends Command
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
    protected $signature = 'cc:route {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin route nya pisah';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->stub_name = 'routes.stub';
        $this->name_space = 'App\\UseCase';
        $this->path_nya = 'routes/web';
    }
    public function handle()
    {
        $name = $this->argument('name');
        $choice = $this->choice(
            'Router apa yg mau di buat...?'.PHP_EOL.
            ' Default bikin router di web..!!',
            ['web', 'api'],
            'web',
            $maxAttempts = null,
            $allowMultipleSelections = false
        );

        switch ($choice) {
            case 'api':
                $this->path_nya = 'routes/api';
                break;
            
            default:
                true;
                break;
        }

            $this->extract_name($name);
            $this->className = \strtolower($this->className);
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

        return Command::SUCCESS;
    }
}

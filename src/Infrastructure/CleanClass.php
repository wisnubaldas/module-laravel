<?php
namespace Wisnubaldas\ConsoleInLaravel\Infrastructure;
class ConsoleInLaravel extends StubCreator
{
    public $class_name;
    public $option;
    public $choice;
    public $set_respon = [];

    public function create_route($choice)
    {

        $dir = rtrim(dirname(__DIR__,4), '/\\') . 
                    DIRECTORY_SEPARATOR . 'routes'.
                    DIRECTORY_SEPARATOR.$choice.
                    DIRECTORY_SEPARATOR.strtolower($this->class_name).'.php';
        $fileDir = $this->cek_file($dir);
        if($fileDir->status == 'error'){
            $stub = $this->load_stub('routes');
            $this->create_stub_file($dir,$stub,[
                'class'=>strtolower($this->class_name)
            ]);
        }
        $this->set_respon[] = $fileDir;
        return $this;
    }
    public function create_controller()
    {
        $dir = rtrim(dirname(__DIR__,4), '/\\') . 
                    DIRECTORY_SEPARATOR . 'app'.
                    DIRECTORY_SEPARATOR.'Http'.
                    DIRECTORY_SEPARATOR.'Controllers'.
                    DIRECTORY_SEPARATOR.$this->class_name.'Controller.php';
        $fileDir = $this->cek_file($dir);
        if($fileDir->status == 'error'){
            $stub = $this->load_stub('controller');
            $this->create_stub_file($dir,$stub,[
                'rootNamespace'=>'Illuminate\\',
                'namespace'=>'App\Http\Controllers',
                'class'=>$this->class_name
            ]);
        }
        $this->set_respon[] = $fileDir;
        return $this;
    }

    // model directory normal model nya laravel
    public function create_model()
    {
        // \dump($this->class_name);
        $dir = rtrim(dirname(__DIR__,4), '/\\') . 
                    DIRECTORY_SEPARATOR . 'app'.
                    DIRECTORY_SEPARATOR.'Models'.
                    DIRECTORY_SEPARATOR.$this->class_name.'.php';
        $fileDir = $this->cek_file($dir);

        if($fileDir->status == 'error'){
            $stub = $this->load_stub('model');
            $this->create_stub_file($dir,$stub,[
                'namespace'=>'App\Models',
                'class'=>$this->class_name
            ]);
        }
        $this->set_respon[] = $fileDir;
        return $this;
    }

    static public function run($model,$choice,...$option)
    {
        $run =  new CleanClass;
        $run->class_name = \ucfirst($model);
        $run->choice = $choice;
        $run->option = $option;
        return $run->create_controller()
                    ->create_model()
                    ->create_route($choice);
    }
}

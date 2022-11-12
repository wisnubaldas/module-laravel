<?php
namespace Wisnubaldas\CleanClass\Driver;
trait CommandStub {
    public function getStubVariables()
    {
        return [
            'NAMESPACE'         => $this->name_space,
            'CLASS_NAME'        => $this->className,
            'INTERFACE'         => $this->interfaceName,
            'EXTEND'            => $this->extendClass,
            'USE_CLASS'         => $this->useClass,
        ];
    }
    public function getStubPath()
    {
        return base_path('stubs/'.$this->stub_name);
    }
   public function getStubContents($stub , $stubVariables = [])
   {
       $contents = file_get_contents($stub);

       foreach ($stubVariables as $search => $replace)
       {
           $contents = str_replace('{{'.$search.'}}' , $replace, $contents);
       }

       return $contents;

   }
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }
    public function makeDirectory($path)
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }
        return $path;
    }
    public function extract_name($name)
    {
         $arr = \explode('/',$name);
         $this->className = ucwords(end($arr));
         if(count($arr) > 1){
            $arrNd = array_pop($arr);
            $this->name_space =  $this->name_space.'\\'.implode('\\',$arr);
            $this->path_nya = $this->path_nya.'/'.implode('/',$arr);
         }
    }
    public function getSourceFilePath($name)
    {
        return $this->path_nya.'/'.$name.'.php';
    }
}
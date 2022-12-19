<?php
namespace Wisnubaldas\ConsoleInLaravel\Infrastructure;
class StubCreator 
{
    // create file stub
    public function create_stub_file($file,string $data,array $stubVariables)
    {
        foreach ($stubVariables as $search => $replace)
        {
            $data = str_replace('{{ '.$search.' }}' , $replace, $data);
        }
        \file_put_contents($file,$data);    
    }

    // loading file template stub
    public function load_stub($name)
    {
        return file_get_contents(dirname(__DIR__,1)
                    .DIRECTORY_SEPARATOR
                    ."stub"
                    .DIRECTORY_SEPARATOR
                    .$name
                    .".stub");
    }

    // bikin array return set buat di handle sama command nya
    public function result_set($status,...$setnya)
    {
        return (object)array_merge(['status'=>$status],\compact('setnya'));
    }
    // cek kalo file nya exis
    public function cek_file($filename)
    {
        if (file_exists($filename)) {
                return $this->result_set('ok','File sudah dibuat :',$filename);
            } else {
                return $this->result_set('error','File dibuat baru:',$filename);
            }
    }
    // kalo folder belom ada bikin folder sesui nama Model nya
    public function bikin_folder($dir)
    {
        if(!is_dir($dir)) {
            mkdir($dir,0775,true);
            return $this->result_set('ok','Sukses bikin folder :',$dir);
        }
        return $this->result_set('error','Class sudah pernah dibuat :',$dir);
    }
}

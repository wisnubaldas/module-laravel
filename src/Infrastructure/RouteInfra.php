<?php
namespace Wisnubaldas\CleanClass\Infrastructure;

class RouteInfra 
{
    static public function get_web_route_file()
    {
        $dir = rtrim(dirname(__DIR__,4), '/\\') . DIRECTORY_SEPARATOR . 'routes'.DIRECTORY_SEPARATOR.'web';
        if(!is_dir($dir)) {
            mkdir($dir,0775,true);
         }
        try {
            $rdi = new \RecursiveDirectoryIterator($dir);
            $it = new \RecursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    static public function get_api_route_file()
    {
        $dir = rtrim(dirname(__DIR__,4), '/\\') . DIRECTORY_SEPARATOR . 'routes'.DIRECTORY_SEPARATOR.'api';
        if(!is_dir($dir)) {
            mkdir($dir,0775,true);
         }
        try {
            $rdi = new \RecursiveDirectoryIterator($dir);
            $it = new \RecursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

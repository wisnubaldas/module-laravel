<?php
namespace Wisnubaldas\CleanClass;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class BootScript
{
    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();
        // do stuff
    }

    public static function postAutoloadDump(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';

        some_function_from_an_autoloaded_file();
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        print_r($event);
        
        $installedPackage = $event->getOperation()->getPackage();
        // do stuff
        $ph = '<?php'.PHP_EOL;
        $using = 'use Wisnubaldas\CleanClass\Driver\RouteStub;'.PHP_EOL;
        $content = \file_get_contents(dirname(__DIR__, 4).'/routes/web.php');
        $content = str_replace('<?php','',$content);
        $fungsinya = <<<END
        
        RouteStub::get_file(base_path('routes/Web/'));
        END;

        $scrf = $ph.$using.$content.$fungsinya;
        \file_put_contents(dirname(__DIR__, 4).'/routes/web.php',$scrf);

        // untuk api nya
        $content = \file_get_contents(dirname(__DIR__, 4).'/routes/api.php');
        $content = str_replace('<?php','',$content);
        $fungsinya = <<<END

        RouteStub::get_file(base_path('routes/Api/'));
        END;
        $scrf = $ph.$using.$content.$fungsinya;
        \file_put_contents(dirname(__DIR__, 4).'/routes/api.php',$scrf);

    }

    public static function warmCache(Event $event)
    {
        // make cache toasty
    }
}
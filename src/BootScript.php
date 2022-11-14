<?php
namespace Wisnubaldas\CleanClass;

class BootScript
{
    public static function get_routes()
    {
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
}

// BootScript::get_routes();
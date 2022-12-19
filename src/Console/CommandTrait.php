<?php
namespace Wisnubaldas\ConsoleInLaravel\Console;

/**
 * 
 */
trait CommandTrait
{
    public function show_status(object $obj)
    {
        switch ($obj->status) {
            case 'ok':
                $this->line($this->error_path($obj->setnya));
                break;
            case 'error':
                $this->line($this->error_message($obj->setnya));
                break;
            default:
                $this->line('status apa....');
                break;
        }
    }

    public function parsing_status(object $data)
    {
        foreach ($data->set_respon as $k => $r) {
            switch ($r->status) {
                case 'error':
                    foreach ($r->setnya as $i => $v) {
                        if($i%2){
                            $this->line($this->error_path($v));
                        }else{
                            $this->line($this->error_message($v));
                        }
                    }
                    $this->newLine();
                    break;
                case 'ok':
                    foreach ($r->setnya as $i => $v) {
                        if($i%2){
                            $this->line($this->success_path($v));
                        }else{
                            $this->line($this->success_message($v));
                        }
                    }
                    $this->newLine();
                    break;
                default:
                    echo "default";
                    break;
            }
        }
    }
    public function success_message(string $v)
    {
        return '<fg=#4CE600;bg=default;options=bold>'.$v.'</>';
    }
    public function success_path(string $v)
    {
        return '<fg=#003300;bg=#CCFFCC;options=bold>'.$v.'</>';
    }
    public function error_message(string $v)
    {
        return '<fg=#FF1940;bg=default;options=bold>'.$v.'</>';

    }
    public function error_path(string $v)
    {
        return '<fg=#330009;bg=#FFCCCC;options=bold>'.$v.'</>';

    }
    public function yellow(string $v)
    {
        return '<fg=#ffc107;bg=default;>'.$v.'</>';
    }
    public function blue(string $v)
    {
        return '<fg=#0d6efd;bg=default;>'.$v.'</>';
    }
    public function indigo(string $v)
    {
        return '<fg=#6610f2;bg=default;>'.$v.'</>';
    }
    public function purple(string $v)
    {
        return '<fg=#6f42c1;bg=default;>'.$v.'</>';
    }
    public function pink(string $v)
    {
        return '<fg=#d63384;bg=default;>'.$v.'</>';
    }
    public function red(string $v)
    {
        return '<fg=#dc3545;bg=default;>'.$v.'</>';
    }
    public function orange(string $v)
    {
        return '<fg=#fd7e14;bg=default;>'.$v.'</>';
    }
    public function green(string $v)
    {
        return '<fg=#198754;bg=default;>'.$v.'</>';
    }
    public function teal(string $v)
    {
        return '<fg=#20c997;bg=default;>'.$v.'</>';
    }
    public function cyan(string $v)
    {
        return '<fg=#0dcaf0;bg=default;>'.$v.'</>';
    }
    public function gray(string $v)
    {
        return '<fg=#adb5bd;bg=default;>'.$v.'</>';
    }
    public function black(string $v)
    {
        return '<fg=#000;bg=default;>'.$v.'</>';
    }
    public function white(string $v)
    {
        return '<fg=#fff;bg=default;>'.$v.'</>';
    }
}

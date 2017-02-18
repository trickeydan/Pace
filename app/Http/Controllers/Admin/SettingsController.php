<?php

namespace App\Http\Controllers\Admin;

use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display the current system status / variables.
     *
     * @return \Illuminate\View\View
     */
    public function status(){
        $ram = System::getRam();

        $version = [];
        $version['PACE Version'] = config('app.version');
        $version['Laravel Framework Version'] = app()->version();
        $version['PHP Version'] = phpversion();
        $version['Zend Engine Version'] = zend_version();

        $system = [];
        $system['Operating System'] = php_uname('s');
        if($system['Operating System'] == 'Linux') $system['Kernel Version'] = php_uname('r');
        $system['Total Memory'] = round($ram[0] / 1024) . 'MB';
        $system['Free Memory'] = round($ram[1] / 1024) . 'MB';
        $system['PHP Memory Limit'] = ini_get('memory_limit') . 'B';
        $system['Total Disk Space'] = round(disk_total_space("/") / 1024 / 1024 / 1024) . 'GB';
        $system['Free Disk Space'] = round(disk_free_space("/") / 1024 / 1024 / 1024) . 'GB';
        //Todo: clear this up. Perhaps a byteToGb function?
        return view('app.admin.settings.status',compact('version','system'));
    }
}

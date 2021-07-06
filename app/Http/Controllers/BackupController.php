<?php

namespace App\Http\Controllers;

use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        foreach (Storage::allFiles('public/Laravel') as $file){
            $backup_exist = Backup::where('path','=',$file)->get();
            if ($backup_exist->count() == 0){
                $backup_file = new Backup();
                $backup_file->name = explode("/", $file)[2];
                $backup_file->date = Carbon::createFromTimestamp(Storage::lastModified($file))->toDateTimeString();
                $backup_file->size = round(Storage::size($file)/1024).' KB';
                $backup_file->path = $file;
                $backup_file->save();
            }
        }

        $files = Backup::orderBy('id','desc')->get();
        return view('dashboard.settings.backups.index')
            ->with('files',$files);
    }

    public function download(Backup $backup){
        return Storage::download($backup->path);
    }

    public function delete(Backup $backup){
        Storage::delete($backup->path);
        $backup->delete();
        return redirect('dash/backups');
    }

    public function backup(){
        //for windows
        shell_exec('cd '.base_path().' && php artisan backup:run');
        //for other operating systems ^^ windows is shit
        //Artisan::call('backup:run');
        return redirect('dash/backups');
    }
}

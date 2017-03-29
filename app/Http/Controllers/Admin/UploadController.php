<?php

namespace App\Http\Controllers\Admin;

use App\Models\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * Show a listing of uploads.
     *
     * Has pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $uploads = Upload::orderBy('created_at','DESC')->paginate(20);
        return view('app.admin.uploads.index',compact('uploads'));
    }

    /**
     * View the upload and logs.
     *
     * @param Upload $upload
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Upload $upload){
        $logs = $upload->logs()->orderBy('created_at','DESC')->paginate(20);
        return view('app.admin.uploads.view',compact('upload','logs'));
    }
}

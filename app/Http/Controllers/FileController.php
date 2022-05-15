<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function __construct()
    {
    }

    public function push(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:doc,docx,pdf,txt,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        if ($file = $request->file('file')) {
            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();
            $mime_type = $file->getMimeType();
            $size = $file->getSize();

            //store your file into directory and db
            $save = new File();
            $save->name = $name;
            $save->path = $path;
            $save->mime_type = $mime_type;
            $save->size = $size;

            $save->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $save
            ]);
        }
    }

    public function getOne(Request $request,$fileId){
        $file = File::find($fileId);
        $contents = Storage::download($file->path);
        return $contents;
    }

}
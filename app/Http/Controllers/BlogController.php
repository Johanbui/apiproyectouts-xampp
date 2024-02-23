<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Blog;
use App\Models\File;
use Carbon\Carbon;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
    }

    public function getAll(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $search = $request->has('search') ? $request->get('search') : '';


        $blogs = blog::where('codigo', 'LIKE', '%' . $search . '%')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();

        foreach ($blogs as $blog) {
            $id_file = $blog->file_id;
            $file = File::find($id_file);
            $file->url = "http://192.168.10.242/apiproyectouts/public/api/files/".$id_file;
            $blog->file =  $file;
        }

        $countblogs = blog::where('codigo', 'LIKE', '%' . $search . '%')
            ->count();

        return response()->json([
            "data" => $blogs,
            "count" => $countblogs,
            "code" => 20000
        ]);
    }

    public function getone(Request $request)
    {
        $blogId = $request->has('id') ? $request->get('id') : 0;
        $blog = blog::find($blogId);
        $id_file = $blog->file_id;
        $file = File::find($id_file);
        $file->url = "http://192.168.10.242/apiproyectouts/public/api/files/".$id_file;
        $blog->file =  $file;

        return response()->json([
            "data" => $blog,
            "code" => 20000
        ]);
    }

    public function update(Request $request)
    {
        $fecha = Carbon::parse( $request->get('fecha'));
        $fecha = $fecha->format('Y-m-d H:i:s');

        $blogId = $request->has('id') ? $request->get('id') : 0;
        $codigo = $request->has('codigo') ? $request->get('codigo') : 0;
        $noticia = $request->has('noticia') ? $request->get('noticia') : 0;
        $file_id = $request->has('file_id') ? $request->get('file_id') : 0;

        $blog = blog::find($blogId);
        $blog->codigo = $codigo;
        $blog->noticia = $noticia;
        $blog->file_id = $file_id;
        $blog->fecha = $fecha;
        $blog->save();

        return response()->json([
            "data" => $blog,
            "code" => 20000
        ]);
    }

    public function create(Request $request)
    {
        $fecha = Carbon::parse( $request->get('fecha'));
        $fecha = $fecha->format('Y-m-d H:i:s');

        $blog = new blog;
        $blog->codigo = $request->get('codigo');
        $blog->noticia = $request->get('noticia');
        $blog->file_id = $request->get('file_id');
        $blog->fecha = $fecha;
        $blog->save();

        return response()->json([
            "data" => $blog,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);

    }
    public function getLast3(Request $request)
{
    // Obtener las tres últimas noticias ordenadas por fecha descendente
    $lastThreeBlogs = Blog::orderBy('fecha', 'desc')->limit(3)->get();

    // Iterar sobre las noticias para agregar la URL de la imagen a cada una
    foreach ($lastThreeBlogs as $blog) {
        $file = File::find($blog->file_id);
        $file->url = "http://192.168.10.242/apiproyectouts/public/api/files/" . $blog->file_id;
        $blog->file = $file;
    }

    return response()->json([
        "data" => $lastThreeBlogs,
        "code" => 20000
    ]);
}

}

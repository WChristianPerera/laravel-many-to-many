<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $validations = [
        'title'         => 'required|string|min:5|max:100',
        'category_id'   => 'required|integer|exists:categories,id',
        'url_image'     => 'nullable|url|max:200',
        'image'         => 'nullable|image|max:1024',
        'content'       => 'required|string',
        'tags'          => 'nullable|array',
        'tags.*'        => 'integer|exists:tags,id',
    ];

    private $validation_messages = [
        'required'  => 'Il campo :attribute è obbligatorio',
        'min'       => 'Il campo :attribute deve avere almeno :min caratteri',
        // 'max'       => 'Il campo :attribute non può superare i :max caratteri',
        'url'       => 'Il campo deve essere un url valido',
        'exists'    => 'Valore non valido',
    ];




    public function index()
    {
        $posts = Post::paginate(5);

        return view('admin.posts.index', compact('posts'));
    }




    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }




    public function store(Request $request)
    {
        // dd($request->all());

        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        // salvare l'immagine nella cartella degli uploads
        // prendere il percorso dell'immagine appena salvata
        $imagePath = Storage::put('uploads', $data['image']);
        // dd($imagePath);


        // salvare i dati nel db se validi insieme al percorso dell'immagine
        $newPost = new Post();
        $newPost->title         = $data['title'];
        $newPost->slug          = Post::slugger($data['title']);
        $newPost->category_id   = $data['category_id'];
        $newPost->url_image     = $data['url_image'];
        $newPost->image         = $imagePath;
        $newPost->content       = $data['content'];
        $newPost->save();

        // associare i tag
        $newPost->tags()->sync($data['tags'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $newPost]);
    }




    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }




    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $categories = Category::all();
        $tags       = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
        // return view('admin.posts.edit', [
        //     'post'       => $post,
        //     'categories' => $categories,
        //     'tags'      => $tags,
        // ]);
    }




    public function update(Request $request, $slug)
    {
        // dd($request->all());

        $post = Post::where('slug', $slug)->firstOrFail();

        // validare i dati del form
        $request->validate($this->validations, $this->validation_messages);

        $data = $request->all();

        if ($data['image']) {
            // salvare l'immagine nuova
            $imagePath = Storage::put('uploads', $data['image']);

            // eliminare l'immagine vecchia
            if ($post->image) {
                Storage::delete($post->image);
            }

            // aggiormare il valore nella colonna con l'indirizzo dell'immagine nuova
            $post->image = $imagePath;
        }


        // aggiornare i dati nel db se validi
        $post->title        = $data['title'];
        $post->category_id  = $data['category_id'];
        $post->url_image    = $data['url_image'];
        $post->content      = $data['content'];
        $post->update();

        // associare i tag
        $post->tags()->sync($data['tags'] ?? []);

        // ridirezionare su una rotta di tipo get
        return to_route('admin.posts.show', ['post' => $post]);
    }




    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->image) {
            Storage::delete($post->image);
        }

        // disassociare tutti i tag dal post
        $post->tags()->detach();
        // $post->tags()->sync([]);

        // elimino il post
        $post->delete();

        return to_route('admin.posts.index')->with('delete_success', $post);
    }


    public function prova($slug) {
        $post = Post::where('slug', $slug)->firstOrFail();

        return $post->title;
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;
use Illuminate\Database\Eloquent\Builder;

class ArticleController extends Controller
{
    protected $article, $auth;

    public function __construct(Article $article, Auth $auth)
    {
        $this->article = $article;
        $this->auth = $auth;
    }

    public function index()
    {
        if (!auth_login()) {
            $articles = $this->article->orderBy('updated_at', 'desc')->paginate(3);
            return view('welcome', ["articles" => $articles]);
        }
        return redirect('/dashboard');
    }

    public function getAll()
    {
        // $articles = $this->article->where('user_id', '=', auth_user()->id)->orderBy('updated_at', 'desc')->paginate(3);
        $articles = $this->article->with('comments')->orderBy('updated_at', 'desc')->paginate(3);
        return view('dashboard', ["articles" => $articles]);
    }

    public function create()
    {
        return view('pages.article.create');
    }

    public  function store(ArticleRequest $request)
    {
        $data = $request->validated();
        if ($data) {
            $data['user_id'] = auth_user()->id;
            $this->article->create($data);
            return redirect('/dashboard')->with('success', 'Create Success');
        }
    }

    public function getArticleById(Request $request)
    {
        $article = $this->article->find($request->id);
        return view('pages.article.show', ["article" => $article]);
    }

    public function updateArticleByid(ArticleRequest $request)
    {
        $data = $request->validated();
        if ($data) {
            $article = $this->article->find($request->id);
            if (auth_user()->id === $article->user_id) {
                foreach ($data as $key => $value) {
                    $article->$key = $value;
                }
                $article->save();
                return redirect('dashboard')->with('success', 'Update Success');
            }
            abort(403);
        }
    }

    public function deleteArticleById(Request $request)
    {
        $article = $this->article->find($request->id);
        if (auth_user()->id === $article->user_id) {
            $article->delete();
            return redirect('dashboard')->with('success', 'Delete Success');;
        }
        abort(403);
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $comment, $article;
    public function __construct(Comment $comment, Article $article)
    {
        $this->comment = $comment;
        $this->article = $article;
    }

    public function getCommentsByArticleId(int $id)
    {
        $article = $this->article->find($id);
        $comments = $this->comment->where('article_id', $id)->orderBy('updated_at', 'desc')->paginate(3);
        return view('pages.comment.index', ['article' => $article, 'comments' => $comments]);
    }

    public function storeComment(CommentRequest $request)
    {
        $data = $request->validated();
        if ($data) {
            $data['user_id'] = auth_user()->id;
            $this->comment->create($data);
            return redirect('/comment/' . $data['article_id'] . '/article')->with('success', 'Create Success');
        }
    }

    public function updateComment(CommentUpdateRequest $request)
    {
        $data = $request->validated();
        $comment = $this->comment->find($data['comment_id']);
        if ($comment->user_id == auth_user()->id) {
            $comment->text = $data['text'];
            $comment->save();
            return redirect('/comment/' . $data['article_id'] . '/article')->with('success', 'Update Success');
        }
        abort(403);
    }

    public function deleteCommentById(int $comment_id, int $article_id)
    {
        $article = $this->article->find($article_id);
        $comment = $this->comment->find($comment_id);
        if ($comment->user_id == auth_user()->id || $article->user_id == auth_user()->id) {
            $comment->delete();
            return redirect('/comment/' . $article_id . '/article')->with('success', 'Delete Success');
        }
        abort(403);
    }
}

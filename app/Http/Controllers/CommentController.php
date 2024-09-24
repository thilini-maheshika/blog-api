<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Post $post)
    {
        $request->validate(['body' => 'required']);

        return $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        // Validate the request input
        $request->validate([
            'body' => 'required',
        ]);

        // Update the comment
        $comment->update($request->only('body'));

        // Return the updated comment
        return response()->json($comment, 200);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return response()->json(null, 204);
    }
}

?>
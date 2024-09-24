<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Post::query();

        // Filter posts by status if 'status' is provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search posts by title if 'search' keyword is provided in the request
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Return the posts with associated user and comments, paginated
        return $query->with('user', 'comments.user')->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'status' => 'required|in:published,draft'
        ]);

        return Auth::user()->posts()->create($request->all());
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->all());
        return $post;
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return response()->json(null, 204);
    }
    
}

?>
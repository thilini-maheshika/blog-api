<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function update(User $user, Comment $comment)
    {
        // Allow update only if the comment belongs to the authenticated user
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, Comment $comment)
    {
        // Allow delete only if the comment belongs to the authenticated user
        return $user->id === $comment->user_id;
    }
}

?>
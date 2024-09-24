<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine if the given post can be updated by the user.
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Only the owner of the post can update
    }

    /**
     * Determine if the given post can be deleted by the user.
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id; // Only the owner of the post can delete
    }
}

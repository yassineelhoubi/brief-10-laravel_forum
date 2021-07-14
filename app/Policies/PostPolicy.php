<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function owner_admin(User $user, Post $post){
        return $user->id === $post->user_id or $user->is_admin === 1; 
    }
    public function owner(User $user, Post $post){
        return $user->id === $post->user_id; 
    }
}

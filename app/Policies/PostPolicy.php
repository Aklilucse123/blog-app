<?php

namespace App\Policies;

use App\Models\User;
use App\Models\post;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
// let's make only owner can update
public function update(user $user, Post $post)
{
return $user->id === $post->user_id;

}

// Only owner can delete
public function delete(user $user, Post $post)
{
return $user->id === $post->user_id;

}
}

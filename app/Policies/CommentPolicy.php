<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

      /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return  $user->id===$comment->author->id;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return  $user->id===$comment->author->id;
    }
}

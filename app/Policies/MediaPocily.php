<?php

namespace App\Policies;

use App\Models\MediaLibrary;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPocily
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return mixed
     */
    public function view(User $user, MediaLibrary $mediaLibrary)
    {
        return  $user->hasRole('admin') || $user->hasPermission('review_post');

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return  $user->hasRole('admin') || $user->hasPermission('review_post');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return mixed
     */
    public function update(User $user, MediaLibrary $mediaLibrary)
    {
        return  $user->hasRole('admin') || $user->hasPermission('update_post');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return mixed
     */
    public function delete(User $user, MediaLibrary $mediaLibrary)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return mixed
     */
    public function restore(User $user, MediaLibrary $mediaLibrary)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MediaLibrary  $mediaLibrary
     * @return mixed
     */
    public function forceDelete(User $user, MediaLibrary $mediaLibrary)
    {
        //
    }
}

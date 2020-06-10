<?php

namespace App\Policies;

use App\Models\PrintingComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrintingCommentPolicy
{
    use HandlesAuthorization;

    /**
     * @param \App\Models\User $user
     * @param $ability
     * @return bool
     */
    public function before($user, $ability)
    {
        if ($user->role->name == 'admin') {
            return true;
        }
        if ($user->is_banned) {
            return false;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PrintingComment $printingComment
     * @return mixed
     */
    public function view(User $user, PrintingComment $printingComment)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PrintingComment $printingComment
     * @return mixed
     */
    public function update(User $user, PrintingComment $printingComment)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PrintingComment $printingComment
     * @return mixed
     */
    public function delete(User $user, PrintingComment $printingComment)
    {
        return $user->id === $printingComment->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PrintingComment $printingComment
     * @return mixed
     */
    public function restore(User $user, PrintingComment $printingComment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\PrintingComment $printingComment
     * @return mixed
     */
    public function forceDelete(User $user, PrintingComment $printingComment)
    {
        //
    }
}

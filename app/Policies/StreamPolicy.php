<?php

namespace App\Policies;

use App\Models\Stream;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StreamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Stream $stream)
    {
        return $user->id === $stream->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Stream $stream)
    {
        return $user->id === $stream->user_id;
    }
}

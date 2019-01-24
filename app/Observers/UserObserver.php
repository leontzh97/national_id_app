<?php

namespace App\Observers;

use App\Citizenship;
use App\User;

class UserObserver
{
    /**
     * Handle the citizenship "created" event.
     *
     * @param  \App\Citizenship  $citizenship
     * @return void
     */
    public function created(Citizenship $citizenship)
    {
        $user = User::where(['username' => $citizenship->nric])->first();

        $user->citizen_id = $citizenship->id;
        $user->save();
    }

    /**
     * Handle the citizenship "updated" event.
     *
     * @param  \App\Citizenship  $citizenship
     * @return void
     */
    public function updated(Citizenship $citizenship)
    {
        //
    }

    /**
     * Handle the citizenship "deleted" event.
     *
     * @param  \App\Citizenship  $citizenship
     * @return void
     */
    public function deleted(Citizenship $citizenship)
    {
        //
    }

    /**
     * Handle the citizenship "restored" event.
     *
     * @param  \App\Citizenship  $citizenship
     * @return void
     */
    public function restored(Citizenship $citizenship)
    {
        //
    }

    /**
     * Handle the citizenship "force deleted" event.
     *
     * @param  \App\Citizenship  $citizenship
     * @return void
     */
    public function forceDeleted(Citizenship $citizenship)
    {
        //
    }
}

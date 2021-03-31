<?php

namespace App\Observers;

use App\Dinero;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DineroObserver
{
    /**
     * Handle the dinero "created" event.
     *
     * @param  \App\Dinero  $dinero
     * @return void
     */
    public function created(Dinero $dinero)
    {
        //
    }

    /**
     * Handle the dinero "created" event.
     *
     * @param  \App\Dinero  $dinero
     * @return void
     */
    public function creating(Dinero $dinero)
    {
        $dinero->user_id = Auth::user()->id;
        $dinero->fecha = Carbon::now();
    }

    /**
     * Handle the dinero "updated" event.
     *
     * @param  \App\Dinero  $dinero
     * @return void
     */
    public function updated(Dinero $dinero)
    {
        //
    }

    /**
     * Handle the dinero "deleted" event.
     *
     * @param  \App\Dinero  $dinero
     * @return void
     */
    public function deleted(Dinero $dinero)
    {
        //
    }

    /**
     * Handle the dinero "restored" event.
     *
     * @param  \App\Dinero  $dinero
     * @return void
     */
    public function restored(Dinero $dinero)
    {
        //
    }

    /**
     * Handle the dinero "force deleted" event.
     *
     * @param  \App\Dinero  $dinero
     * @return void
     */
    public function forceDeleted(Dinero $dinero)
    {
        //
    }
}

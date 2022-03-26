<?php

namespace OmSdk\Modules\Campaign\Models\Observers;

use OmSdk\Modules\Campaign\Models\Campaign;

class CampaignObserver
{
    /**
     * Handle the account "creating" event.
     * @param Campaign $model
     * @return void
     */
    public function creating(Campaign $model){

    }

    /**
     * Handle the account "created" event.
     * @param Campaign $model
     * @return void
     */
    public function created(Campaign $model)
    {

    }

    /**
     * Handle the account "updated" event.
     *
     * @param Campaign $model
     * @return void
     */
    public function updated(Campaign $model)
    {
        //
    }

    /**
     * Handle the account "updating" event.
     *
     * @param Campaign $model
     * @return void
     */
    public function updating(Campaign $model)
    {
        //
    }

    /**
     * Handle the account "deleted" event.
     *
     * @param Campaign $model
     * @return void
     */
    public function deleted(Campaign $model)
    {
        //
    }

    /**
     * Handle the account "deleting" event.
     *
     * @param Campaign $model
     * @return void
     */
    public function deleting(Campaign $model)
    {
        //
    }

    /**
     * Handle the account "restored" event.
     *
     * @param Campaign $model
     * @return void
     */
    public function restored(Campaign $model)
    {
        //
    }

    /**
     * Handle the account "force deleted" event.
     *
     * @param Campaign $model
     * @return void
     */
    public function forceDeleted(Campaign $model)
    {
        //
    }
}

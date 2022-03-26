<?php

namespace OmSdk\Modules\Channel\Models\Observers;

use OmSdk\Modules\Channel\Models\Channel;

class ChannelObserver
{
    /**
     * Handle the account "creating" event.
     * @param Channel $model
     * @return void
     */
    public function creating(Channel $model){

    }

    /**
     * Handle the account "created" event.
     * @param Channel $model
     * @return void
     */
    public function created(Channel $model)
    {
        $model->code = sprintf('K%03d',$model->id);
        $model->save();
    }

    /**
     * Handle the account "updated" event.
     *
     * @param Channel $model
     * @return void
     */
    public function updated(Channel $model)
    {
        //
    }

    /**
     * Handle the account "updating" event.
     *
     * @param Channel $model
     * @return void
     */
    public function updating(Channel $model)
    {
        //
    }

    /**
     * Handle the account "deleted" event.
     *
     * @param Channel $model
     * @return void
     */
    public function deleted(Channel $model)
    {
        //
    }

    /**
     * Handle the account "deleting" event.
     *
     * @param Channel $model
     * @return void
     */
    public function deleting(Channel $model)
    {
        //
    }

    /**
     * Handle the account "restored" event.
     *
     * @param Channel $model
     * @return void
     */
    public function restored(Channel $model)
    {
        //
    }

    /**
     * Handle the account "force deleted" event.
     *
     * @param Channel $model
     * @return void
     */
    public function forceDeleted(Channel $model)
    {
        //
    }
}

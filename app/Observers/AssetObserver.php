<?php

namespace App\Observers;

use App\Models\Asset;
use App\Models\UserAction;
use Illuminate\Support\Facades\Auth;

class AssetObserver
{
    /**
     * Handle the Asset "created" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function created(Asset $asset)
    {
        if ($asset->wasRecentlyCreated == true) {
            // Data was just created
            $action = 'created';
        }
        if (Auth::check()) {
            UserAction::create([
                'user_id'      => auth()->id(),
                'action'       => $action,
                'action_model' => $asset->getTable(),
                'action_id'    => $asset->id,
                'original'     => '',
                'current'      => $asset->toJson()
            ]);
        }
    }

    /**
     * Handle the Asset "updated" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function updated(Asset $asset)
    {

        if (Auth::check()) {
            UserAction::create([
                'user_id'      => Auth::user()->id,
                'action'       => 'updated',
                'action_model' => $asset->getTable(),
                'action_id'    => $asset->id,
                'original'     => $asset->getOriginal(),
                'current'      => $asset->getChanges() 
            ]);
        }
    }

    /**
     * Handle the Asset "deleted" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function deleted(Asset $asset)
    {
        if (Auth::check()) {
            UserAction::create([
                'user_id'      => Auth::user()->id,
                'action'       => 'deleted',
                'action_model' => $asset->getTable(),
                'action_id'    => $asset->id
            ]);
        }
    }

    /**
     * Handle the Asset "restored" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function restored(Asset $asset)
    {
        //
    }

    /**
     * Handle the Asset "force deleted" event.
     *
     * @param  \App\Models\Asset  $asset
     * @return void
     */
    public function forceDeleted(Asset $asset)
    {
        //
    }
}

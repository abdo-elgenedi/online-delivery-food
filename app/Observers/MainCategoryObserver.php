<?php

namespace App\Observers;

use App\Models\MainCategory;
use App\Models\Vendor;

class MainCategoryObserver
{
    /**
     * Handle the main category "created" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function created(MainCategory $mainCategory)
    {

    }

    /**
     * Handle the main category "updated" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function updated(MainCategory $mainCategory)
    {
        $mainCategory->categories()->update(['active'=>$mainCategory->active]);

       /* if($mainCategory->active==0) {

            foreach($mainCategory->vendors as $vendor)
            { ($newStatus=Vendor::find($vendor->id));
            $newStatus->update(['last_status'=>$vendor->status]);
            }
            $mainCategory->vendors()->update(['status' => $mainCategory->active]);

        }
       else{

            foreach($mainCategory->vendors as $vendor)
            { ($newStatus=Vendor::find($vendor->id));
                $newStatus->update(['status'=>$vendor->last_status]);
            }


        }*/

    }

    /**
     * Handle the main category "deleted" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function deleted(MainCategory $mainCategory)
    {
        $mainCategory->categories()->delete();
    }

    /**
     * Handle the main category "restored" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function restored(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "force deleted" event.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return void
     */
    public function forceDeleted(MainCategory $mainCategory)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Models\CategoryLevel3;
use App\Models\Vendor;

class CategoryLevel3Observer
{
    /**
     * Handle the main category "created" event.
     *
     * @param  \App\Models\CategoryLevel3  $mainCategory
     * @return void
     */
    public function created(CategoryLevel3 $mainCategory)
    {

    }

    /**
     * Handle the main category "updated" event.
     *
     * @param  \App\Models\CategoryLevel3  $mainCategory
     * @return void
     */
    public function updated(CategoryLevel3 $mainCategory)
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
     * @param  \App\Models\CategoryLevel3  $mainCategory
     * @return void
     */
    public function deleted(CategoryLevel3 $mainCategory)
    {
        $mainCategory->categories()->delete();
    }

    /**
     * Handle the main category "restored" event.
     *
     * @param  \App\Models\CategoryLevel1  $mainCategory
     * @return void
     */
    public function restored(CategoryLevel3 $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "force deleted" event.
     *
     * @param  \App\Models\CategoryLevel1  $mainCategory
     * @return void
     */
    public function forceDeleted(CategoryLevel3 $mainCategory)
    {
        //
    }
}

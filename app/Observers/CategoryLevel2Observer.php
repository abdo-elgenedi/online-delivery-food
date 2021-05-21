<?php

namespace App\Observers;

use App\Models\CategoryLevel1;
use App\Models\CategoryLevel2;
use App\Models\Vendor;

class CategoryLevel2Observer
{
    /**
     * Handle the main category "created" event.
     *
     * @param  \App\Models\CategoryLevel2  $mainCategory
     * @return void
     */
    public function created(CategoryLevel2 $mainCategory)
    {

    }

    /**
     * Handle the main category "updated" event.
     *
     * @param  \App\Models\CategoryLevel2  $mainCategory
     * @return void
     */
    public function updated(CategoryLevel2 $mainCategory)
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
     * @param  \App\Models\CategoryLevel2  $mainCategory
     * @return void
     */
    public function deleted(CategoryLevel2 $mainCategory)
    {
        $mainCategory->categories()->delete();
    }

    /**
     * Handle the main category "restored" event.
     *
     * @param  \App\Models\CategoryLevel1  $mainCategory
     * @return void
     */
    public function restored(CategoryLevel2 $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "force deleted" event.
     *
     * @param  \App\Models\CategoryLevel1  $mainCategory
     * @return void
     */
    public function forceDeleted(CategoryLevel2 $mainCategory)
    {
        //
    }
}

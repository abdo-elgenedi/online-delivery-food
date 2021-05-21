<?php

namespace App\Observers;

use App\SubCategory;

class SubCategoryObserver
{
    /**
     * Handle the sub category "created" event.
     *
     * @param  \App\SubCategory  $subCategory
     * @return void
     */
    public function created(SubCategory $subCategory)
    {
        //
    }

    /**
     * Handle the sub category "updated" event.
     *
     * @param  \App\SubCategory  $subCategory
     * @return void
     */
    public function updated(SubCategory $subCategory)
    {
        //
    }

    /**
     * Handle the sub category "deleted" event.
     *
     * @param  \App\SubCategory  $subCategory
     * @return void
     */
    public function deleted(SubCategory $subCategory)
    {
        //
    }

    /**
     * Handle the sub category "restored" event.
     *
     * @param  \App\SubCategory  $subCategory
     * @return void
     */
    public function restored(SubCategory $subCategory)
    {
        //
    }

    /**
     * Handle the sub category "force deleted" event.
     *
     * @param  \App\SubCategory  $subCategory
     * @return void
     */
    public function forceDeleted(SubCategory $subCategory)
    {
        //
    }
}

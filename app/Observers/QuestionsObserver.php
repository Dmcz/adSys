<?php

namespace App\Observers;

use App\Models\Questions;

class QuestionsObserver
{
    /**
     * Handle the questions "creating" event.
     *
     * @param  \App\Models\Questions  $questions
     * @return void
     */
    public function creating(Questions $questions)
    {
        $questions->no = $questions::buildNo();
    }
    
    /**
     * Handle the questions "created" event.
     *
     * @param  \App\Models\Questions  $questions
     * @return void
     */
    public function created(Questions $questions)
    {
        //
    }

    /**
     * Handle the questions "updated" event.
     *
     * @param  \App\Models\Questions  $questions
     * @return void
     */
    public function updated(Questions $questions)
    {
        //
    }

    /**
     * Handle the questions "deleted" event.
     *
     * @param  \App\Models\Questions  $questions
     * @return void
     */
    public function deleted(Questions $questions)
    {
        //
    }

    /**
     * Handle the questions "restored" event.
     *
     * @param  \App\Models\Questions  $questions
     * @return void
     */
    public function restored(Questions $questions)
    {
        //
    }

    /**
     * Handle the questions "force deleted" event.
     *
     * @param  \App\Models\Questions  $questions
     * @return void
     */
    public function forceDeleted(Questions $questions)
    {
        //
    }
}

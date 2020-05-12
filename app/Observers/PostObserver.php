<?php

namespace App\Observers;

use App\Models\Post;
use Carbon\Carbon;
use Str;

class PostObserver
{
    /**
     * Handle the post "creating" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function creating(Post $post)
    {
        $post->user_id = auth()->id() ?? 1;
        $this->setPublishedAt($post);
        $this->setSlug($post);
    }

    /**
     * Handle the post "created" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function created(Post $post)
    {
        //
    }

    /**
     * Handle the post "updating" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function updating(Post $post)
    {
        $this->setPublishedAt($post);
        $this->setSlug($post);
    }

    /**
     * Handle the post "updated" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the post "restored" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the post "force deleted" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }

    /**
     * @param Post $post
     */
    private function setPublishedAt(Post $post)
    {
        if ($post->is_published && empty($post->published_at)) {
            $post->published_at = Carbon::now();
        }
    }

    /**
     * @param Post $post
     */
    private function setSlug(Post $post)
    {
        if (empty($post->slug)) {
            $post->slug = Str::slug($post->title);
        }
    }
}

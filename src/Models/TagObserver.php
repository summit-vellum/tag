<?php

namespace Quill\Tag\Models;

use Illuminate\Support\Str;
use Quill\Tag\Events\TagCreating;
use Quill\Tag\Events\TagCreated;
use Quill\Tag\Events\TagSaving;
use Quill\Tag\Events\TagSaved;
use Quill\Tag\Events\TagUpdating;
use Quill\Tag\Events\TagUpdated;
use Quill\Tag\Models\Tag;

class TagObserver
{

    public function creating(Tag $tag)
    {
        // creating logic... 
        event(new TagCreating($tag));
    }

    public function created(Tag $tag)
    {
        // created logic...
        event(new TagCreated($tag));
    }

    public function saving(Tag $tag)
    {
        // saving logic...
        event(new TagSaving($tag));
    }

    public function saved(Tag $tag)
    {
        // saved logic...
        event(new TagSaved($tag));
    }

    public function updating(Tag $tag)
    {
        // updating logic...
        event(new TagUpdating($tag));
    }

    public function updated(Tag $tag)
    {
        // updated logic...
        event(new TagUpdated($tag));
    }

}
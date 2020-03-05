<?php 

namespace Quill\Tag\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Quill\Tag\Models\Tag;

class TagCreated
{
    // use Dispatchable, InteractsWithSockets, 
    use SerializesModels;
 
    public $data;

    /**
     * Create a new event instance.
     *
     * @param  \Quill\Tag\Models\Tag  $data
     * @return void
     */
    public function __construct(Tag $data) 
    {
        $this->data = $data;  
    }
}

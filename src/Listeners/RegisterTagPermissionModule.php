<?php

namespace Quill\Tag\Listeners;

class RegisterTagPermissionModule
{ 
    public function handle()
    {
        return [
            'Tag' => [
                'view'
            ]
        ];
    }
}

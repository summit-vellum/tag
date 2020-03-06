<?php

use Illuminate\Database\Seeder;
use Quill\Tag\Models\Tag;

class TagTableSeeder extends Seeder
{
   	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$old_db = DB::connection('olddb');

    	$itemsPerBatch = 50;

    	$tags = $old_db->table('tbl_tags');

    	$this->command->getOutput()->progressStart($tags->count());

        $vellumTags = $tags->orderBy('tags_id')->chunk($itemsPerBatch, function($tags){

        	foreach ($tags as $tag) {

        		$migratedTag = new Tag;
        		$migratedTag->create([
        			'id' => $tag->tags_id,
        			'name' => $tag->tags_name,
        			'slug' => $tag->tags_slug,
        			'meta_title' => $tag->tags_meta_title,
        			'meta_keyword' => $tag->tags_meta_keyword,
        			'meta_description' => $tag->tags_meta_description,
        			'count' => $tag->tags_count,
        			'status' => $tag->tags_status,
        			'is_visible' => $tag->is_visible,
        			'type' => $tag->tags_type,
        			'definition' => $tag->tags_definition,
        			'central_id' => $tag->central_id,
        			'nsfw' => $tag->tags_nsfw,
        			'created_at' => $tag->tags_datecreated,
        			'updated_at' => $tag->tags_datemodified
        		]);

        		$this->command->getOutput()->progressAdvance();

        	}

        });

        $this->command->getOutput()->progressFinish();
    }

}

<?php

namespace Quill\Tag\Models;

use Vellum\Models\BaseModel;

class Tag extends BaseModel
{

    protected $table = 'tags';

    public function scopeWhereValid($query)
	{
		return $query->whereActive();
	}

	public function scopeWhereActive($query)
	{
		return $query->where('status', 1);
	}

	public function scopeWhereInvisible($query)
	{
		return $query->where('is_visible', '=', 0);
	}

	public function scopeWhereVisible($query)
	{
		return $query->where('is_visible', '=', 1);
	}

	public function scopeOrderByCount($query, $order = 'DESC')
    {
        return $query->orderBy('count', $order);
	}

    public function history()
    {
        return $this->morphOne('Quill\History\Models\History', 'historyable');
    }

    public function resourceLock()
    {
        return $this->morphOne('Vellum\Models\ResourceLock', 'resourceable');
    }

    public function autosaves()
    {
        return $this->morphOne('Vellum\Models\Autosaves', 'autosavable');
    }

}

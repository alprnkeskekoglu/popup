<?php

namespace Dawnstar\ModuleBuilder\Models;

use Dawnstar\Core\Models\Structure;
use Dawnstar\Core\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopupTranslation extends Model
{
    use SoftDeletes, HasTranslation;

    protected $table = 'popup_translations';
    protected $guarded = ['id'];

    public function popup()
    {
        return $this->belongsTo(Popup::class);
    }
}

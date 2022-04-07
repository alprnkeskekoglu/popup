<?php

namespace Dawnstar\Popup\Models;

use Dawnstar\Core\Models\Structure;
use Dawnstar\Core\Models\Url;
use Dawnstar\Core\Traits\HasTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Popup extends Model
{
    use SoftDeletes, HasTranslation;

    protected $table = 'popups';
    protected $guarded = ['id'];
    protected $casts = ['devices' => 'array'];

    public function translations()
    {
        return $this->hasMany(PopupTranslation::class);
    }

    public function urls()
    {
        return $this->belongsToMany(Url::class, 'popup_urls');
    }
}

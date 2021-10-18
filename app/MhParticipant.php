<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhParticipant extends Model
{

    use SoftDeletes;

    protected $fillable = ["name", "address", "contact", "description", "custom_title", "key", "paid_status"];
    /**
     * Get the post that owns the mh_participant_type.
     */
    public function mh_participant_type()
    {
        return $this->belongsTo(MhParticipantType::class);
    }

    public function th_payment()
    {
        return $this->hasOneThrough('App\ThPayment', "App\TdPayment");
    }

    public function formatStatusLunas()
    {
        $arrStatus = ["Belum Lunas", "Lunas"];
        return $arrStatus[$this->paid_status];
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" . $search . "%");
        });

        if (isset($filters["paid_status"])) {
            $query->where("paid_status", "=", $filters["paid_status"]);
        }

        $query->when($filters["type"] ?? false, function ($query, $type) {
            return $query->whereHas("mh_participant_type", function ($query) use ($type) {
                $query->where("id", $type);
            });
        });
    }
}

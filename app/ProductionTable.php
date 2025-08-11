<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionTable extends Model
{
    use HasFactory;

    protected $fillable = ['table_name', 'floor_id', 'number_of_seats', 'description'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function floor()
    {
        return $this->belongsTo(ProductionFloor::class, 'floor_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'table_id');
    }

    public function getAvailabilityStatusAttribute()
    {
        $assigned = $this->users()->count();
        $available = $this->number_of_seats - $assigned;

        if ($available <= 0) {
            return 'Full';
        }

        return "$assigned of {$this->number_of_seats} Available";
    }

    public function getFullNameAttribute()
    {
        return "{$this->table_name} ({$this->availability_status})";
    }
}

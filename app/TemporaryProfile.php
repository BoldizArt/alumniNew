<?php

namespace Alumni;

use Illuminate\Database\Eloquent\Model;

class TemporaryProfile extends Model
{
    // Table name
    protected $table = 'temporary_profiles';
    // Primary key
    public $primaryKey = 'id';
    // Timestamp
    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $primaryKey = null;
    public $incrementing = false;

    protected $table = 'role_user';

    protected $fillable = ['user_id', 'role_id'];

    public $timestamps = false;
}

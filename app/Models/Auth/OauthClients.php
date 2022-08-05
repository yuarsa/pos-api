<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class OauthClients extends Model
{
    protected $table = 'oauth_clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'secret',
        'revoked',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
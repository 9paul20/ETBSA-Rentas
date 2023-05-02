<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    public function getRouteKeyName()
    {
        $name = str_slug('name', '-');
        return $name;
    }

    protected $fillable = [
        'clvPersona',
        'name',
        'email',
        'password',
        'remember_token',
        'last_login',
        'active',
        'activation_key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activation_key',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * the validation rules
     *
     * @var array
     */

    public static function getRules($id = null)
    {
        $rules = [
            'name' => 'required|string|min:4|max:255|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:6|confirmed',
        ];
        return $rules;
    }

    public static function getRulesUser($id = null)
    {
        $rules = [
            'name' => 'required|string|min:4|max:255|unique:users,name,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ];
        return $rules;
    }

    public static function getRulesPassword($id = null)
    {
        $rules = [
            'password' => 'required|string|min:6|confirmed',
        ];
        return $rules;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function logLastLogin()
    {
        $this->last_login = now();
        $this->save();
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'clvPersona');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'guard_name'];

    /**
     * the rules of the Group for validation before persisting
     *
     * @var array
     */
    public static function getRules($id = null)
    {
        $rules = [
            'name' => 'required|string|min:4|max:255|unique:roles,name,' . $id,
            'display_name' => 'required|string|min:4|max:255|unique:roles,display_name,' . $id,
            'description' => 'required|string|min:4',
            'guard_name' => 'required|string|min:4|max:255|unique:roles,guard_name,' . $id,
        ];
        return $rules;
    }
}

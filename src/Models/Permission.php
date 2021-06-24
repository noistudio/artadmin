<?php


namespace Artadmin\Models;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    function __construct(array $attributes = [])
    {
        $this->table= config("artadmin.tables.permissions");
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,config("artadmin.tables.roles_permissions"));
    }
}

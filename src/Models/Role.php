<?php


namespace Artadmin\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    function __construct(array $attributes = [])
    {
        $this->table= config("artadmin.tables.roles");
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,config("artadmin.tables.roles_permissions"));
    }

}

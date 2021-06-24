<?php


namespace Artadmin\Models;


use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    function __construct(array $attributes = [])
    {
        $this->table= config("artadmin.tables.roles_permissions");
    }


}

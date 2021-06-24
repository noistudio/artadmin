<?php


namespace Artadmin\Models;


use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    function __construct(array $attributes = [])
    {
        $this->table= config("artadmin.tables.users_roles");
    }


}

<?php

namespace Artadmin\Traits;


use Artadmin\Models\Permission;
use Artadmin\Models\Role;


trait HasRolesAndPermissions
{

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,config("artadmin.tables.users_roles"));
    }
    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,config("artadmin.tables.users_permissions"));
    }

    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }
    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->slug);
    }

    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug',$permissions)->get();
    }

    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function deletePermissions(... $permissions )
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }
    /**
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function hasPermissionThroughRole($permission)
    {

        foreach ($permission->roles as $role){

            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }
}

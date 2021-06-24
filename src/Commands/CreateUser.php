<?php

namespace Artadmin\Commands;

use App\admin2\TableModel;
use Artadmin\Models\Permission;
use Artadmin\Models\Role;
use Artadmin\Models\RolePermission;
use Artadmin\Models\User;
use Artadmin\Models\UserPermission;
use Artadmin\Models\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artadmin:adduser {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user for artadmin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password=$this->argument("password");

        if(User::query()->count()>0){
            print("You already have a admin. Delete him\n");
            return false;
        }

        UserPermission::query()->delete();
        RolePermission::query()->delete();
        UserRole::query()->delete();
        Role::query()->delete();
        Permission::query()->delete();

       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

           print("Not correct email\n please try again php artisan artadmin:adduser myemai@email.com 123456\n");
           return false;
       }
       if(!(isset($password) and is_string($password) and strlen($password)>=6)){
           print("Not correct password . Min length 6 symbols\n please try again php artisan artadmin:adduser myemai@email.com 123456\n");
           return false;
       }

        $manageUser = new Permission();
        $manageUser->name = 'Root access';
        $manageUser->slug = 'root';
        $manageUser->save();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->slug = 'admin';
        $admin->save();
        $admin->permissions()->attach($manageUser);

       $new_user=new User();
       $new_user->email=$email;
       $new_user->name=$email;
       $new_user->password=Hash::make($password);
       $new_user->email_verified_at=now();

       $new_user->save();
       $new_user->roles()->attach($admin);



       print("user success created\n");
        print("email:".$email."\n");
        print("password:".$password."\n");

        return 0;
    }
}

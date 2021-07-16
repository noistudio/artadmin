@extends('artadmin::auth_page')
@section('title', trans("artadmin::admins.list"))
@section('content')
    <div class="main_content_iner">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">

                <li class="breadcrumb-item active" aria-current="page">Список администраторов</li>
            </ol>
        </nav>
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">



            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">Администраторы сайта</div>
              <div class="d-flex align-items-center">
                    <button class="btn btn-secondary mr-2 icon-filter-1 js_show_hide_selections-setting"></button>


                </div>
            </div>

        <div class="dzenkit-selections-setting">
                <div class="dzenkit-basic-card-body">
                    <p class="hdr">Настройка выборки</p>

                    <form action="">

                        <div class="row mb-3">
                            <label for="selectForm_CategorSubGroup" class="col-md-4 col-form-label">Роль</label>
                            <div class="col-md-4">
                                <select class="form-select" name="role"  >
                                    <option  value="0"  ></option>

                                        @if($roles)
                                            @foreach($roles as $role)
                                                <option @if(isset($request_all['role']) and $request_all['role']==$role->id) selected="selected" @endif value="{{ $role->id  }}">{{ $role->name }}</option>
                                            @endforeach
                                        @endif


                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectForm_CategorSubGroup" class="col-md-4 col-form-label">Права</label>
                            <div class="col-md-4">
                                <select class="form-select" name="permission"  >
                                    <option  value="0"  ></option>

                                    @if($permissions)
                                        @foreach($permissions as $permission)
                                            <option @if(isset($request_all['permission']) and $request_all['permission']==$permission->id) selected="selected" @endif value="{{ $permission->id  }}">{{ $permission->name }}</option>
                                        @endforeach
                                    @endif


                                </select>
                            </div>
                        </div>



                        <div class="row dzenkit-submit-box">
                            <div class="offset-md-4">
                                <button type="submit" class="btn btn-info">Найти</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="dzenkit-basic-card-body fill">

                <form action="{{ route('artadmin.admins.add') }}" method="POST">
                    <p class="h5 mt-3 mb-4">{{ trans("artadmin::admins.add") }}</p>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::admins.name") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control" name="name" required placeholder="{{ trans("artadmin::admins.name") }}">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::admins.email") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="email" class="form-control" name="email" required  placeholder="{{ trans("artadmin::admins.email") }}">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::login.password") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="password" class="form-control" name="password" required placeholder="{{ trans("artadmin::login.password") }}">
                        </div>
                    </div>


                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::admins.roles") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <select class="form-control" name="roles[]" multiple style="min-height: 100px; height: 20vh; max-height: 160px;">
                                @if($roles)
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id  }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::admins.permission") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <select class="form-control" name="permissions[]" multiple style="min-height: 200px; height: 40vh; max-height: 360px;">
                                @if($permissions)
                                    @foreach($permissions as $permission)
                                        <option value="{{ $permission->id  }}">{{ $permission->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>


                    <div class="row my-4">
                        <div class="col-12 col-lg-4">
                            {!! csrf_field() !!}
                        </div>
                        <div class="col-12 col-lg-8">
                            <button type="submit" class="btn btn-dzenkit-action"><i class="icon-plus"></i>{{ trans("artadmin::admins.add") }}</button>
                        </div>
                    </div>




                    {{--<!--<table class="table" >
                        <tr>
                            <td>{{ trans("artadmin::admins.name") }}</td>
                            <td><input type="text" class="form-control" name="name" required></td>

                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::admins.email") }}</td>
                            <td><input type="email" class="form-control" name="email" required ></td>
                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::login.password") }}</td>
                            <td><input type="password" class="form-control" name="password" required ></td>

                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::admins.permission") }}</td>
                            <td>
                                <select class="form-control" name="roles[]" multiple>
                                @if($roles)
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id  }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::admins.permission") }}</td>
                            <td>
                                <select class="form-control" name="permissions[]" multiple>
                                    @if($permissions)
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id  }}">{{ $permission->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{!! csrf_field() !!}</td>
                            <td><button type="submit" class="btn btn-dzenkit-action"><i class="icon-plus"></i>{{ trans("artadmin::admins.add") }}</button></td>
                        </tr>
                    </table>-->--}}


                </form>
            </div>

            <div class="dzenkit-basic-card-body rows_super_list">

                <p class="h5 mt-3 mb-4">Все администраторы</p>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="navbar-col"></th>
                        <th>{{ trans("artadmin::admins.name") }}</th>
                    <!--<th>{{ trans("artadmin::admins.email") }}</th>
                <th></th>
                <th></th>-->
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($rows))
                        @foreach($rows as $admin)
                            <tr data-url-change="" data-row-id="" data-sort="">
                                <td>
                                    <div class="row-nav d-flex">
                                        <div class="nav-bar d-flex align-items-center">

                                            <!-- action menu -->
                                            <div class="action">
                                                <div class="dropleft">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="icon-menu"></i>
                                                    </button>

                                                    <ul class="dropdown-menu">
                                                        <li><a class="icon-pencil d-flex align-items-center" href="{{ route("artadmin.admins.edit",$admin->id) }}">Редактировать</a></li>
                                                        <li><hr class="dropdown-divider mt-5"></li>
                                                        <li><a class="icon-trash-empty del d-flex align-items-center" href="{{ route("artadmin.admins.delete",$admin->id) }}">Удалить без подтверждения</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- / action menu -->
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route("artadmin.admins.edit",$admin->id) }}">{{$admin->name}}<button class="icon-down-open js_open_link_descript"></button></a>
                                    <dl>
                                        <dd><b>E-mail:</b> {{$admin->email}}</dt>
                                        <dd><b>Роли</b>   @if(isset($admin->roles) and count($admin->roles)>0)
                                            @foreach($admin->roles as $role)
                                                {{ $role->name }},
                                                @endforeach
                                                @endif</dd>

                                        <dd><b>Права доступа</b>  @if(isset($admin->permissions) and count($admin->permissions)>0)
                                            @foreach($admin->permissions as $permission)
                                                {{ $permission->name }},
                                                @endforeach
                                                @endif</dd>

                                    </dl>
                                </td>
                            </tr>


                            <!--<tr>
                <td>
                    {{$admin->name}}
                                </td>
                                <td>{{$admin->email}}</td>
                <td><a href="{{ route("artadmin.admins.edit",$admin->id) }}">{{ trans("artadmin::admins.edit") }}</a></td>
                <td><a href="{{ route("artadmin.admins.delete",$admin->id) }}">{{ trans("artadmin::admins.delete") }}</a></td>
            </tr>-->


                        @endforeach
                    @endif
                    </tbody>
                </table>



            </div>


        </div>
    </div>
@endsection

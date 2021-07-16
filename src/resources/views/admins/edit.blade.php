@extends('artadmin::auth_page')
@section('title', trans("artadmin::admins.edit_title"))
@section('content')
    <div class="main_content_iner">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("artadmin.admins.list") }}">Список администраторов</a></li>
                <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
            </ol>
        </nav>
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">


            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">{{ trans("artadmin::admins.edit_title") }}</div>
            </div>


            <div class="dzenkit-basic-card-body fill">


                <form action="{{ route('artadmin.admins.doedit',$user->id) }}" method="POST">

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::admins.name") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control" name="name" value="{{$user->name}}"  required  placeholder="{{ trans("artadmin::admins.name") }}">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::admins.email") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="email" readonly class="form-control" value="{{$user->email}}" name="email"  placeholder="{{ trans("artadmin::admins.email") }}">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::login.password") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="password" class="form-control" name="password"  placeholder="{{ trans("artadmin::login.password") }}">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::admins.roles") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <select class="form-control" name="roles[]" multiple style="min-height: 100px; height: 30vh; max-height: 160px;">
                                @if($roles)
                                    @foreach($roles as $role)
                                        <option @if($user->hasRole($role->slug)) selected @endif value="{{ $role->id  }}">{{ $role->name }}</option>
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
                                        <option @if($user->hasPermission($permission->slug)) selected @endif value="{{ $permission->id  }}">{{ $permission->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <hr class="mt-5"/>

                    <div class="row text-center">
                        <div class="col-12 col-md-6 my-3">
                            <button type="submit" class="btn btn-lg btn-primary" disabled="disabled" style="opacity:.25;">Сохранить</button>
                            {!! csrf_field() !!}
                        </div>
                        <div class="col-12 col-md-6 my-3">
                            <button type="submit" class="btn btn-lg btn-primary">Применить</button>
                            {{--<!--<button type="submit" class="btn btn-lg btn-primary">{{ trans("artadmin::admins.edit_title") }}</button>-->--}}
                        </div>
                    </div>



                    {{--<!--<table class="table" >
                        <tr>
                            <td>{{ trans("artadmin::admins.name") }}</td>
                            <td><input type="text" class="form-control" name="name" value="{{$user->name}}"  required></td>

                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::admins.email") }}</td>
                            <td><input type="email" readonly class="form-control" value="{{$user->email}}" name="email" ></td>
                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::login.password") }}</td>
                            <td><input type="password" class="form-control" name="password"  ></td>

                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::admins.roles") }}</td>
                            <td>
                                <select class="form-control" name="roles[]" multiple>
                                    @if($roles)
                                        @foreach($roles as $role)
                                            <option @if($user->hasRole($role->slug)) selected @endif value="{{ $role->id  }}">{{ $role->name }}</option>
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
                                            <option @if($user->hasPermission($permission->slug)) selected @endif value="{{ $permission->id  }}">{{ $permission->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{!! csrf_field() !!}</td>
                            <td><button type="submit" class="btn btn-success">{{ trans("artadmin::admins.edit_title") }}</button></td>
                        </tr>
                    </table>-->--}}



                </form>

            </div>
        </div>

    </div>
@endsection

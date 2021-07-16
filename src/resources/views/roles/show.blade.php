@extends('artadmin::auth_page')
@section('title', trans("artadmin::roles.edit").' '.$role->name)
@section('content')
    <div class="main_content_iner">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route("artadmin.roles.list") }}">Список ролей</a></li>
                <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
            </ol>
        </nav>
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">



            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">{{ trans("artadmin::roles.edit") }}</div>
            </div>


            <div class="dzenkit-basic-card-body fill">


                <form action="{{ route('artadmin.roles.update',$role->id) }}" method="POST">

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::roles.name") }}:</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            {{ $role->name }}
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>slug:</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            {{ $role->slug }}
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::roles.permissions") }}:</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <select class="form-control" name="permissions[]" multiple style="min-height:160px; height:40vh; max-height:400px;">
                                @if($permissions)
                                    @foreach($permissions as $permission)
                                        <option @if($permission->roles->contains($role)) selected @endif value="{{ $permission->id  }}">{{ $permission->name }}</option>
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
                            {{--<!--<button type="submit" class="btn btn-danger">{{ trans("artadmin::roles.change") }} </button>-->--}}
                        </div>
                    </div>




                    {{--<!--<table class="table" >
                        <tr>
                            <td>{{ trans("artadmin::roles.name") }}</td>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <td>slug</td>
                            <td>{{ $role->slug }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans("artadmin::roles.permissions") }}</td>
                            <td>
                                <select class="form-control" name="permissions[]" multiple>
                                    @if($permissions)
                                        @foreach($permissions as $permission)
                                            <option @if($permission->roles->contains($role)) selected @endif value="{{ $permission->id  }}">{{ $permission->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{!! csrf_field() !!}</td>
                            <td><button type="submit" class="btn btn-danger">{{ trans("artadmin::roles.change") }} </button></td>
                        </tr>
                    </table>-->--}}



                </form>


            </div>

        </div>
    </div>
@endsection

@extends('artadmin::auth_page')
@section('title', trans("artadmin::roles.title"))
@section('content')
    <div class="main_content_iner">
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">



            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">Роли администраторов</div>
               <div class="d-flex align-items-center">
                    <button class="btn btn-secondary mr-2 icon-filter-1 js_show_hide_selections-setting"></button>

                </div>
            </div>
            <div class="dzenkit-selections-setting">
                <div class="dzenkit-basic-card-body">
                    <p class="hdr">Настройка выборки</p>

                    <form action="">


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

                <p class="h5 mt-3 mb-4">{{ trans("artadmin::roles.add") }}</p>


                <form action="{{ route('artadmin.roles.add') }}" method="POST">

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::roles.name") }}</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control" name="name" required placeholder="{{ trans("artadmin::roles.name") }}">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>slug(a-z)</strong><br/>разделитель - только нижнее подчёркивание&nbsp;_
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control" name="slug" required placeholder="example , example_example">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-8 offset-0 offset-lg-4 mb-3">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-dzenkit-action"><i class="icon-plus"></i>{{ trans("artadmin::roles.add") }}</button>
                        </div>
                    </div>




                    {{--<!--<table class="table" >
                        <tr>
                            <td>{{ trans("artadmin::roles.name") }}</td>
                            <td><input type="text" class="form-control" name="name" required></td>
                        </tr>
                        <tr>
                            <td>slug(a-z)</td>
                            <td><input type="text" class="form-control" name="slug" required ></td>
                        </tr>
                        <tr>
                            <td>{!! csrf_field() !!}</td>
                            <td><button type="submit" class="btn btn-danger">{{ trans("artadmin::roles.add") }} </button></td>
                        </tr>
                    </table>-->--}}



                </form>
            </div>

            <div class="dzenkit-basic-card-body">
                <p class="h5 mt-3 mb-4">{{ trans("artadmin::roles.title") }}</p>


                <table class="table">
                    <thead>
                    <tr>
                        <th class="navbar-col"></th>
                        <th>{{ trans("artadmin::roles.name") }}</th>
                        {{--<!--<th>slug</th>
                        <th>{{ trans("artadmin::roles.permissions") }}</th>
                        <th></th>
                        <th></th>-->--}}
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($rows))
                        @foreach($rows as $role)
                            <tr>
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
                                                        <li><a class="icon-pencil d-flex align-items-center" href="{{ route("artadmin.roles.show",$role->id) }}">Редактировать</a></li>
                                                        <li><hr class="dropdown-divider mt-5"></li>
                                                        <li><a class="icon-trash-empty del d-flex align-items-center" href="{{ route("artadmin.roles.delete",$role->id) }}">Удалить</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- / action menu -->
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route("artadmin.roles.show",$role->id) }}">{{$role->name}}<button class="icon-down-open js_open_link_descript"></button></a>
                                    <dl>
                                        <dd><b>slug:</b> {{$role->slug}}</dd>
                                     </dl>
                                </td>

                                {{--<!--<td>{{$role->slug}}</td>
                                <td><a href="{{ route("artadmin.roles.show",$role->id) }}">{{ trans("artadmin::roles.manage") }}</a></td>
                                <td><a href="{{ route("artadmin.roles.delete",$role->id) }}">{{ trans("artadmin::admins.delete") }}</a></td>-->--}}

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
@endsection

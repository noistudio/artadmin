@extends('artadmin::auth_page')
@section('title', trans("artadmin::permission.title"))
@section('content')
    <div class="main_content_iner">
        <div class="dzenkit-basic-card dzenkit-fulltable-maxwid-lg">



            <div class="dzenkit-table-header hdr-box d-flex align-items-center justify-content-between">
                <div class="hdr">Права доступа</div>
                {{--<!--<div class="d-flex align-items-center">
                    <button class="btn btn-secondary mr-2 icon-filter-1 js_show_hide_selections-setting"></button>
                    <div class="dropdown">
                        <a id="tableCog" href="#" class="btn btn-secondary mr-2 icon-cog-alt dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-right dzenkit-dropdown-menu dzenkit-check-menu pt-0" aria-labelledby="tableCog">
                            <li class="hdr">Настройка выдачи</li>
                            <li class="d-flex"><a class="dropdown-item icon-ok dzen-check " href="?orderby=desc">Новый сверху</a></li>
                            <li><a class="dropdown-item icon-ok dzen-check  actv " href="?orderby=asc">Новый снизу</a></li>
                                <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item icon-ok dzen-check js_show_hide_table_descripts" href="#">Раскрыть уточнения</a></li>
                        </ul>
                    </div>
                    <a href="" class="btn btn-dzenkit-action"><i class="icon-plus"></i>Добавить</a>
                </div>-->--}}
            </div>


            <div class="dzenkit-basic-card-body fill">

                <p class="h5 mt-3 mb-4">{{ trans("artadmin::permission.add") }}</p>


                <form action="{{ route('artadmin.permissions.add') }}" method="POST">

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>{{ trans("artadmin::roles.name") }}:</strong>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control" name="name" required placeholder="{{ trans("artadmin::roles.name") }}">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-4">
                            <strong>slug(a-z):</strong><br/>для разделения используйте нижнее подчеркивание _
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" class="form-control" name="slug" required placeholder="example , example_example">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-12 col-lg-8 offset-0 offset-lg-4 mb-3">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-dzenkit-action"><i class="icon-plus"></i>{{ trans("artadmin::permission.add") }}</button>
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
                            <td><button type="submit" class="btn btn-danger">{{ trans("artadmin::permission.add") }} </button></td>
                        </tr>
                    </table>-->--}}



                </form>
            </div>

            <div class="dzenkit-basic-card-body">

                <p class="h5 mt-3 mb-4">{{ trans("artadmin::permission.title") }}</p>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="navbar-col"></th>
                        <th>{{ trans("artadmin::roles.name") }}</th>
                        <th>slug</th>
                        <th></th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($rows))
                        @foreach($rows as $permission)
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
                                                        <li><a class="icon-trash-empty del d-flex align-items-center" href="{{ route("artadmin.permissions.delete",$permission->id) }}">Удалить без подтверждения</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- / action menu -->
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p>{{$permission->name}}</p>
                                </td>

                                <td>
                                    <p>{{$permission->slug}}</p>
                                </td>
                                <td><a href="{{ route("artadmin.permissions.delete",$permission->id) }}">{{ trans("artadmin::admins.delete") }}</a></td>

                            </tr>


                            {{--<!--<tr>
                                <td>
                                    {{$permission->name}}
                                </td>
                                <td>{{$permission->slug}}</td>
                                 <td><a href="{{ route("artadmin.permissions.delete",$permission->id) }}">{{ trans("artadmin::admins.delete") }}</a></td>
                            </tr>-->--}}


                        @endforeach
                    @endif
                    </tbody>
                </table>


            </div>

        </div>
    </div>
@endsection

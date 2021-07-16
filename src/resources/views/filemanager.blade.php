@extends('artadmin::auth_page')
@section('title', 'Файловый менеджер')
@section('content')
    <div class="main_content_iner">
        <div class="embed-responsive embed-responsive-1by1">
        <iframe src="{{ route('unisharp.lfm.show') }}"    ></iframe>
        </div>
    </div>
@endsection

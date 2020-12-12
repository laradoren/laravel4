@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="jumbotron">
                <h3 class="display-4">{{$page->title}}</h3>
                <p class="lead"><?php use App\Models\Parse;
                echo Parse::parse ($page->main_content ?? "")?></p>
                <hr class="my-4">
                <h3 class="lead">Author: {{$page->author}}</h3>
                <p>Created at: {{$page->created_at}}
                Updated at: {{$page->updated_at}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
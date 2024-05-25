@extends('theme.master')
@section('title','My Blogs')
@section('content')
@include('theme.partials.hero',['title'=>'My Blogs'])
<section class="section-margin--small section-margin">
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(session('BlogDeleteSuccess'))
                <div class="alert alert-success">{{ session('BlogDeleteSuccess') }}</div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Created At</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($blogs) > 0)
                        @foreach($blogs as $blog)
                            <tr>
                                <td><a href="{{ route("blogs.show",['blog'=> $blog]) }}" target="_blank">{{ $blog->name }}</a></td>
                                <td>{{ Str::limit($blog->description,50) }}</td>
                                <td>{{ $blog->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('blogs.edit',['blog'=>$blog]) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                    <form action="{{ route("blogs.destroy",['blog'=>$blog]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mr-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
@endsection

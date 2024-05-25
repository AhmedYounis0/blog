@extends('theme.master')
@section('title','Add blog')
@section('content')
@include('theme.partials.hero',['title'=>$blog->name])
<section class="section-margin--small section-margin">
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(session('BlogUpdateSuccess'))
                <div class="alert alert-success">{{ session('BlogUpdateSuccess') }}</div>
            @endif
            <form action="{{ route("blogs.update",['blog'=>$blog]) }}" class="form-contact contact_form" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input class="form-control" name="name" id="name" type="text" value="{{ $blog->name }}" placeholder="Enter your blog title">
                </div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group form-control">
                    <input class="form-control" name="image" type="file">
                </div>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <select class="form-control" name="category_id" >
                        <option selected disabled>Select Category</option>
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $blog->category_id)
                                    selected @endif>{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control different-control w-100" name="description" id="message" cols="30" rows="5" placeholder="Enter Blog Description">{{ $blog->description }}</textarea>
                </div>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group text-center text-md-right mt-3">
                    <button type="submit" class="button button--active button-contactForm">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection

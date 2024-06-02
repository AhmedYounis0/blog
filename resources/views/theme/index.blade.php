@extends('theme.master')
@section('title','Home')
@section('home-active','active')
@section('content')
<section class="mb-30px">
    <div class="container">
        <div class="hero-banner">
            <div class="hero-banner__content">
                <h3>Tours & Travels</h3>
                <h1>Amazing Places on earth</h1>
                <h4>December 12, 2018</h4>
            </div>
        </div>
    </div>
</section>
<!--================ Blog slider start =================-->
<section>
    <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
            @if(count($sliderBlogs))
                @foreach($sliderBlogs as $sliderBlog)
                    <div class="card blog__slide text-center">
                        <div class="blog__slide__img">
                            <img class="card-img rounded-0" src="{{ "storage/blogs/$sliderBlog->image" }}" alt="">
                        </div>
                        <div class="blog__slide__content">
                            <a class="blog__slide__label" href="{{ route('theme.category',['id'=>$sliderBlog->category->id]) }}">{{ $sliderBlog->category->name }}</a>
                            <h3><a href="{{ route("blogs.show",['blog'=> $sliderBlog]) }}">{{ $sliderBlog->name }}</a></h3>
                            <p>2 days ago</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!--================ Blog slider end =================-->
<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin mt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @if(count($blogs) > 0)
                    @foreach($blogs as $blog)
                        <div class="single-recent-blog-post">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ asset("storage/blogs/$blog->image") }}" alt="">
                                <ul class="thumb-info">
                                    <li><i class="ti-user"></i>{{ $blog->user->name }}</li>
                                    <li><i class="ti-notepad"></i>{{ $blog->created_at->format('d M Y') }}</li>
                                    <li><i class="ti-themify-favicon"></i>{{ count($blog->comments) }} Comments</li>
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="{{ route("blogs.show",['blog'=> $blog]) }}"><h3>{{ $blog->name }}</h3></a>
                                <p>{{ Str::limit($blog->description,250) }}</p>
                                <a class="button" href="{{ route("blogs.show",['blog'=> $blog]) }}">Read More <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        {{ $blogs->render('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            @include('theme.partials.sidebar')
        </div>
</section>
<!--================ End Blog Post Area =================-->
@endsection

@php
$categories = \App\Models\Category::get();
$recentBlogs = \App\Models\Blog::latest()->take(3)->get();
@endphp
<!-- Start Blog Post Siddebar -->
<div class="col-lg-4 sidebar-widgets">
    <div class="widget-wrap">
        <div class="single-sidebar-widget newsletter-widget">
            <h4 class="single-sidebar-widget__title">Newsletter</h4>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('subscribe.register') }}" method="POST">
                @csrf
                <div class="form-group mt-30">
                    <div class="col-autos">
                        <input type="text" class="form-control" name="email" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                               onblur="this.placeholder = 'Enter email'" value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button class="bbtns d-block mt-20 w-100">Subscribe</button>
            </form>
        </div>
        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">Catgory</h4>
            @if(count($categories) > 0)
                <ul class="cat-list mt-20">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('theme.category',['id' => $category->id]) }}" class="d-flex justify-content-between">
                            <p>{{ $category->name }}</p>
                            <p>({{ count($category->blogs) }})</p>
                        </a>
                    </li>
                @endforeach
            @endif
                </ul>
        </div>
        <div class="single-sidebar-widget popular-post-widget">
            <h4 class="single-sidebar-widget__title">Recent Post</h4>
            <div class="popular-post-list">
                @if(count($recentBlogs) > 0)
                    @foreach($recentBlogs as $blog)
                        <div class="single-post-list">
                            <div class="thumb">
                                <img class="card-img rounded-0" src="{{asset("storage/blogs/$blog->image")}}" alt="">
                                <ul class="thumb-info">
                                    <li>{{ $blog->user->name }}</li>
                                    <li>{{ $blog->created_at->format('m D') }}</li>
                                </ul>
                            </div>
                            <div class="details mt-20">
                                <a href="{{ route("blogs.show",['blog'=> $blog]) }}">
                                    <h6>{{ $blog->name }}</h6>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End Blog Post Siddebar -->

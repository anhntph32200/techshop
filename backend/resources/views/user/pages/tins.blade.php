@extends('user.layout')

@section('content')
<body class="right-sidebar blog-list">
    <div id="page" class="hfeed site">

        @include('user.partials.header')

        @include('user.partials.menu')

        <!-- .header-v2 -->
        <!-- ============================================================= Header End ============================================================= -->
        <div id="content" class="site-content">
            <div class="col-full">
                <div class="row">
                    <nav class="woocommerce-breadcrumb">
                        <a href="{{ route('users.index') }}">Trang chủ
                            <i class="fa fa-angle-right"></i>
                        </span>
                        Tin tức
                    </nav>
                    <!-- .woocommerce-breadcrumb -->
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            @foreach($news as $item)
                                <article class="post format-image hentry">
                                    <div class="media-attachment">
                                        <div class="post-thumbnail">
                                            <a href="{{ route('news.show', $item->id) }}">
                                                <img width="460" height="244" alt="{{ $item->title }}" class="wp-post-image" src="{{ asset('storage/' . $item->image) }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content-body">
                                        <header class="entry-header">
                                            <h1 class="entry-title">
                                                <a rel="bookmark" href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                                            </h1>
                                            <div class="entry-meta">
                                                <span class="cat-links">
                                                    <a href="{{ route('news.index') }}">Tin tức</a>
                                                </span>
                                                <span class="posted-on">
                                                    <time datetime="{{ $item->created_at->toAtomString() }}" class="entry-date published">{{ $item->created_at->format('F d, Y') }}</time>
                                                </span>
                                                <span class="author">
                                                    <a rel="author" href="#">{{ $item->author }}</a>
                                                </span>
                                            </div>
                                        </header>
                                        <div class="entry-content">
                                            <p>{{ Str::limit($item->content, 100) }}</p>
                                        </div>
                                        <div class="post-readmore">
                                            <a class="btn btn-primary" href="{{ route('tins.show', $item->id) }}">Xem thêm</a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                    
                            <!-- Pagination -->
                            <nav class="navigation pagination" id="post-navigation">
                                <span class="screen-reader-text">Posts navigation</span>
                                <div class="nav-links">
                                    {{ $news->links() }}
                                </div>
                            </nav>
                        </main>
                    </div>
                    
                    <!-- #primary -->
                    <div id="secondary" class="sidebar-blog widget-area" role="complementary">
                        <!-- Search Widget -->
                        <div class="widget widget_search" id="search-2">
                            <form action="#" class="search-form" method="get" role="search">
                                <label>
                                    <span class="screen-reader-text">Search for:</span>
                                    <input type="search" name="s" value="" placeholder="Search …" class="search-field">
                                </label>
                                <input type="submit" value="Search" class="search-submit">
                            </form>
                        </div>
                        <!-- Recent Posts Carousel Widget -->
                        <div class="widget techmarket_posts_carousel_widget">
                            <section class="section-posts-carousel" id="sidebar-posts-carousel">
                                <header class="section-header">
                                    <h2 class="section-title">Tin tức gần đây</h2>
                                </header>
                                <div class="post-item-carousel">
                                    @foreach ($recentPosts as $post)
                                        <div class="post-item">
                                            <a href="{{ route('news.show', $post->id) }}" class="post-thumbnail">
                                                <div class="post-thumbnail">
                                                    <img width="270" height="270" alt="{{ $post->title }}"
                                                         class="wp-post-image" src="{{ asset('storage/' . $post->image) }}">
                                                </div>
                                            </a>
                                            <div class="post-content">
                                                <a href="{{ route('tins.show', $post->id) }}" class="post-name">{{ $post->title }}</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        </div>
                    </div>                    
                    <!-- .sidebar-blog -->
                </div>
                <!-- .row -->
            </div>
            <!-- .col-full -->
        </div>
        <!-- #content -->
    
        @include('user.partials.footer')

        <!-- .site-footer -->
    </div>
    
    @include('user.partials.js')
    
</body>
@endsection
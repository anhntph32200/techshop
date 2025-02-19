@extends('user.layout')

@section('content')
<body class="right-sidebar single single-post">
    <div id="page" class="hfeed site">

        @include('user.partials.header')

        @include('user.partials.menu')

        <!-- .header-v2 -->
        <!-- ============================================================= Header End ============================================================= -->
        <div id="content" class="site-content">
            <div class="col-full">
                <div class="row">
                    <nav class="woocommerce-breadcrumb">
                        <a href="{{ route('users.index') }}">Trang chủ</a>
                        <span class="delimiter"><i class="tm tm-breadcrumbs-arrow-right"></i></span>
                        <a href="{{ route('news.index') }}">Tin tức</a>
                        <span class="delimiter"><i class="tm tm-breadcrumbs-arrow-right"></i></span>
                        <span>{{ $news->title }}</span>
                    </nav>
                    <!-- .woocommerce-breadcrumb -->
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <article class="post format-image">
                                <div class="media-attachment">
                                    <div class="post-thumbnail">
                                        <img width="1433" height="560" alt="{{ $news->title }}" class="wp-post-image"
                                            src="{{ asset('storage/' . $news->image) }}">
                                    </div>
                                </div>
                                <header class="entry-header">
                                    <h1 class="entry-title">{{ $news->title }}</h1>
                                    <!-- .entry-title -->
                                    <div class="entry-meta">
                                        <span class="cat-links">
                                            <a rel="category tag" href="#">{{ $news->category }}</a>
                                        </span>
                                        <!-- .cat-links -->
                                        <span class="posted-on">
                                            <a rel="bookmark" href="#">
                                                <time datetime="{{ $news->created_at->format('Y-m-d H:i:s') }}"
                                                    class="entry-date published">{{ $news->created_at->format('F d, Y') }}</time>
                                            </a>
                                        </span>
                                        <!-- .posted-on -->
                                        <span class="author">
                                            <a rel="author" title="Posts by {{ $news->author }}" href="#">{{ $news->author }}</a>
                                        </span>
                                        <!-- .author -->
                                    </div>
                                    <!-- .entry-meta -->
                                </header>
                                <!-- .entry-header -->
                                <div class="entry-content" itemprop="articleBody">
                                    {!! $news->content !!}
                                </div>
                                <!-- .entry-content -->
                            </article>
                        </main>
                        <!-- #main -->
                    </div>
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
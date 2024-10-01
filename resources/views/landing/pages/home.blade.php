@extends('landing.app')
@section('content')
    <!-- Navigation-->

    <!-- About-->
    <section class="content-section bg-light" id="about">
        <div class="container px-4 px-lg-5 text-center">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-10">
                    <h2>Stylish Portfolio is the perfect theme for your next project!</h2>
                    <p class="lead mb-5">
                        This StaterKite a flexible, UX friendly sidebar menu and stock photos from our friends at !
                        <a href="https://fathstore.com/">FathStore</a>
                        !
                    </p>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-dark btn-xl" href="#services">What We Offer</a>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-primary btn-xl text-center d-flex align-items-center justify-content-center" href="{{ route('fathink') }}" style="width: 1000px; height: 200px">
                                <span style="font-size: 2rem; line-height: 1;">Faththink</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services-->
    <section class="content-section bg-primary text-white text-center" id="services">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading">
                <h3 class="text-secondary mb-0">Services</h3>
                <h2 class="mb-5">What We Offer</h2>
            </div>

            <div class="row gx-4 gx-lg-5">
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-screen-smartphone"></i></span>
                    <h4><strong>Responsive</strong></h4>
                    <p class="text-faded mb-0">Looks great on any screen size!</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                    <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-pencil"></i></span>
                    <h4><strong>SPA</strong></h4>
                    <p class="text-faded mb-0">Very Fast.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                    <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-like"></i></span>
                    <h4><strong>Complete</strong></h4>
                    <p class="text-faded mb-0">
                        Millions of Feature
                    </p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <span class="service-icon rounded-circle mx-auto mb-3"><i class="icon-mustache"></i></span>
                    <h4><strong>Laravel 10</strong></h4>
                    <p class="text-faded mb-0">Very Artisan</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Callout-->
    <section class="callout">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mx-auto mb-5 text-white">
                Hi,
                <em>Grab it</em>
                Now!
            </h2>
            <a class="btn btn-primary btn-xl btn-block" href="{{ route('fathink') }}">Faththink</a>

        </div>
    </section>

    <!-- Project-->
    <section class="content-section" id="project">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Project</h3>
                <h2 class="mb-5">Recent Project</h2>
            </div>
            <div class="row gx-0">
                @forelse ($projects as $project)
                    <div class="col-lg-6 col-sm-12">
                        <!-- Menambahkan class project-container pada container -->
                        <a class="portfolio-item" href="{{ url('projects/detail/' . $project->uuid) }}">
                            <div class="caption">
                                <div class="caption-content">
                                    <div class="h2">{{ $project->title }}</div>
                                    <p class="mb-0">
                                        {{ substr($project->description, 0, 50) . (strlen($project->description) > 50 ? '...' : '') }}
                                    </p>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ App\Models\Media::getimageweb($project->meta['media_token']) }}"
                                alt="{{ $project->title }}" />
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No projects available at the moment.</p>
                    </div>
                @endforelse
                @if ($projects->isNotEmpty())
                    <div class="text-center my-4">
                        <a href="{{ url('projects/') }}" class="btn btn-primary-soft mb-0">See All<i
                                class="fas fa-sync ms-2"></i></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Product-->
    <section class="content-section" id="product">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Product</h3>
                <h2 class="mb-5">Recent Product</h2>
            </div>
            <div class="row gx-0">
                @forelse ($products as $product)
                    <div class="col-lg-6 col-sm-12">
                        <!-- Menambahkan class product-container pada container -->
                        <a class="portfolio-item" href="{{ url('products/detail/' . $product->uuid) }}">
                            <div class="caption">
                                <div class="caption-content">
                                    <div class="h2">{{ $product->name }}</div>
                                    <p class="mb-0">
                                        {{ substr($product->description, 0, 50) . (strlen($product->description) > 50 ? '...' : '') }}
                                    </p>
                                </div>
                            </div>
                            <img class="img-fluid"
                                src="{{ App\Models\Media::getimageweb($product->meta['media_token']) }}"
                                alt="{{ $product->name }}" />
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No products available at the moment.</p>
                    </div>
                @endforelse
                @if ($products->isNotEmpty())
                    <div class="text-center my-4">
                        <a href="{{ url('products/') }}" class="btn btn-primary-soft mb-0">See All<i
                                class="fas fa-sync ms-2"></i></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Post-->
    <section class="content-section" id="post">
        <div class="container px-4 px-lg-5">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Post</h3>
                <h2 class="mb-5">Recent Post</h2>
            </div>
            <div class="row gx-0">
                @forelse ($posts as $post)
                    <div class="col-lg-6 col-sm-12">
                        <!-- Menambahkan class post-container pada container -->
                        <a class="portfolio-item" href="{{ url('posts/detail/' . $post->uuid) }}">
                            <div class="caption">
                                <div class="caption-content">
                                    <div class="h2">{{ $post->name }}</div>
                                    <p class="mb-0">
                                        {{ substr($post->description, 0, 50) . (strlen($post->description) > 50 ? '...' : '') }}
                                    </p>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ App\Models\Media::getimageweb($post->meta['media_token']) }}"
                                alt="{{ $post->name }}" />
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No posts available at the moment.</p>
                    </div>
                @endforelse
                @if ($posts->isNotEmpty())
                    <div class="text-center my-4">
                        <a href="{{ url('posts/') }}" class="btn btn-primary-soft mb-0">See All<i
                                class="fas fa-sync ms-2"></i></a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Call to Action-->
    <section class="content-section bg-primary text-white">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="mb-4">The buttons below are impossible to resist...</h2>
            <a class="btn btn-xl btn-light me-4" href="#!">Click Me!</a>
            <a class="btn btn-xl btn-dark" href="#!">Look at Me!</a>
        </div>
    </section>
@endsection

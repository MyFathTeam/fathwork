@extends('landing.app')

@section('content')

<main>  
    <!-- Main Content START --> 
    <section class="pb-0 pt-4 pb-md-5">
        <div class="container">
            <div class="row">
                <!-- Content -->
                <div class="col-lg-12 col-xl-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <span id="product">Uploaded On {{ $product->created_at->diffForHumans() }}</span><span class="mx-2">|</span><div class="badge text-bg-success">{{$product['productcategory']['title']}}</div>
                            <!-- Title -->
                            <h1 class="mt-2 mb-0 display-6">{{$product->name}}</h1>
                            <div class="row mt-2">
                                <!-- Content -->
                                <div class="col-12 mt-lg-0 justify-content-center">
                                    <img width="100%" height="100%" src="{{App\Models\Media::getimageweb($product->meta['media_token'])}}" alt="">
                                </div>
                            </div>
                  
                            <div class="row mt-4">
                                <!-- Content -->
                                <div class="col-12 my-2 mt-lg-0">
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content END --> 
    <div class="text-center my-2">
        <a href="{{ route('products') }}" class="btn btn-primary-soft mb-0">See All<i
                class="fas fa-sync ms-2"></i></a>
    </div>
</main> 
@endsection

@extends('landing.app')

@section('content')

<main>  
    <!-- ======================= 
    Main Content START --> 
    <section class="pb-0 pt-4 pb-md-5">
                  <div class="container">
                    <div class="row">
                        <!-- Content -->
                        <div class="col-lg-12 col-xl-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <span id="post">Uploaded On {{ $post->created_at->diffForHumans() }}</span><span class="mx-2">|</span><div class="badge text-bg-success">{{$post['postcategory']['title']}}</div>
                            <!-- Title -->
                                <h1 class="mt-2 mb-0 display-6">{{$post->name}}</h1>
                                    <div class="row mt-2">
                                        <!-- Content -->
                                        <div class="col-12 mt-lg-0 justify-content-center">
                                            <img width="100%" height="100%" src="{{App\Models\Media::getimageweb($post->meta['media_token'])}}" alt="">
                                        </div>
                                    </div>
                                      <div class="row mt-4">
                                          <!-- Content -->
                                          <div class="col-12 my-2 mt-lg-0">
                                              <p>{{$post->description}}</p>
                                          </div>
                                      </div>
                                      <div class="col-lg-12 col-xl-12 mx-auto">
                                        <div class="bg-light rounded-3 p-3 p-md-4">
                                            <!-- Avatar -->
                                            <div class="d-flex align-items-center mt-2">
                                                <!-- Avatar image -->
                                                <div class="avatar avatar-md mx-2">
                                                    <img class="rounded" width="60px" height="60px" src="{{ asset($post->user['avatar'])}}" alt="avatar"  onerror="this.onerror=null; this.src='{{url('images/male.png')}}'">
                                                </div>
                                                <!-- Info -->
                                                <div class="mx-2">
                                                    <h6 class="mb-0">{{ $post['user']['name'] }}</h6>
                                                    <p class="mb-0 small">Unploaded On {{ Carbon\Carbon::parse($post->created_at)->format('l, j F Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pre title -->
                            
                            <!-- Info -->
                        </div>
                    </div>
                  </div>         
    </section>

    
    <!-- ======================= 
    Main Content END --> 
    <div class="text-center my-2">
        <a href="{{ url('posts/') }}" class="btn btn-primary-soft mb-0">See All<i
                class="fas fa-sync ms-2"></i></a>
    </div>
</main> 
@endsection

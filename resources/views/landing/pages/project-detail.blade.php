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
                            <span id="project">Uploaded On {{ $project->created_at->diffForHumans() }}</span>
                            <!-- Title -->
                            <h1 class="mt-2 mb-0 display-6">{{$project->title}}</h1>
                            <div class="row mt-2">
                                <!-- Content -->
                                <div class="col-12 mt-lg-0 justify-content-center">
                                    <img width="100%" height="100%" src="{{App\Models\Media::getimageweb($project->meta['media_token'])}}" alt="">
                                </div>
                            </div>
                  
                            <div class="row mt-4">
                                <!-- Content -->
                                <div class="col-12 my-2 mt-lg-0">
                                    <p>{{$project->description}}</p>
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
        <a href="{{ route('projects') }}" class="btn btn-primary-soft mb-0">See All<i
                class="fas fa-sync ms-2"></i></a>
    </div>
</main> 
@endsection

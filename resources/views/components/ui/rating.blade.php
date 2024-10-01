@props(['rating' => []])

<div class="flex items-center space-x-1">
    @foreach ($rating as $star)
        <span class="fa-stack" style="width:1em">
            <i class="far fa-star fa-lg text-yellow-500 fa-stack-1x"></i>
            @if($star == 'full')
                <i class="fas fa-star fa-lg text-yellow-500 fa-stack-1x"></i>
            @elseif($star == 'half')
                <i class="fas fa-star-half fa-lg text-yellow-500 fa-stack-1x"></i>
            @endif
        </span>
    @endforeach
</div>
@foreach($tutorials as $tutorial)
                <li class="video-tut-component__item">
                    <a href="">
                        <div class="visual-area">
                            <div class="visual-area__image">
                                <img src="{{storage_url()}}/{{$tutorial->thumbnail}}" class="img-fluid" alt="media">

                                <!-- Play Button -->
                                @if($tutorial->type == 0)
                                    <a class="icon" data-fancybox="" href="{{storage_url()}}/{{$tutorial->video}}">
                                @else
                                    <a class="icon" data-fancybox="" href="{{$tutorial->video}}">
                                @endif
                                    <img src="{{base_url()}}/public/front/images/page/videos/thumb/video-play.svg" class="img-fluid"
                                        alt="play">
                                </a>
                                <!-- Play Button END -->
                            </div>
                            <div class="visual-area__content">
                                @if($tutorial->type == 0)
                                    <a class="icon" data-fancybox="" href="{{storage_url()}}/{{$tutorial->video}}">
                                @else
                                    <a class="icon" data-fancybox="" href="{{$tutorial->video}}">
                                @endif
                                
                                <h4 class="visual-area__title">
                                
                                   {{$tutorial->title}}
                                   
                                </h4>
                                </a>
                                @if($tutorial->type == 0)
                                    <a class="icon" data-fancybox="" href="{{storage_url()}}/{{$tutorial->video}}">
                                @else
                                    <a class="icon" data-fancybox="" href="{{$tutorial->video}}">
                                @endif
                                <div class="visual-area__desc">
                                    {{$tutorial->description}}
                                </div>
                                </a>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
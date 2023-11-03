<h4 class="mb-4"> Reviews for "{{$product->name}}"</h4>
   @foreach($reviews as $review)
    <div class="media mb-4">
        @if(\Illuminate\Support\Facades\Auth::guard('customer')->check())
        <img src="{{asset('')}}{{$review->customers->image}}" alt="Image"
             class="img-fluid mr-3 mt-1" style="width: 45px;">
        @else
            <img src="{{asset('site')}}/img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
        @endif
        <div class="media-body">
            <h6>{{ $review->name}}<small> - <i>{{$review->created_at->format('Y-m-d')}}</i></small></h6>
            <div class="text-primary mb-2">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
            </div>
            <p>{{$review->message}}</p>
        </div>
    </div>
   @endforeach

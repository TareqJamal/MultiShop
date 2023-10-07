@extends("Admin.layout.index")
@section('title')
    Stores Status
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach($stores as $store)
                <div class="card" style="width: 18rem; margin: 10px; padding: 10px">
                    <img style="height: 250px;" class="card-img-top" src="{{asset('')}}{{$store->image}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center; font-weight: bold">{{$store->name}}</h5>
                        <br>
                        <h5 class="card-title">Storage Capacity : {{$store->storageCapacity}}</h5>
                        @if($store->storageCapacity != 0)
                            <p class="card-text" >Status: <span style="color:green; font-weight: bold"> Not Complete</span></p>
                        @else
                            <p class="card-text" >Status: <span style="color:red; font-weight: bold"> Completed</span> </p>
                        @endif
                        @if(count($store->products) != 0)
                        <h5 class="card-title">Number of Products  : <a href="{{route('storesStatus.show',$store->id)}}">{{count($store->products)}}</a></h5>
                        @else
                            <h5 style="text-align: center; font-weight: bold ; color: red" class="card-title">No Products in Store</h5>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection


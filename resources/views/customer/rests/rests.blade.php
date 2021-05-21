@extends('layouts.customer')
@section('content')
    {{$restaurants->appends(\request()->query())->links()}}
<section style="min-height: 650px">
    <div class="container">
    <div class="mt-5" style="min-height: 50px"></div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="pr-2">you are searching in : </span>
                <li class="breadcrumb-item"><?php try{echo \App\Models\City::find(\App\Models\State::find($_GET['state'])->city_id)->name;}catch (\Exception $e){}?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php try{echo\App\Models\State::find($_GET['state'])->name;}catch (\Exception $e){}?></li>
                <span class="pl-3"><a href="{{route('welcome')}}">Change Location</a></span>
            </ol>
        </nav>
    <div class="row pt-5" style="border: solid 1px;min-height: 1000px;">
        <div class="col-md-4">
            <form class="col-md-2" style="position: fixed" action="{{route('find.rests.filters')}}">
                <input type="hidden" name="city" value="{{$_GET['city']}}">
                <input type="hidden" name="state" value="{{$_GET['state']}}">
                <div class="card pl-3 pr-3 mb-3">
                    <input type="text" name="name" value="{{isset($_GET['name'])?$_GET['name']:''}}" class="form-control mt-3 mb-3" placeholder="Restaurant name" style="border-radius: 1px;">
                </div>
                <div class="card pl-3 pr-3 pt-2 mb-3">
                    <h5 style="color:#000">Sort by :</h5>
                    <div class="mb-3">
                        <select class="custom-select" name="sort">
                            <option value="0" {{isset($_GET['sort'])&&$_GET['sort']==0?'selected':''}}>default</option>
                            <option value="1" {{isset($_GET['sort'])&&$_GET['sort']==1?'selected':''}}>Newest</option>
                            <option value="2" {{isset($_GET['sort'])&&$_GET['sort']==2?'selected':''}}>Fast Delivery</option>
                            <option value="3" {{isset($_GET['sort'])&&$_GET['sort']==3?'selected':''}}>Low Delivery Cost</option>
                        </select>
                    </div>
                </div>
                <div class="card pl-3 pr-3 pt-2">
                    <h5 style="color:#000">Categories :</h5>
                    <div class="mb-2">
                        <select class="custom-select" name="category">
                            <option value="0" {{isset($_GET['category'])&&$_GET['category']==0?'selected':''}}>All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{isset($_GET['category'])&&$_GET['category']==$category->id?'selected':''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="Apply Filters" class="btn btn-primary mt-3 mb-3" style="border-radius: 1px;">
                </div>
            </form>
        </div>
<div class="col-md-8 pt-5">
    @if(isset($restaurants[0]))
<div class="scrolling-pagination">
    <div class="" id="myItems">
    @foreach($restaurants as $restaurant)
        <div class="card mb-3" style="max-height: 150px">
            <div class="card-block">
            <div class="row no-gutters">
                <div class="col-md-2 p-2">
                    <img src="{{asset('images/vendors/'.$restaurant->logo)}}" class="card-img" height="100" width="50" alt="rest image">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5><a href="{{route('menu.rests',$restaurant->id)}}">{{$restaurant->name}}</a></h5>
                        <div class="row pl-3">
                            @if(isset($restaurant->categories)&&$restaurant->categories!=null)
                            @foreach($restaurant->categories as $index=>$category)
                                <p class="pl-1">{{(\App\Models\MainCategory::find($category->category_id))->name}} ,</p>
                            @endforeach
                            @endif
                        </div>
                        <div class="row pl-3">
                       <p class="">Time: <span style="font-size: 15px">{{$restaurant->delivery_time?:0}} mins</span></p>
                        <p class="pl-4">Delivery Fees: <span style="font-size: 15px">{{$restaurant->delivery_fees?:0}} EGP</span></p>
                            <p class="pl-4"><span style="font-size: 15px; color:{{$restaurant->open_status==0?'red':'green'}}">{{$restaurant->open_status==0?'closed':'open'}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

                @endforeach
    {{ $restaurants->links()}}
</div>
        </div>
        @else <h3>No Restaurants founded in this location</h3>
            <p>if you want to change location <a href="{{route('welcome')}}">Change Location</a></p>
            <h3>or change the filters </h3>
        @endif
    </div>
    </div>
    </div>
    </section>

    <script>

        window.onload=function () {

            $('ul.pagination').hide();
            $(function() {
                $('.scrolling-pagination').jscroll({
                    autoTrigger: 1,
                    nextSelector: '.pagination li.active + li a',
                    contentSelector: 'div.scrolling-pagination',
                    callback: function() {
                        $('ul.pagination').remove();
                    }
                });
            });

        };

    </script>
    @endsection
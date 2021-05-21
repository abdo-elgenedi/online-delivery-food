@extends('layouts.customer')
@section('header')
    <style>
        select{
            border-radius: 1px!important;
        }
    </style>
    <div class="site-blocks-cover" style="background-image: url({{asset('assets/website/images/hero_2.jpg')}});" data-aos="fade" id="home-section">

        <div class="container pt-5">

            <div class=" mt-5" style="padding-top: 25%;">
                <div class="text-center">
                <h3 style="color: white">Select Location to show the restaurants</h3>
                </div>
                <form class="row mt-5 pb-5 pt-5" action="{{route('find.rests')}}" method="get">
                    <select id="city" name="city" class="form-control  col-md-3 " data-live-search="true">
                        <option value="{{null}}">Select The City</option>
                        @foreach(\session('cities') as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div class="col-md-1"></div>
                    <select id="state" name="state" class="form-control  col-md-3"  >
                        <option value="{{null}}">Select The State</option>

                    </select>
                    <div class="col-md-1"></div>
                    <input type="submit" class="col-md-3 btn btn-primary" value="Search">
                </form>
            </div>
                <div class="col-md-10 mt-lg-5 text-center">

                </div>

            </div>
        </div>
    @endsection
@section('content')
    <link rel="stylesheet" href="{{asset('assets/website/style.css')}}">

        <div id="features" class="text-center">
            <div class="container">
                <div class="section-title">
                    <h2>Our Specials</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="features-item">
                            <h3>Breakfast</h3>
                            <img src="{{asset('assets/website/specials/2.jpg')}}" alt="" style="width: 100%">
                            <p style="text-align:justify">Do you want a delicious breakfast,
                                if you are in the beginning of your shift or you want a quick breakfast before going to work,
                                you can order from our restaurants and breakfast will arrive quickly .</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="features-item">
                            <h3>Launch &Dinner</h3>
                            <img src="{{asset('assets/website/specials/1.jpg')}}" alt="" style="width: 100%">
                            <p style="text-align:justify">If you want hot lunch or dinner,
                                you can go to our restaurants and you will find more,
                                just choose your place and the food will arrive as soon as possible,
                                and you will also find all kinds of food that you want.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="features-item">
                            <h3>Deserts</h3>
                            <img src="{{asset('assets/website/specials/3.jpg')}}" alt="" style="width: 100%">
                            <p style="text-align:justify">Are you in your relaxing time and want some fruit salad or even sweets,
                                do you have a birthday or even guests and you want to offer them sweets
                                , you can enter our list and choose sweets and the restaurants that serve sweets appear to you</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--// about -->
    <!--/mid-sec-->
    <div id="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-6 about-img"> </div>
                <div class="col-xs-12 col-md-3 col-md-offset-1">
                    <div class="about-text">
                        <div class="section-title">
                            <h2>Our Restaurants</h2>
                        </div>
                        <p style="font-size: 18px">We have a very large and excellent group of restaurants,
                            as we choose the restaurants that will be registered with us carefully,
                            and we always check your opinions in those restaurants so that we can ensure the quality of all our restaurants</p>
                        <p style="font-size: 18px">You absolutely do not have to worry about the quality and health of the food,
                            and you will find in our list of restaurants all kinds of food that you are looking for</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--//mid-sec-->
    <!--/order-now-->
    <div id="restaurant-menu">
        <div class="container">
            <div class="section-title text-center">
                <h2>Menu</h2>
                <h3 class="menu-section-title">Some of our restaurants food</h3>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="menu-section">
                        @foreach($menu1 as $item)
                        <div class="menu-item">
                            <div class="menu-item-name">{{$item->name}}</div>
                            <div class="menu-item-price"> {{$item->price}} EGP</div>
                            <div class="menu-item-description"> {{$item->description}}. </div>
                            <div class="menu-item-description text-success">Restaurant : {{$item->vendor->name}}. </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="menu-section">
                        @foreach($menu2 as $item)
                            <div class="menu-item">
                                <div class="menu-item-name">{{$item->name}}</div>
                                <div class="menu-item-price"> {{$item->price}} EGP</div>
                                <div class="menu-item-description"> {{$item->description}}. </div>
                                <div class="menu-item-description text-success">Restaurant : {{$item->vendor->name}}. </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>
    <!--//order-now-->

    <!-- Gallery -->
    <div id="team">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="section-title">
                            <h2>Ordering Steps</h2>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">Select your location to get restaurants</li>
                            <li class="list-group-item">Select your favourite restaurant</li>
                            <li class="list-group-item">Add an items to your cart</li>
                            <li class="list-group-item">press checkout and confirm</li>
                            <li class="list-group-item">then you can track your order now</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="team-img"><img src="{{asset('assets/website/chef.jpg')}}" alt="..."></div>
                </div>
            </div>
        </div>
    </div>
    <!--// gallery -->
<?php session()->remove('cities') ?>
    <script>

        window.onload=function () {
            $('#city').on('change', function(e) {
                var button=this;
                e.preventDefault();
                $.ajax({
                    type:'get',
                    url:'{{route('home.getStates')}}',
                    data:{
                        'id':$('#city').val()
                    },
                    success:function (data) {
                        $('#state').children().remove().end().append('<option value="{{null}}">Select The State</option>');
                        for (var i in data.values) {
                            $('#state').append('<option value=' + data.values[i].id + '>' + data.values[i].name + '</option>');
                        }
                    },
                    error:function (reject) {

                    }
                })
            });
        }
    </script>
    @endsection
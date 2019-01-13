@extends('layouts.master')
@section('content')
<!-- Slider
================================================== -->
<div class="fullwidth-home-slider margin-bottom-0">
    @forelse($slider_properties as $property)
    <!-- Slide -->
    <div data-background-image="{{ $property->images[0] ?: '/images/no-image-placeholder.png' }}" class="item">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="home-slider-container">
                        
                        <!-- Slide Title -->
                        <div class="home-slider-desc">
                            
                            <div class="home-slider-price">
                                Rs. {{ $property->display_price }}
                            </div>
                            
                            <div class="home-slider-title">
                                <h3><a href="{{ route('properties.show', $property->id) }}">{{ $property->title }}</a></h3>
                                <span><i class="fa fa-map-marker"></i> {{ $property->address }}</span>
                            </div>
                            
                            <a href="{{ route('properties.show', $property->id) }}" class="read-more">View Details <i class="fa fa-angle-right"></i></a>
                            
                        </div>
                        <!-- Slide Title / End -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    @endforelse
</div>

<div class="container margin-top-20 margin-bottom-20">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="http://via.placeholder.com/728x90?text=ad+udaipurrealtors.com">
        </div>
    </div>
</div>

<!-- Content
================================================== -->
<!-- Search
================================================== -->
<section class="search margin-bottom-25">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Title -->
                <h3 class="search-title">Search Properties</h3>
                <!-- Form -->
                <form action="{{ route('properties.index') }}" method="get">
                    <div class="main-search-box no-shadow">
                        <!-- Row With Forms -->
                        <div class="row with-forms">
                            <!-- Status -->
                            <div class="col-md-3">
                                <select data-placeholder="Any Status" class="chosen-select-no-single" name="status">
                                    <option value="">Any Status</option>
                                    <option value="sell">For Sell</option>
                                    <option value="rent">For Rent</option>
                                </select>
                            </div>
                            <!-- Property Type -->
                            <div class="col-md-3">
                                <select data-placeholder="Any Type" class="chosen-select-no-single" name="type">
                                    <option value="">Any Type</option>
                                    <option value="apartment">Apartments</option>
                                    <option value="house">Houses</option>
                                    <option value="commercial">Commercial</option>
                                    <option value="land">Land</option>
                                </select>
                            </div>
                            <!-- Main Search Input -->
                            <div class="col-md-6">
                                <div class="main-search-input">
                                    <input type="text" placeholder="Enter address e.g. street, city or state" name="address" />
                                    <button class="button" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                        <!-- Row With Forms / End -->
                    </div>
                </form>
                <!-- Box / End -->
            </div>
        </div>
    </div>
</section>
<!-- Featured -->
<div class="container">
    <div class="row">
        
        <div class="col-md-12">
            <h3 class="headline margin-bottom-25 margin-top-25">Newly Added</h3>
        </div>
        
        <!-- Carousel -->
        <div class="col-md-12">
            <div class="carousel">
                @forelse($featured_properties as $property)
                <!-- Listing Item -->
                <div class="carousel-item">
                    <div class="listing-item compact">
                        
                        <a href="{{ route('properties.show', $property->id) }}" class="listing-img-container">
                            
                            <div class="listing-badges">
                                <span class="featured">Featured</span>
                                <span>{{ $property->status }}</span>
                            </div>
                            
                            <div class="listing-img-content">
                                <span class="listing-compact-title">{{ $property->title }} <i>Rs. {{ $property->display_price }}</i></span>
                                
                                <ul class="listing-hidden-content">
                                    <li>Area <span>{{ $property->area }} {{ $property->area_type }}</span></li>
                                    @if($property->rooms)
                                        <li>BHK <span>{{ $property->rooms }}</span></li>
                                    @endif
                                    @if(isset($property->detailed_info['bedrooms']))
                                        <li>Bedrooms <span>{{ $property->detailed_info['bedrooms'] }}</span></li>
                                    @endif
                                </ul>
                            </div>
                            
                            <img src="{{ $property->images[0] ?: '/images/no-image-placeholder-small.png' }}" alt="">
                        </a>
                     
                    </div>
                </div>
                <!-- Listing Item / End -->
                @empty
                @endforelse
            </div>
        </div>
        <!-- Carousel / End -->
    </div>
</div>
<!-- Featured / End -->

<!-- Recently Viewed -->
@if(count($recently_viewed_properties) > 0)
<div class="container">
    <div class="row">
        
        <div class="col-md-12">
            <h3 class="headline margin-bottom-25 margin-top-25">Recently Viewed</h3>
        </div>
        
        <!-- Carousel -->
        <div class="col-md-12">
            <div class="carousel">
                @forelse($recently_viewed_properties as $property)
                <!-- Listing Item -->
                <div class="carousel-item">
                    <div class="listing-item compact">
                        
                        <a href="{{ route('properties.show', $property->id) }}" class="listing-img-container">
                            
                            <div class="listing-badges">
                                <span class="featured">Featured</span>
                                <span>{{ $property->status }}</span>
                            </div>
                            
                            <div class="listing-img-content">
                                <span class="listing-compact-title">{{ $property->title }} <i>Rs. {{ $property->display_price }}</i></span>
                                
                                <ul class="listing-hidden-content">
                                    <li>Area <span>{{ $property->area }} {{ $property->area_type }}</span></li>
                                    @if($property->rooms)
                                        <li>BHK <span>{{ $property->rooms }}</span></li>
                                    @endif
                                    @if(isset($property->detailed_info['bedrooms']))
                                        <li>Bedrooms <span>{{ $property->detailed_info['bedrooms'] }}</span></li>
                                    @endif
                                </ul>
                            </div>
                            
                            <img src="{{ $property->images[0] ?: '/images/no-image-placeholder-small.png' }}" alt="">
                        </a>
                     
                    </div>
                </div>
                <!-- Listing Item / End -->
                @empty
                @endforelse
            </div>
        </div>
        <!-- Carousel / End -->
    </div>
</div>
@endif
<!-- Recently Viewed / End -->

<!-- Fullwidth Section -->
<section class="fullwidth margin-top-105 margin-bottom-0" data-background-color="#f7f7f7" style="background: rgb(247, 247, 247);">
    <!-- Box Headline -->
    <h3 class="headline-box">What are you looking for?</h3>
    
    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <!-- Icon Box -->
                <div class="icon-box-1">
                    <div class="icon-container">
                        <i class="im im-icon-Post-Sign"></i>
                        <div class="icon-links">
                            <a href="{{ route('properties.index').'?type=plot&status=sell' }}">For Sell</a>
                            <a href="{{ route('properties.index').'?type=plot&status=rent' }}">For Rent</a>
                        </div>
                    </div>
                    <h3>Plots</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <!-- Icon Box -->
                <div class="icon-box-1">
                    <div class="icon-container">
                        <i class="im im-icon-Home-2"></i>
                        <div class="icon-links">
                            <a href="{{ route('properties.index').'?type=house&status=sell' }}">For Sell</a>
                            <a href="{{ route('properties.index').'?type=house&status=rent' }}">For Rent</a>
                        </div>
                    </div>
                    <h3>Houses</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <!-- Icon Box -->
                <div class="icon-box-1">
                    <div class="icon-container">
                        <i class="im im-icon-Office"></i>
                        <div class="icon-links">
                            <a href="{{ route('properties.index').'?type=apartment&status=sell' }}">For Sell</a>
                            <a href="{{ route('properties.index').'?type=apartment&status=rent' }}">For Rent</a>
                        </div>
                    </div>
                    <h3>Apartments</h3>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <!-- Icon Box -->
                <div class="icon-box-1">
                    <div class="icon-container">
                        <i class="im im-icon-Post-Office"></i>
                        <div class="icon-links">
                            <a href="{{ route('properties.index').'?type=commercial&status=sell' }}">For Sell</a>
                            <a href="{{ route('properties.index').'?type=commercial&status=rent' }}">For Rent</a>
                        </div>
                    </div>
                    <h3>Commercial</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Fullwidth Section / End -->
<div class="container margin-top-20 margin-bottom-20">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="http://via.placeholder.com/728x90?text=ad+udaipurrealtors.com">
        </div>
    </div>
</div>
<!-- Counters Container -->
<div class="parallax margin-top-0 margin-bottom-0"
    data-background="images/listings-parallax.jpg"
    data-color="#252529"
    data-color-opacity="0.85"
    data-img-width="800"
    data-img-height="505">
    
    <!-- Counters -->
    <div id="counters">
        <div class="container">
            
            <div class="row">
                
                <div class="counter-boxes-inside-parallax">
                    
                    <div class="col-md-4 col-sm-6">
                        <div class="counter-box">
                            <div class="counter-box-icon">
                                <i class="im im-icon-Home-2"></i>
                                <span class="counter">{{ \App\Property::where('status', '=', 'sell')->count() }}</span>
                                <p>Listings For Sell</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6">
                        <div class="counter-box">
                            <div class="counter-box-icon">
                                <i class="im im-icon-Money-2"></i>
                            <span class="counter">{{ \App\Property::where('status', '=', 'rent')->count() }}</span>
                                <p>Listings For Rent</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 col-sm-6">
                        <div class="counter-box last">
                            <div class="counter-box-icon">
                                <i class="im im-icon-Business-ManWoman"></i>
                                <span class="counter">{{ \App\User::count() }}</span>
                                <p>Users</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    <!-- Counters / End -->
    
    <!-- Flip banner -->
    <a href="{{ route('properties.index') }}" class="flip-banner parallax" data-color="#990003" data-color-opacity="0.9" data-img-width="2500" data-img-height="1600">
        <div class="flip-banner-content">
            <h2 class="flip-visible">We help people and homes find each other</h2>
            <h2 class="flip-hidden">Browse Properties <i class="sl sl-icon-arrow-right"></i></h2>
        </div>
    </a>
    <!-- Flip banner / End -->
    
</div>
<!-- Counters Container / End -->
@endsection
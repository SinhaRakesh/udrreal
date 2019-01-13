@extends('layouts.master')

@section('title', $property->title . ' For ' . ucwords($property->status) . ' At UdaipurRealtors.com')

@section('content')

<div class="container margin-top-20 margin-bottom-20">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="http://via.placeholder.com/728x90?text=ad+udaipurrealtors.com">
        </div>
    </div>
</div>

<!-- Titlebar
================================================== -->
<div id="titlebar" class="property-titlebar margin-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ URL::previous() }}" class="back-to-listings"></a>
                <div class="property-title">
                    <h2>{{ $property->title }} <span class="property-badge">For {{ ucwords($property->status) }}</span></h2>
                    <span>
                        <a href="#location" class="listing-address">
                            <i class="fa fa-map-marker"></i>
                            {{ $property->address }}
                        </a>
                    </span>
                </div>
                <div class="property-pricing">
                    <div>Rs. {{ $property->display_price }}</div>
                    @if($property->sub_price)
                    <div class="sub-price">Rs. {{ $property->sub_price }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content
================================================== -->
<div class="container">
    <div class="row margin-bottom-50">
        <div class="col-md-12">
            <!-- Slider Container -->
            <div class="property-slider-container">
                <!-- Agent Widget -->
                <div class="agent-widget">
                    @if(Auth::check())
                    <div class="agent-title">
                        <div class="agent-photo"><img src="/images/agent-avatar.jpg" alt="" /></div>
                        <div class="agent-details">
                            <h4><a href="#">{{ $property->user->name }}</a></h4>
                            <a href="tel:{{ $property->user->mobile }}"><span><i class="sl sl-icon-call-in"></i>{{ $property->user->mobile }}</span></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                <form action="{{ route('property.enquiry', $property->id) }}" method="post">
                        {{ csrf_field() }}
                        <input name="email" type="email" placeholder="Your Email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required>
                        <input name="mobile" type="text" placeholder="Your Mobile No." required>
                        <textarea name="message">I'm interested in this property [#{{ $property->id }}] and I'd like to know more details.</textarea>
                        <button class="button fullwidth margin-top-5" type="submit">Send Message</button>
                    </form>
                </div>
                <!-- Agent Widget / End -->
                <!-- Slider -->
                <div class="property-slider no-arrows">
                    @if(isset($property->images))
                        @foreach($property->images as $image)
                        <a href="{{ $image }}" data-background-image="{{ $image }}" class="item mfp-gallery"></a>
                        @endforeach
                    @else
                    <img src="/images/no-image-placeholder.png">
                    @endif
                </div>
                <!-- Slider / End -->
            </div>
            <!-- Slider Container / End -->
            <!-- Slider Thumbs -->
            <div class="property-slider-nav">
                @if(isset($property->images))
                @foreach($property->images as $image)
                <div class="item"><img src="{{ $image }}" alt=""></div>
                @endforeach
                @else
                    <img src="/images/no-image-placeholder.png">
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Property Description -->
        <div class="col-lg-8 col-md-7">
            <div class="property-description">
                <!-- Main Features -->
                <ul class="property-main-features">
                    <li>Area <span>{{ number_format($property->area, 0) }} {{ $property->area_type }}</span></li>
                    @if($property->rooms)
                        <li>BHK <span>{{ $property->rooms }}</span></li>
                    @endif
                    @if(isset($property->detailed_info['converted']))
                        <li>Property Status <span>{{ ucwords($property->detailed_info['converted']) }}</span></li>
                    @endif
                    @if(isset($property->detailed_info['bedrooms']))
                        <li>Bedrooms <span>{{ $property->detailed_info['bedrooms'] }}</span></li>
                    @endif
                    @if(isset($property->detailed_info['bathrooms']))
                        <li>Bathrooms <span>{{ $property->detailed_info['bathrooms'] }}</span></li>
                    @endif
                </ul>

                <div class="col-md-12 text-center margin-top-20 margin-bottom-30">
                    <img src="http://via.placeholder.com/728x90?text=ad+udaipurrealtors.com">
                </div>
                
                <!-- Details -->
                {{--  <h3 class="desc-headline">Details</h3>
                <ul class="property-features margin-top-0">
                    @if($property->detailed_info['building_age'])
                    <li>Building Age: <span>{{ $property->detailed_info['building_age'] }} Years</span></li>
                    @endif
                    <li>Heating: <span>Forced Air, Gas</span></li>
                    <li>Sewer: <span>Public/City</span></li>
                    <li>Water: <span>City</span></li>
                    <li>Exercise Room: <span>Yes</span></li>
                    <li>Storage Room: <span>Yes</span></li>
                </ul>  --}}
                <!-- Features -->
                <h3 class="desc-headline">Features</h3>
                <ul class="property-features checkboxes margin-top-0">
                    @forelse($property->features as $feature)
                    <li>{{ $feature->name }}</li>
                    @empty
                    @endforelse
                </ul>
                <!-- Description -->
                <h3 class="desc-headline">Description</h3>
                <div class="show-more">
                    {{ $property->description }}
                    <a href="#" class="show-more-button">Show More <i class="fa fa-angle-down"></i></a>
                </div>
                <!-- Location -->
                <h3 class="desc-headline no-border" id="location">Location</h3>
                <div id="propertyMap-container">
                <div id="propertyMap" data-latitude="{{ $property->geocode['lat'] }}" data-longitude="{{ $property->geocode['lng'] }}"></div>
                    <a href="#" id="streetView">Street View</a>
                </div>
                <!-- Similar Listings Container -->
                <h3 class="desc-headline no-border margin-bottom-35 margin-top-60">Similar Properties</h3>
                <!-- Layout Switcher -->
                <div class="layout-switcher hidden"><a href="#" class="list"><i class="fa fa-th-list"></i></a></div>
                <div class="listings-container list-layout">
                 @forelse($similarProperties as $similarProperty)
                <!-- Listing Item -->
                <div class="listing-item">
                    <a href="{{ route('properties.show', $similarProperty->id) }}" class="listing-img-container">
                        <div class="listing-badges">
                            <span class="featured">Featured</span>
                            <span>{{ $similarProperty->status }}</span>
                        </div>
                        <div class="listing-img-content">
                            <span class="listing-price">Rs. {{ $similarProperty->display_price }} 
                            @if($similarProperty->sub_price)
                            <i>{{ $similarProperty->sub_price }}</i>
                            @endif
                            </span>
                            <span class="like-icon tooltip"></span>
                        </div>
                        <div class="listing-carousel">
                            @if($similarProperty->images)
                                @foreach($similarProperty->images as $image)
                                <div><img src="{{ $image }}" alt=""></div>
                                @endforeach
                            @else
                            <div><img src="/images/no-image-placeholder.png" alt=""></div>
                            @endif
                        </div>
                    </a>
                    
                    <div class="listing-content">
                        <div class="listing-title">
                            <h4><a href="{{ route('properties.show', $similarProperty->id) }}">{{ $similarProperty->title }}</a></h4>
                            <a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
                                <i class="fa fa-map-marker"></i>
                                {{ $similarProperty->address }}
                            </a>
                            <a href="{{ route('properties.show', $similarProperty->id) }}" class="details button border">Details</a>
                        </div>
                        <ul class="listing-details">
                            <li>{{ number_format($similarProperty->area, 0) }} {{ $similarProperty->area_type }}</li>
                            @if($similarProperty->rooms)
                                <li><span>{{ $similarProperty->rooms }}</span> BHK</li>
                            @endif
                            @if(isset($similarProperty->detailed_info['bedrooms']))
                                <li><span>{{ $similarProperty->detailed_info['bedrooms'] }}</span> Bedrooms</li>
                            @endif
                        </ul>
                        <div class="listing-footer">
                            <a href="#"><i class="fa fa-user"></i> {{ $similarProperty->user->name }}</a>
                            <span><i class="fa fa-calendar-o"></i> {{ $similarProperty->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <!-- Listing Item / End -->
                @empty
                @endforelse
                </div>
                <!-- Similar Listings Container / End -->
            </div>
        </div>
        <!-- Property Description / End -->
        <!-- Sidebar -->
        <div class="col-lg-4 col-md-5">
            <div class="sidebar sticky right">
                <!-- Widget -->
                <div class="widget">
                    <h3 class="margin-bottom-35">Featured Properties</h3>
                    <div class="listing-carousel outer">
                        @forelse($featuredProperties as $featuredProperty)
                        <!-- Item -->
                        <div class="item">
                            <div class="listing-item compact">
                                <a href="{{ route('properties.show', $featuredProperty->id) }}" class="listing-img-container">
                                    <div class="listing-badges">
                                        <span class="featured">Featured</span>
                                        <span>{{ $featuredProperty->status }}</span>
                                    </div>
                                    <div class="listing-img-content">
                                        <span class="listing-compact-title">{{ $featuredProperty->title }} <i>Rs. {{ $featuredProperty->display_price }}</i></span>
                                        <ul class="listing-hidden-content">
                                            <li>Area <span>{{ $featuredProperty->area }} {{ $featuredProperty->area_type }}</span></li>
                                            @if($featuredProperty->rooms)
                                                <li>BHK <span>{{ $featuredProperty->rooms }}</span></li>
                                            @endif
                                            @if(isset($featuredProperty->detailed_info['bedrooms']))
                                                <li>Bedrooms <span>{{ $featuredProperty->detailed_info['bedrooms'] }}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <img src="{{ $featuredProperty->images[0] ?? '/images/no-image-placeholder-small.png' }}" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- Item / End -->
                        @empty
                        @endforelse
                    </div>
                </div>
                <!-- Widget / End -->
                <div class="widget">
                    <div class="col-md-12 text-center margin-bottom-35">
                        <img src="http://via.placeholder.com/300x250?text=ad+udaipurrealtors.com">
                    </div>
                </div>
                <!-- Widget -->
                <div class="widget margin-bottom-40">
                    <h3 class="margin-top-0 margin-bottom-35">Find New Home</h3>
                    <form action="{{ route('properties.index') }}" method="get">
                    <!-- Row -->
                        <div class="row with-forms">
                            <!-- Status -->
                            <div class="col-md-12">
                                <select data-placeholder="Any Status" class="chosen-select-no-single" name="status">
                                    <option value="">Any Status</option>
                                    <option value="sell">For Sell</option>
                                    <option value="rent">For Rent</option>
                                </select>
                            </div>
                        </div>
                        <!-- Row / End -->
                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Type -->
                            <div class="col-md-12">
                                <select data-placeholder="Any Type" class="chosen-select-no-single" name="type">
                                    <option value="">Any Type</option>
                                    <option value="apartment">Apartments</option>
                                    <option value="house">Houses</option>
                                    <option value="commercial">Commercial</option>
                                    <option value="land">Land</option>
                                </select>
                            </div>
                        </div>
                        <!-- Row / End -->
                        <!-- Main Search Input -->
                        <div class="row with-forms">
                            <div class="col-md-12">
                                <div class="main-search-input">
                                    <input type="text" placeholder="Enter address e.g. street, city or state" name="address" />
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="button fullwidth margin-top-20">Search</button>
                    </form>
                </div>
                <!-- Widget / End -->
            </div>
        </div>
        <!-- Sidebar / End -->
    </div>
</div>
@endsection

@section('afterScripts')
<script>
    if(window.location.hash == '#enquiry-success') {
        alert('Thank you for your enquiry. We will get in touch with you shortly!');
    }
</script>
@endsection
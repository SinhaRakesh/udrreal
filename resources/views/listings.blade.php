@extends('layouts.master')

@section('title', 'Listings - UdaipurRealtors.com')

@section('content')
<!-- Titlebar
================================================== -->
<div class="parallax titlebar"
    data-background="images/listings-parallax.jpg"
    data-color="#333333"
    data-color-opacity="0.7"
    data-img-width="800"
    data-img-height="505">
    <div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>All Properties</h2>
                    <span>List Of all properties</span>
                    
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li>Listings</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content
================================================== -->
<div class="container">
    <div class="row sticky-wrapper">
        <div class="col-md-8">
            <!-- Sorting / Layout Switcher -->
            <div class="row margin-bottom-15">
                <div class="col-md-12 margin-bottom-20">
                    <div class="text-center">
                        <img src="http://via.placeholder.com/728x90?text=ad+udaipurrealtors.com">
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Sort by -->
                    <div class="sort-by">
                        <label>Sort by:</label>
                        <div class="sort-by-select">
                            <select id="sortby" data-placeholder="Default order" class="chosen-select-no-single" >
                                <option>Default Order</option>
                                <option value="price_asc" {{ ($options->get('sort') == 'price_asc') ? 'selected' : '' }}>Price Low to High</option>
                                <option value="price_desc" {{ ($options->get('sort') == 'price_desc') ? 'selected' : '' }}>Price High to Low</option>
                                <option value="newest" {{ ($options->get('sort') == 'newest') ? 'selected' : '' }}>Newest Properties</option>
                                <option value="oldest" {{ ($options->get('sort') == 'oldest') ? 'selected' : '' }}>Oldest Properties</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Layout Switcher -->
                    <div class="layout-switcher">
                        <a href="#" class="list"><i class="fa fa-th-list"></i></a>
                        {{-- <a href="#" class="grid"><i class="fa fa-th-large"></i></a> --}}
                    </div>
                </div>
            </div>
            
            <!-- Listings -->
            <div class="listings-container list-layout clearfix">
                @forelse($properties as $property)
                <!-- Listing Item -->
                <div class="listing-item">
                    <a target="_blank" href="{{ route('properties.show', $property->id) }}" class="listing-img-container">
                        <div class="listing-badges">
                            <span class="featured">Featured</span>
                            <span>{{ $property->status }}</span>
                        </div>
                        <div class="listing-img-content">
                            <span class="listing-price">Rs. {{ $property->display_price }} 
                            @if($property->sub_price)
                            <i>{{ $property->sub_price }}</i>
                            @endif
                            </span>
                            <span class="like-icon tooltip"></span>
                        </div>
                        <div class="listing-carousel">
                            @if($property->images)
                            @foreach($property->images as $image)
                            <div><img src="{{ $image }}" alt=""></div>
                            @endforeach
                            @else
                            <div><img src="/images/no-image-placeholder-small.png" alt=""></div>
                            @endif
                        </div>
                    </a>
                    
                    <div class="listing-content">
                        <div class="listing-title">
                            <h4><a target="_blank" href="{{ route('properties.show', $property->id) }}">{{ $property->title }}</a></h4>
                            <a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
                                <i class="fa fa-map-marker"></i>
                                {{ $property->address }}
                            </a>
                            <a target="_blank" href="{{ route('properties.show', $property->id) }}" class="details button border">Details</a>
                        </div>
                        <ul class="listing-details">
                            <li>{{ $property->area }}/{{ $property->area_type }}</li>
                            @if($property->rooms)
                                <li><span>{{ $property->rooms }}</span> BHK</li>
                            @endif
                            @if(isset($property->detailed_info['bedrooms']))
                                <li><span>{{ $property->detailed_info['bedrooms'] }}</span> Bedrooms</li>
                            @endif
                        </ul>
                        <div class="listing-footer">
                            <a href="#"><i class="fa fa-user"></i> {{ $property->user->name }}</a>
                            <span><i class="fa fa-calendar-o"></i> {{ $property->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <!-- Listing Item / End -->
                @empty
                @endforelse
            </div>
            <!-- Listings Container / End -->
            @if ($properties->hasPages())
            <!-- Pagination -->
            <div class="pagination-container margin-top-20 margin-bottom-100">
                <nav class="pagination-next-prev">
                    <ul>
                        {{-- Previous Page Link --}}
                        @if ($properties->onFirstPage())
                        <li><a class="prev disabled">Previous</a></li>
                        @else
                        <li><a href="{{ $properties->previousPageUrl() }}" class="prev">Previous</a></li>
                        @endif
                        {{-- Next Page Link --}}
                        @if ($properties->hasMorePages())
                        <li><a href="{{ $properties->nextPageUrl() }}" class="next">Next</a></li>
                        @else
                        <li><a class="next disabled">Next</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!-- Pagination / End -->
            @endif
            <div class="col-md-12 margin-bottom-20">
                <div class="text-center">
                    <img src="http://via.placeholder.com/728x90?text=ad+udaipurrealtors.com">
                </div>
            </div>
        </div>
        <!-- Sidebar
        ================================================== -->
        <div class="col-md-4">
            <div class="sidebar sticky right">
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
                <div class="widget margin-bottom-40">
                    <div class="col-md-12 text-center">
                        <img src="http://via.placeholder.com/300x250?text=ad+udaipurrealtors.com">
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar / End -->
    </div>
</div>
@endsection

@section('afterScripts')
<script>
    $('#sortby').change(function(e) {
        e.preventDefault();
        insertParam('sort', $(this).val());

    });
    function insertParam(key, value)
    {
        key = encodeURI(key); value = encodeURI(value);

        var kvp = document.location.search.substr(1).split('&');

        var i=kvp.length; var x; while(i--) 
        {
            x = kvp[i].split('=');

            if (x[0]==key)
            {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }

        if(i<0) {kvp[kvp.length] = [key,value].join('=');}

        //this will reload the page, it's likely better to store this until finished
        document.location.search = kvp.join('&'); 
    }
</script>
@endsection
@extends('layouts.master')

@section('title', 'Submit Property - UdaipurRealtors.com')

@section('content')
<div class="container">
    <div class="row">
        <!-- Submit Page -->
        <div class="col-md-12">
            <div class="submit-page margin-top-55">
                @if(!isset($property->status) OR !isset($property->type))
                    <form id="submit-form" action="{{ route('create') }}" method="get">
                        <h3>Submit Property</h3>
                        <div class="submit-section">
                            <div class="row with-forms">
                                <!-- Status -->
                                <div class="col-md-6">
                                    <h5>Status</h5>
                                    <select class="chosen-select-no-single" name="status" required>
                                        <option label="blank"></option>
                                        <option value="sell" {{ (old('status', optional($property)->status) == 'sell') ? 'selected' : ''}}>For Sell</option>
                                        <option value="rent" {{ (old('status', optional($property)->status) == 'rent') ? 'selected' : ''}}>For Rent</option>
                                    </select>
                                </div>
                                <!-- Type -->
                                <div class="col-md-6">
                                    <h5>Type</h5>
                                    <select class="chosen-select-no-single" name="type" required>
                                        <option label="blank"></option>
                                        <option value="apartment" {{ (old('type', optional($property)->type) == 'apartment') ? 'selected' : ''}}>Apartment</option>
                                        <option value="house" {{ (old('type', optional($property)->type) == 'house') ? 'selected' : ''}}>House</option>
                                        <option value="commercial" {{ (old('type', optional($property)->type) == 'commercial') ? 'selected' : ''}}>Commercial</option>
                                        <option value="plot" {{ (old('type', optional($property)->type) == 'plot') ? 'selected' : ''}}>Plot</option>
                                        <option value="land" {{ (old('type', optional($property)->type) == 'land') ? 'selected' : ''}}>Land</option>
                                        <option value="paying-guest" {{ (old('type', optional($property)->type) == 'paying-guest') ? 'selected' : ''}}>Paying Guest</option>
                                        <option value="hostel" {{ (old('type', optional($property)->type) == 'hostel') ? 'selected' : ''}}>Hostel</option>
                                        <option value="farmhouse" {{ (old('type', optional($property)->type) == 'farmhouse') ? 'selected' : ''}}>Farmhouse</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" id="submit-property-btn" class="button btn-lg preview margin-top-10 margin-bottom-20">Continue <i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </form>
                @else
                @if(optional($property)->id)
                    <form id="submit-form" action="{{ route('properties.update', $property->id) }}" method="post">
                    {{ method_field('PATCH') }}
                @else
                    <form id="submit-form" action="{{ route('properties.store') }}" method="post">
                @endif
                    {{ csrf_field() }}
                    <!-- Section -->
                    <h3>Basic Information</h3>
                    <div class="submit-section">
                        @if(!isset($property->status) OR !isset($property->type))
                            <div class="row with-forms">
                                <!-- Status -->
                                <div class="col-md-6">
                                    <h5>Status</h5>
                                    <select class="chosen-select-no-single" name="status">
                                        <option label="blank"></option>
                                        <option value="sell" {{ (old('status', optional($property)->status) == 'sell') ? 'selected' : ''}}>For Sell</option>
                                        <option value="rent" {{ (old('status', optional($property)->status) == 'rent') ? 'selected' : ''}}>For Rent</option>
                                    </select>
                                </div>
                                <!-- Type -->
                                <div class="col-md-6">
                                    <h5>Type</h5>
                                    <select class="chosen-select-no-single" name="type">
                                        <option label="blank"></option>
                                        <option value="apartment" {{ (old('type', optional($property)->type) == 'apartment') ? 'selected' : ''}}>Apartment</option>
                                        <option value="house" {{ (old('type', optional($property)->type) == 'house') ? 'selected' : ''}}>House</option>
                                        <option value="commercial" {{ (old('type', optional($property)->type) == 'commercial') ? 'selected' : ''}}>Commercial</option>
                                        <option value="land" {{ (old('type', optional($property)->type) == 'land') ? 'selected' : ''}}>Land</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="status" value="{{ $property->status }}">
                            <input type="hidden" name="type" value="{{ $property->type }}">
                        @endif
                        <!-- Row -->
                        
                        <!-- Row / End -->
                        <!-- Title -->
                        <div class="form">
                            <h5>Property Title <i class="tip" data-tip-content="Type title that will also contains an unique feature of your property (e.g. renovated, air contidioned)"></i></h5>
                            <input class="search-field" name="title" type="text" value="{{ old('title', optional($property)->title) }}" required/>
                        </div>
                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Price -->
                            <div class="col-md-4">
                                @if($property->status ==  'sell')
                                    @if($property->type == 'land')
                                        <h5>Price <i class="tip" data-tip-content="Price in price/bigha"></i></h5>
                                        <div class="select-input disabled-first-option">
                                            <input type="number" pattern="[0-9]*" data-unit="INR/Bigha" name="price" value="{{ old('price', optional($property)->price) }}" required>
                                            <input type="hidden" name="area_type" value="bigha">
                                        </div>
                                    @elseif($property->type == 'house')
                                    <h5>Price <i class="tip" data-tip-content="Price"></i></h5>
                                    <div class="select-input disabled-first-option">
                                        <input type="number" pattern="[0-9]*" data-unit="INR" name="price" value="{{ old('price', optional($property)->price) }}" required>
                                    </div>
                                    @else
                                        <h5>Price <i class="tip" data-tip-content="Price in Price/SqFt"></i></h5>
                                        <div class="select-input disabled-first-option">
                                            <input type="number" pattern="[0-9]*" data-unit="INR/SqFt" name="price" value="{{ old('price', optional($property)->price) }}" required>
                                        </div>
                                    @endif
                                @else
                                    <h5>Price <i class="tip" data-tip-content="Type monthly rent for the property"></i></h5>
                                    <div class="select-input disabled-first-option">
                                        <input type="number" pattern="[0-9]*" data-unit="INR/Month" name="price" value="{{ old('price', optional($property)->price) }}" required>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Area -->
                            <div class="col-md-4">
                                <h5>Area</h5>
                                <div class="select-input disabled-first-option">
                                    @if($property->type == 'land')
                                        <input type="number" pattern="[0-9]*" data-unit="Bigha" name="area" value="{{ old('area', optional($property)->area) }}" required>
                                    @else
                                        <input type="number" pattern="[0-9]*" data-unit="Sq Ft" name="area" value="{{ old('area', optional($property)->area) }}" required>
                                    @endif
                                </div>
                            </div>
                            @if($property->type == 'house' || $property->type == 'apartment')
                            <!-- Rooms -->
                            <div class="col-md-4">
                                <h5>BHK</h5>
                                <select class="chosen-select-no-single" name="rooms">
                                    <option label="blank"></option>
                                    <option value="1" {{ (old('rooms', optional($property)->rooms) == 1) ? 'selected' : ''}}>1 BHK</option>
                                    <option value="2" {{ (old('rooms', optional($property)->rooms) == 2) ? 'selected' : ''}}>2 BHK</option>
                                    <option value="3" {{ (old('rooms', optional($property)->rooms) == 3) ? 'selected' : ''}}>3 BHK</option>
                                    <option value="4" {{ (old('rooms', optional($property)->rooms) == 4) ? 'selected' : ''}}>4 BHK</option>
                                    <option value="5" {{ (old('rooms', optional($property)->rooms) == 5) ? 'selected' : ''}}>5 BHK</option>
                                    <option value="6" {{ (old('rooms', optional($property)->rooms) == 6) ? 'selected' : ''}}>6 BHK</option>
                                    <option value="7" {{ (old('rooms', optional($property)->rooms) == 7) ? 'selected' : ''}}>7 BHK</option>
                                    <option value="8" {{ (old('rooms', optional($property)->rooms) == 8) ? 'selected' : ''}}>8 BHK</option>
                                    <option value="9" {{ (old('rooms', optional($property)->rooms) == 9) ? 'selected' : ''}}>9 BHK</option>
                                    <option value="10" {{ (old('rooms', optional($property)->rooms) == 10) ? 'selected' : ''}}>10 BHK</option>
                                    <option value="11" {{ (old('rooms', optional($property)->rooms) == 11) ? 'selected' : ''}}>More Than 10 BHK</option>
                                </select>
                            </div>
                            @endif
                        </div>
                        <!-- Row / End -->
                    </div>
                    <!-- Section / End -->
                    <!-- Section -->
                    <h3>Gallery</h3>
                    <div class="submit-section">
                        <div id="my-dropzone" action="/upload" class="dropzone"></div>
                        {{-- <input id="dropzone-input" type="hidden" name="images" value="[]"> --}}
                    </div>
                    <!-- Section / End -->
                    <!-- Section -->
                    <h3>Location</h3>
                    <div class="submit-section">
                        <!-- Row -->
                        <div class="row with-forms">
                            <!-- Address -->
                            <div class="col-md-6">
                                <h5>Address</h5>
                                <input type="text" name="address" value="{{ old('address', optional($property)->address) }}" required>
                            </div>
                            <!-- City -->
                            <div class="col-md-6">
                                <h5>City</h5>
                                <input type="text" name="city" value="{{ old('city', optional($property)->city) }}" required>
                            </div>
                            <!-- City -->
                            <div class="col-md-6">
                                <h5>State</h5>
                                <input type="text" name="state" value="{{ old('state', optional($property)->state) }}" required>
                            </div>
                            <!-- Zip-Code -->
                            <div class="col-md-6">
                                <h5>Zip-Code</h5>
                                <input type="number" pattern="[0-9]*" name="zipcode" value="{{ old('zipcode', optional($property)->zipcode) }}" required>
                            </div>
                        </div>
                        <!-- Row / End -->
                    </div>
                    <!-- Section / End -->
                    <!-- Section -->
                    <h3>Detailed Information</h3>
                    <div class="submit-section">
                        <!-- Row -->
                        <div class="row with-forms">
                            @if($property->type == 'land' || $property->type == 'plot')
                            <div class="col-md-4">
                                <h5>Property Type:</h5>
                                <select class="chosen-select-no-single" name="detailed_info[converted]">
                                    <option label="blank"></option>
                                    <option value="converted" {{ (old('converted', optional($property)->detailed_info['converted']) == 'converted') ? 'selected' : ''}}>Converted</option>
                                    <option value="agriculture" {{ (old('converted', optional($property)->detailed_info['converted']) == 'agriculture') ? 'selected' : ''}}>Agriculture</option>
                                </select>
                            </div>
                            @endif
                            @if($property->type == 'house' || $property->type == 'apartment')
                            <div class="col-md-4">
                                <h5>Building Age</h5>
                                <select class="chosen-select-no-single" name="detailed_info[building_age]">
                                    <option label="blank"></option>
                                    <option value="1" {{ (old('building_age', optional($property)->detailed_info['building_age']) == 1) ? 'selected' : ''}}>0 - 1 Years</option>
                                    <option value="5" {{ (old('building_age', optional($property)->detailed_info['building_age']) == 5) ? 'selected' : ''}}>1 - 5 Years</option>
                                    <option value="10" {{ (old('building_age', optional($property)->detailed_info['building_age']) == 10) ? 'selected' : ''}}>5 - 10 Years</option>
                                    <option value="20" {{ (old('building_age', optional($property)->detailed_info['building_age']) == 20) ? 'selected' : ''}}>10 - 20 Years</option>
                                    <option value="50" {{ (old('building_age', optional($property)->detailed_info['building_age']) == 50) ? 'selected' : ''}}>50+ Years</option>
                                </select>
                            </div>
                            
                            <!-- Beds -->
                            <div class="col-md-4">
                                <h5>Bedrooms</h5>
                                <select class="chosen-select-no-single" name="detailed_info[bedrooms]">
                                    <option label="blank"></option>
                                    <option value="1" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 1) ? 'selected' : ''}}>1</option>
                                    <option value="2" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 2) ? 'selected' : ''}}>2</option>
                                    <option value="3" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 3) ? 'selected' : ''}}>3</option>
                                    <option value="4" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 4) ? 'selected' : ''}}>4</option>
                                    <option value="5" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 5) ? 'selected' : ''}}>5</option>
                                    <option value="6" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 6) ? 'selected' : ''}}>6</option>
                                    <option value="7" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 7) ? 'selected' : ''}}>7</option>
                                    <option value="8" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 8) ? 'selected' : ''}}>8</option>
                                    <option value="9" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 9) ? 'selected' : ''}}>9</option>
                                    <option value="10" {{ (old('bedrooms', optional($property)->detailed_info['bedrooms']) == 10) ? 'selected' : ''}}>10</option>
                                </select>
                            </div>
                            <!-- Baths -->
                            <div class="col-md-4">
                                <h5>Bathrooms</h5>
                                <select class="chosen-select-no-single" name="detailed_info[bathrooms]">
                                    <option label="blank"></option>
                                    <option value="1" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 1) ? 'selected' : ''}}>1</option>
                                    <option value="2" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 2) ? 'selected' : ''}}>2</option>
                                    <option value="3" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 3) ? 'selected' : ''}}>3</option>
                                    <option value="4" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 4) ? 'selected' : ''}}>4</option>
                                    <option value="5" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 5) ? 'selected' : ''}}>5</option>
                                    <option value="6" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 6) ? 'selected' : ''}}>6</option>
                                    <option value="7" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 7) ? 'selected' : ''}}>7</option>
                                    <option value="8" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 8) ? 'selected' : ''}}>8</option>
                                    <option value="9" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 9) ? 'selected' : ''}}>9</option>
                                    <option value="10" {{ (old('bathrooms', optional($property)->detailed_info['bathrooms']) == 10) ? 'selected' : ''}}>10</option>
                                </select>
                            </div>
                            @endif
                        </div>
                        <!-- Row / End -->
                        @if(!in_array($property->type, ['land', 'plot']))
                        <!-- Checkboxes -->
                        <h5 class="margin-top-30">Other Features <span>(optional)</span></h5>
                        <div class="checkboxes in-row margin-bottom-20">
                            @foreach($features as $feature)
                            <input id="check-{{ $feature->id }}" type="checkbox" value="{{ $feature->id }}" name="features[]" {{ in_array($feature->id, array_pluck(old('features', optional($property)->features ?: []), 'id')) ? 'checked' : '' }}>
                            <label for="check-{{ $feature->id }}">{{ $feature->name }}</label>
                            @endforeach
                        </div>
                        @endif
                        <!-- Checkboxes / End -->
                        <!-- Description -->
                        <div class="form margin-top-40 margin-bottom-0">
                            <h5>Description</h5>
                            <textarea class="WYSIWYG" placeholder="Enter complete detailed description for your property..." name="description" cols="40" rows="3" id="summary" spellcheck="true">{{ old('description', optional($property)->description) }}</textarea>
                        </div>
                    </div>
                    <!-- Section / End -->
                    <div class="divider"></div>
                    @forelse(optional($property)->images ?: [] as $image)
                        <input type="hidden" name="images[]" value="{{ $image }}">
                    @empty
                    @endforelse
                    <button type="submit" id="submit-property-btn" class="button btn-lg preview margin-top-5 margin-bottom-20">Submit <i class="fa fa-arrow-circle-right"></i></button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
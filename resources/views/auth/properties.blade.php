@extends('layouts.master')
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Dashboard</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>My Profile</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Content
================================================== -->
<div class="container">
    <div class="row">
        <!-- Widget -->
        @include('partials.dashboard-sidebar')
        <div class="col-md-8">
            <table class="manage-table responsive-table">

                <tr>
                    <th><i class="fa fa-file-text"></i> Property</th>
                    <th class="expire-date"><i class="fa fa-calendar"></i> Added on</th>
                    <th></th>
                </tr>
                @forelse($properties as $property)
                <!-- Item -->
                <tr>
                    <td class="title-container">
                        <img src="{{ $property->images[0] ?? '/images/no-image-placeholder-small.png' }}" alt="">
                        <div class="title">
                            <h4><a href="{{ route('properties.show', $property->id) }}">{{ $property->title }}</a></h4>
                            <span>{{ $property->address }}</span>
                            <span class="table-property-price">
                                Rs. {{ $property->display_price }}
                            </span>
                        </div>
                    </td>
                    <td class="expire-date">{{ $property->created_at->toFormattedDateString() }}</td>
                    <td class="action">
                        <a href="{{ route('properties.edit', $property->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                        <a data-id="{{ $property->id }}" href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>
                    </td>
                </tr>
                @empty
                @endforelse

            </table>
            <a href="{{ route('create') }}" class="margin-top-40 button">Submit New Property</a>
        </div>
    </div>
</div>
@endsection

@section('afterScripts')
<script>
    $('a.delete').click(function(e) {
        e.preventDefault();
        var r = confirm("Are you sure you want to remove this property?!");
        if (r == true) {
            var deleteUrl = "/properties/" + $(this).attr("data-id");
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax(
            {
                url: deleteUrl,
                type: 'delete', // replaced from put
                dataType: "JSON",
                data: {},
                complete: function(xhr, status) {
                    if(status == 'success') {
                        alert("Your Property Has Been Removed!");
                        window.location.reload(true);
                    } else {
                        alert("Error occured while removing the property!");
                    }
                }
            });
        }
    });
</script>
@endsection
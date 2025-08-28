@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Request Quotes</li>
                </ol>
            </nav>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Request Quotes List</h5>
            </div>
            <div class="row mb-3 px-3 pt-3">
                <div class="col-md-4">
                    <label>Category <span class="text-danger">*</span></label>
                    <select id="categoryFilter" class="form-select">
                        <option value="">All categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Product <span class="text-danger">*</span></label>
                    <select id="productFilter" class="form-select">
                        <option value="">All product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-body">
                <table id="example" class="table table-responsiv" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Sr. No.</th>
                            <th>Category</th>
                            <th>Product name</th>
                            <th class="text-center">Customer Details</th>
                            <th class="text-center text-nowrap">Company Details</th>
                            <th class="text-center text-nowrap">Other Details</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Last Update</th>
                        </tr>
                    </thead>
                    <tbody id="quoteTableBody">
                        @forelse ($requested_quotes as $index => $requested_quote)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <a
                                        class="d-flex align-items-center">
                                          @if (!empty($requested_quote->product->category->category_image))
                                                <img src="{{ asset('storage/' . $requested_quote->product->category->category_image) }}"
                                                    class="user-img me-2" alt="Category Image">
                                            @else
                                                <img src="{{ asset('admin/images/logo-icon.png') }}" class="user-img"
                                                    alt="Default Image me-2">
                                            @endif
                                           
                                        <div class="user-info">
                                            <p class="category user-name mb-0">{{ $requested_quote->product->category->category_name ?? 'N/A' }}</p>
                                        </div>
                                    </a>
                                </td>
                                <!--<td class="text-center">{{ $requested_quote->product->category->category_name ?? 'N/A'  }}</td>-->
                                <td>
                                    <a
                                        class="d-flex align-items-center">
                                        
                                            @if (!empty($requested_quote->product->product_main_image))
                                                <img src="{{ asset('storage/' . $requested_quote->product->product_main_image) }}"
                                                    class="user-img me-2" alt="Category Image">
                                            @else
                                                <img src="{{ asset('admin/images/logo-icon.png') }}" class="user-img"
                                                    alt="Default Image me-2">
                                            @endif
                                        <div class="user-info">
                                            <p class="product user-name mb-0">{{ $requested_quote->product_name }}</p>
                                        </div>
                                    </a>
                                </td>
                                <!--<td class="text-center">{{ $requested_quote->product_name}}</td>-->
                                <td class="text-center">{{ $requested_quote->name }}<br>{{ $requested_quote->email }}<br>{{ $requested_quote->phone }}</td>
                                <td class="text-center text-nowrap">{{ $requested_quote->company_name }}<br>Designation: {{ $requested_quote->designation }}</td>
                                <td class="text-center text-nowrap">Country: {{ $requested_quote->country }}<br>Role: {{ $requested_quote->role }}</td>
                                <td class="text-center">{{ $requested_quote->message }}</td>
                                <td class="text-center">{{ $requested_quote->updated_at->format('d-m-Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center">No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('#categoryFilter').on('change', function () {
            let selectedCategory = $(this).val().toLowerCase();
            let anyVisible = false;

            $('#quoteTableBody tr').each(function () {
                let rowCategory = $(this).find('td:nth-child(2) .category').text().toLowerCase();

                if (selectedCategory === '' || rowCategory === selectedCategory) {
                    $(this).show();
                    anyVisible = true;
                } else {
                    $(this).hide();
                }
            });

          
            if (!anyVisible) {
                $('#quoteTableBody').html(`
                    <tr>
                        <td colspan="13" class="text-center text-danger">No data found for selected category</td>
                    </tr>
                `);
            }
        });
        $('#productFilter').on('change', function () {
            let selectedProduct = $(this).val().toLowerCase();
            let anyVisible = false;

            $('#quoteTableBody tr').each(function () {
                let rowProduct = $(this).find('td:nth-child(3) .product').text().toLowerCase();

                if (selectedProduct === '' || rowProduct === selectedProduct) {
                    $(this).show();
                    anyVisible = true;$('#categoryFilter').on('change', function () {
            let selectedCategory = $(this).val().toLowerCase();
            let anyVisible = false;

            $('#quoteTableBody tr').each(function () {
                let rowCategory = $(this).find('td:nth-child(3)').text().toLowerCase();

                if (selectedCategory === '' || rowCategory === selectedCategory) {
                    $(this).show();
                    anyVisible = true;
                } else {
                    $(this).hide();
                }
            });

          
            if (!anyVisible) {
                $('#quoteTableBody').html(`
                    <tr>
                        <td colspan="13" class="text-center text-danger">No data found for selected category</td>
                    </tr>
                `);
            }
        });
                } else {
                    $(this).hide();
                }
            });

          
            if (!anyVisible) {
                $('#quoteTableBody').html(`
                    <tr>
                        <td colspan="13" class="text-center text-danger">No data found for selected Product</td>
                    </tr>
                `);
            }
        });
    });
</script>


@endsection

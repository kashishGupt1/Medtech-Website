@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            {{-- <div class="row mb-3 px-3 pt-3">
                <div class="col-md-4">
                    <select id="categoryFilter" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="card-header py-3">
                    <h5 class="mb-0">Contact Us List</h5>
                </div>

            <div class="card-body">
                <table id="example" class="table" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Sr. No.</th>                              
                            <th class="text-center">Customer Details</th> 
                            <th class="text-center">Product</th>
                            <th class="text-center">Country</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $index => $contact)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $contact->name?? 'N/A' }}<br>{{ $contact->email }}<br>{{ $contact->phone }}</td>
                                <td class="text-center">{{ $contact->product->product_name ?? 'N/A' }}</td>
                                <td class="text-center">{{ $contact->country }}</td>
                                <td class="text-center">{{ $contact->subject }}</td>
                                <td class="text-center">{{ $contact->message }}</td>
                                <td class="text-center">{{ $contact->updated_at->format('d-m-Y h:i A') }}</td>
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


{{-- <script>
    $(document).ready(function () {
        $('#categoryFilter').on('change', function () {
            let selectedCategory = $(this).val().toLowerCase();
            let anyVisible = false;

            $('#quoteTableBody tr').each(function () {
                let rowCategory = $(this).find('td:nth-child(2)').text().toLowerCase();

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
    });
</script> --}}


@endsection

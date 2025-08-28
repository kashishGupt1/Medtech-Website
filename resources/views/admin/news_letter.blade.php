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
                    <li class="breadcrumb-item active" aria-current="page">NewsLetter List</li>
                </ol>
            </nav>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">NewsLetter List</h5>
            </div>
            <div class="card-body">
                <table id="example" class="table" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Sr. No.</th>                         
                            <th class="text-center">Email</th>
                            <th class="text-center">Last Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($newsletters as $index => $newsletter)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>                                  
                                <td class="text-center">{{ $newsletter->email_address }}</td>                                   
                                <td class="text-center">{{ $newsletter->updated_at->format('d-m-Y h:i A') }}</td>
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

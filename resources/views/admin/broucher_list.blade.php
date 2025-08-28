@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Brouchers List</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">brouchers List</h5>
                    <a href="{{ url('/admin/add-brouchers') }}" class="btn btn-primary mb-3 mb-lg-0">Add New
                        brouchers</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Brouchers Name</th>                                   
                                <th class="text-center">Last Update</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brouchers as $index => $broucher)
                                <tr>
                                    <td class="text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="text-center"><a href="{{ asset('storage/' . $broucher->broucher_pdf) }}" target="_blank">Download PDF</a></td>
                                    
                                    <td class="text-center">{{ $broucher->updated_at->format('d-m-Y h:i A') }}</td>
                                    <td class="text-center order-actions">
                                        <a href="{{ route('admin.brouchers.edit', $broucher->id) }}"
                                            class=""><i class='bx bxs-edit'></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No broucher found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

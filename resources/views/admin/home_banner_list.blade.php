@extends('admin.layouts.layout')

@section('title', 'Admin Dashboard | Medtech')

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Banner List</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Banner List</h5>
                    <a href="{{ url('/admin/home-banner') }}" class="btn btn-primary mb-3 mb-lg-0">Add New Banner</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Desktop Banner</th>     
                                <th class="text-center">Mobile Banner</th>                                    
                                <th class="text-center">Status</th>
                                <th class="text-center">Last Update</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $index => $banner)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $banner->desktop_banner_photo) }}"
                                            class="user-img" alt=" Image">
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $banner->mobile_banner_photo) }}"
                                            class="user-img" alt=" Image">
                                    </td>

                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-{{ $banner->status == 'Active' ? 'success' : 'danger' }} btn-sm radius-30 px-4">
                                            {{ $banner->status }}
                                        </button>
                                    </td>
                                    <td class="text-center">{{ $banner->updated_at->format('d-m-Y h:i A') }}</td>
                                    <td class="text-center order-actions">
                                        <a href="{{ route('admin.banner.edit', $banner->id) }}" class=""><i class='bx bxs-edit'></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

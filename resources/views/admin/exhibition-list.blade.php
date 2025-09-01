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
                        <li class="breadcrumb-item active" aria-current="page">Exhibition List</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Exhibition List</h5>
                    <a href="{{ url('/admin/add-exhibition') }}" class="btn btn-primary mb-3 mb-lg-0">Add New Exhibition</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th>Exhibition Name</th>
                                <th class="text-center">Exhibition Start Date</th>
                                <th class="text-center">Exhibition Location</th>
                                <!--<th class="text-center">Exhibition Description</th>-->
                                {{-- <th class="text-center">Meta Keyword</th>
                                <th class="text-center">Meta Title</th>
                                <th class="text-center">Meta Description</th> --}}
                                <th class="text-center">Status</th>
                                <th class="text-center">Last Update</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exhibitions as $index => $exhibition)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <a
                                            class="d-flex align-items-center">
                                            @if (!empty($exhibition->exhibition_photo))
                                                <img src="{{ asset('storage/' . $exhibition->exhibition_photo) }}"
                                                    class="user-img me-2" alt="Category Image">
                                            @else
                                                <img src="{{ asset('admin/images/logo-icon.png') }}" class="user-img"
                                                    alt="Default Image me-2">
                                            @endif
                                            <div class="user-info">
                                                <p class="user-name mb-0">
                                                    {{ $exhibition->exhibition_name }}</p>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($exhibition->exhibition_start_date)->format('d-m-Y') }}</td>
                                    <td class="text-center">{{ $exhibition->exhibition_location }}</td>
                                    <!--<td class="text-center">{{ $exhibition->exhibition_description }}</td>-->
                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-{{ $exhibition->status == 'Active' ? 'success' : 'danger' }} btn-sm radius-30 px-4">
                                            {{ $exhibition->status }}
                                        </button>
                                    </td>
                                    <td class="text-center">{{ $exhibition->updated_at->format('d-m-Y h:i A') }}</td>
                                    <td class="text-center order-actions">
                                        <a href="{{ route('admin.exhibition.edit', $exhibition->id) }}" class=""><i class='bx bxs-edit'></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

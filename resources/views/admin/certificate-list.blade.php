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
                        <li class="breadcrumb-item active" aria-current="page">Certificate List</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Certificate List</h5>
                    <a href="{{ url('/admin/add-certificate') }}" class="btn btn-primary mb-3 mb-lg-0">Add New
                        Certificate</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">Sr. No.</th>
                                    <th class="text-center">Certificate Name</th>
                                    {{-- <th class="text-center">Breadcrumb Name</th>
                                    <th class="text-center">Breadcrumb Description</th>
                                    <th class="text-center">Meta Keyword</th>
                                    <th class="text-center">Meta Title</th>
                                    <th class="text-center">Meta Description</th> --}}
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Last Update</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($certificates as $index => $certificate)
                                    <tr>
                                        <td class="text-center">
                                            {{ $index + 1 }}
                                        </td>
                                        <td>
                                            <a
                                                class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret">
                                                @if (!empty($certificate->certificate_photo))
                                                    <img src="{{ asset('storage/' . $certificate->certificate_photo) }}"
                                                        class="user-img" alt="Category Image">
                                                @else
                                                    <img src="{{ asset('admin/images/logo-icon.png') }}" class="user-img"
                                                        alt="Default Image">
                                                @endif
                                                <div class="user-info">
                                                    <p class="user-name mb-0">{{ $certificate->certificate_name ?? '--' }}
                                                    </p>
                                                    <!-- <p class="designattion mb-0">Web Designer</p> -->
                                                </div>
                                            </a>
                                        </td>
                                        {{-- <td class="text-center">{{ $certificate->breadcrumb_name ?? '--' }}</td>
                                        <td class="text-center">{{ $certificate->breadcrumb_description ?? '--' }}</td>
                                        <td class="text-center">{{ $certificate->meta_keyword ?? '--' }}</td>
                                        <td class="text-center">{{ $certificate->meta_title ?? '--' }}</td>
                                        <td class="text-center">{{ $certificate->meta_description ?? '--' }}</td> --}}
                                        <td class="text-center">
                                            <button type="button"
                                                class="btn btn-{{ $certificate->status == 'Active' ? 'success' : 'danger' }} btn-sm radius-30 px-4">
                                                {{ $certificate->status }}
                                            </button>
                                        </td>
                                        <td class="text-center">{{ $certificate->updated_at->format('d-m-Y h:i A') }}</td>
                                        <td class="text-center order-actions">
                                            <a href="{{ route('admin.certificate.edit', $certificate->id) }}"
                                                class=""><i class='bx bxs-edit'></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No data found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

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
                        <li class="breadcrumb-item active" aria-current="page">Blog List</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Blog List</h5>
                    <a href="{{ url('/admin/add-blog') }}" class="btn btn-primary mb-3 mb-lg-0">Add New Blog</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th>Blog Details</th>
                                <th class="text-center">Blog Date</th>
                                <th class="text-center">Blog Location</th>
                                {{-- <th class="text-center">Blog Description</th>
                                <th class="text-center">Meta Keyword</th>
                                <th class="text-center">Meta Title</th>
                                <th class="text-center">Meta Description</th> --}}
                                <th class="text-center">Status</th>
                                <th class="text-center">Last Update</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blogs as $index => $blog)
                                <tr>
                                    <td class="text-center">
                                        {{$index + 1}}
                                    </td>
                                    <td>
                                        <a
                                            class="d-flex align-items-center">
                                            @if (!empty($blog->blog_main_image))
                                                <img src="{{ asset('storage/' . $blog->blog_main_image) }}"
                                                    class="user-img me-2" alt="Category Image">
                                            @else
                                                <img src="{{ asset('admin/images/logo-icon.png') }}" class="user-img"
                                                    alt="Default Image me-2">
                                            @endif
                                            <div class="user-info">
                                                <p class="user-name mb-0">{{$blog->blog_name}}</p>
                                                <!-- <p class="designattion mb-0">Web Designer</p> -->
                                            </div>
                                        </a>
                                    </td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($blog->blog_date)->format('d-m-Y') }}</td>
                                    <td class="text-center">{{$blog->blog_location}}</td>
                                    {{-- <td class="text-center">Blog Description</td>
                                    <td class="text-center">meta keyword</td>
                                    <td class="text-center">meta title</td>
                                    <td class="text-center">meta description</td> --}}
                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-{{ $blog->status == 'Active' ? 'success' : 'danger' }} btn-sm radius-30 px-4">
                                            {{ $blog->status }}
                                        </button>

                                    </td>
                                    <td class="text-center">{{ $blog->updated_at->format('d-m-Y h:i A') }}</td>
                                    <td class="text-center order-actions">
                                        <a href="{{ route('admin.blog.edit', $blog->id) }}" class=""><i class='bx bxs-edit'></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No data found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

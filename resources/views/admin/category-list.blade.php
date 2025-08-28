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
                        <li class="breadcrumb-item active" aria-current="page">Product Category</li>
                    </ol>
                </nav>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Product Category List</h5>
                    <a href="{{ url('/admin/add-category') }}" class="btn btn-primary mb-3 mb-lg-0">Add New Category</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Menu Show</th>
                                <th class="text-center">Home Show</th>
                                <th>Category Name</th>
                                {{-- <th class="text-center">Short Description</th>
                                <th class="text-center">Breadcrumb Name</th> --}}
                                {{-- <th class="text-center">Breadcrumb Description</th>
                                <th class="text-center">Meta Keyword</th>
                                <th class="text-center">Meta Title</th>
                                <th class="text-center">Meta Description</th> --}}
                                <th class="text-center">Status</th>
                                <th class="text-center">Last Update</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $category)
                                <tr>
                                    <td class="text-center">
                                        {{ $key + 1 }}
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input toggle-menu"
                                            data-id="{{ $category->id }}" {{ $category->is_menu ? 'checked' : '' }}>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input toggle-home"
                                            data-id="{{ $category->id }}" {{ $category->is_home ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <a
                                            class="d-flex align-items-center">
                                            @if (!empty($category->category_image))
                                                <img src="{{ asset('storage/' . $category->category_image) }}"
                                                    class="user-img me-2" alt="Category Image">
                                            @else
                                                <img src="{{ asset('admin/images/logo-icon.png') }}" class="user-img"
                                                    alt="Default Image me-2">
                                            @endif
                                            <div class="user-info">
                                                <p class="user-name mb-0">{{ $category->category_name }}</p>
                                                <!-- <p class="designattion mb-0">Web Designer</p> -->
                                            </div>
                                        </a>
                                    </td>
                                    {{-- <td class="text-center">{{ $category->short_description }}</td>
                                    <td>
                                        <a
                                            class="d-flex align-items-center">
                                            @if (!empty($category->breadcrumb_image))
                                                <img src="{{ asset('storage/' . $category->breadcrumb_image) }}"
                                                    class="user-img me-2" alt="breadcrumb Image">
                                            @else
                                                <img src="{{ asset('admin/images/logo-icon.png') }}" class="user-img"
                                                    alt="Default Image me-2">
                                            @endif
                                            <div class="user-info">
                                                <p class="user-name mb-0">{{ $category->breadcrumb_name }}</p>
                                                <!-- <p class="designattion mb-0">Web Designer</p> -->
                                            </div>
                                        </a>
                                    </td> --}}
                                    {{-- <td class="text-center">{{ $category->breadcrumb_description }}</td> --}}
                                    {{-- <td class="text-center">{{ $category->meta_keyword }}</td>
                                    <td class="text-center">{{ $category->meta_title }}</td>
                                    <td class="text-center">{{ $category->meta_description }}</td> --}}
                                    <td class="text-center">
                                        @if ($category->status == 'Active')
                                            <button type="button"
                                                class="btn btn-success btn-sm radius-30 px-4">Active</button>
                                        @else
                                            <button type="button"
                                                class="btn btn-danger btn-sm radius-30 px-4">Inactive</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($category->updated_at)->format('d-m-Y h:i A') }}</td>
                                    <td class="text-center order-actions">
                                        <a href="{{ route('admin.category-edit', $category->id) }}" class=""><i
                                                class='bx bxs-edit'></i></a>
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
 <script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "2000"
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function confirmAndToggle($checkbox, dataField) {
            let id = $checkbox.data('id');
            let checked = $checkbox.is(':checked') ? 1 : 0;

            Swal.fire({
                title: "Are you sure?",
                text: "You want to change this status!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, update it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX request
                    let postData = { id: id };
                    postData[dataField] = checked;

                    $.post("{{ route('admin.category.toggleCheckbox') }}", postData, function(response) {
                        toastr.success(response.message);
                    });
                } else {
                    // Revert checkbox state
                    $checkbox.prop('checked', !checked);
                }
            });
        }

        $('.toggle-menu').on('change', function() {
            confirmAndToggle($(this), 'is_menu');
        });

        $('.toggle-home').on('change', function() {
            confirmAndToggle($(this), 'is_home');
        });
    });
</script>



@endsection

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>MedTech - Website Admin Panel</title>
	<!--favicon-->
	<link rel="icon" href={{asset('admin/images/logo-icon.png')}} type="image/png">
	<!--plugins-->
	<!--<link href={{asset('admin/plugins/vectormap/jquery-jvectormap-2.0.2.css')}} rel="stylesheet">-->
	<link href={{asset('admin/plugins/simplebar/css/simplebar.css')}} rel="stylesheet">
	<link href={{asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}} rel="stylesheet">
	<link href={{asset('admin/plugins/metismenu/css/metisMenu.min.css')}} rel="stylesheet">
	<link href={{asset('admin/plugins/datatable/css/dataTables.bootstrap5.min.css')}} rel="stylesheet" />
	<!-- loader-->
	<link href={{asset('admin/css/pace.min.css')}} rel="stylesheet">
	<script src={{asset('admin/js/pace.min.js')}}></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href={{asset('admin/css/bootstrap.min.css')}} rel="stylesheet">
	<link href={{asset('admin/css/bootstrap-extended.css')}} rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href={{asset('admin/css/app.css')}} rel="stylesheet">
	<link href={{asset('admin/css/icons.css')}} rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<a href="{{ url('/admin/dashboard') }}" class="d-flex align-items-center">
					<img src="{{ $user->company_logo ? asset('storage/' . $user->company_logo) : asset('assets/img/logos/logo.png') }}" class="logo-icon" alt="logo icon" alt="MedTech">
					<h4 class="logo-text">MedTech</h4>
				</a>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{ url('/admin/dashboard') }}">
						<div class="parent-icon"><i class='bx bx-home-alt'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Product Category</div>
					</a>
					<ul>
						<li> <a href="{{ url('/admin/category-list') }}"><i class='bx bx-radio-circle'></i>Category
								List</a>
						</li>
						<li> <a href="{{ url('/admin/add-category') }}"><i class='bx bx-radio-circle'></i>Add
								Category</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Product</div>
					</a>
					<ul>
						<li> <a href="{{ url('/admin/product-list') }}"><i class='bx bx-radio-circle'></i>Product
								List</a>
						</li>
						<li> <a href="{{ url('/admin/add-product') }}"><i class='bx bx-radio-circle'></i>Add Product</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Blogs</div>
					</a>
					<ul>
						<li> <a href="{{ url('/admin/blog-list') }}"><i class='bx bx-radio-circle'></i>Blog
								List</a>
						</li>
						<li> <a href="{{ url('/admin/add-blog') }}"><i class='bx bx-radio-circle'></i>Add Blog</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-file'></i>
						</div>
						<div class="menu-title">Certificates</div>
					</a>
					<ul>
						<li> <a href="{{ url('/admin/certificate-list') }}"><i class='bx bx-radio-circle'></i>Certificate
								List</a>
						</li>
						<li> <a href="{{ url('/admin/add-certificate') }}"><i class='bx bx-radio-circle'></i>Add Certificate</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-calendar'></i>
						</div>
						<div class="menu-title">Exhibition</div>
					</a>
					<ul>
						<li> <a href="{{ url('/admin/exhibition-list') }}"><i class='bx bx-radio-circle'></i>Exhibition	List</a>
						</li>
						<li> <a href="{{ url('/admin/add-exhibition') }}"><i class='bx bx-radio-circle'></i> Add Exhibition</a>
						</li>
            {{-- <li> <a href="{{ url('/admin/book-appointments') }}"><i class='bx bx-radio-circle'></i> Exhibition Appointments</a>
						</li> --}}
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Home Banner</div>
					</a>
					<ul>
						<li> <a href="{{ url('/admin/banner-list') }}"><i class='bx bx-radio-circle'></i>Home Banner List</a>
						</li>
						<li> <a href="{{ url('/admin/home-banner') }}"><i class='bx bx-radio-circle'></i> Add Home Banner</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{ url('/admin/add-brochures') }}">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Brochures</div>
					</a>
					<!--<ul>-->
					<!--	<li> <a href="{{ url('/admin/brouchers-list') }}"><i class='bx bx-radio-circle'></i>Brouchers List</a>-->
					<!--	</li>-->
					<!--	<li> <a href=""><i class='bx bx-radio-circle'></i> Add Broucher</a>-->
					<!--	</li>-->
					<!--</ul>-->
				</li>
				<li>
					<a href="{{ url('/admin/about-us') }}">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">About Us</div>
					</a>
				</li>
				<li>
					<a href="{{ url('/admin/request-quote') }}">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">Requested Quotes</div>
					</a>
				</li>
				<li>
					<a href="{{ url('/admin/contact') }}">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">Contact US</div>
					</a>
				</li>
				<li>
					<a href="{{ url('/admin/newsletter') }}">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">NewsLetter List</div>
					</a>
				</li>
				<li>
					<a href="{{ url('/admin/meta-tags') }}">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">Meta Tags</div>
					</a>
				</li>
				<!--<li>-->
				<!--	<a href="{{ url('/admin/footer-website') }}">-->
				<!--		<div class="parent-icon"><i class="bx bx-folder"></i>-->
				<!--		</div>-->
				<!--		<div class="menu-title">Footer Website</div>-->
				<!--	</a>-->
				<!--</li>-->
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand gap-3">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>

					<!-- <div class="search-bar d-lg-block d-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
						<a href="avascript:;" class="btn d-flex align-items-center"><i
								class='bx bx-search'></i>Search</a>
					</div> -->

					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center gap-1">
						</ul>
					</div>
					<div class="user-box dropdown px-3">
						<a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
							href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{ $user->company_logo ? asset('storage/' . $user->company_logo) : asset('assets/img/logos/logo.png') }}"  class="user-img" alt="MedTech">
							<div class="user-info">
								<p class="user-name mb-0">{{ Auth::user()->name }}</p>
								<p class="designattion mb-0">Admin</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item d-flex align-items-center" href="{{route('admin.company.profile')}}"><i
										class="bx bx-user fs-5"></i><span>Profile</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li>
								<form id="logout-form" action="{{ route('logout') }}" method="POST">
									@csrf
									<button type="submit" class="dropdown-item d-flex align-items-center">
										<i class="bx bx-log-out-circle"></i><span>Logout</span>
									</button>
								</form>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
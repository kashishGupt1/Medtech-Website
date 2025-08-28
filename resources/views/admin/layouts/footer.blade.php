<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<footer class="page-footer">
	<p class="mb-0">Copyright © 2025. All right reserved.</p>
</footer>
</div>
<!--end wrapper-->


<!-- Bootstrap JS -->
<script src={{asset('admin/js/bootstrap.bundle.min.js')}}></script>
<!--plugins-->
<script src={{asset('admin/js/jquery.min.js')}}></script>
<script src={{asset('admin/plugins/simplebar/js/simplebar.min.js')}}></script>
<script src={{asset('admin/plugins/metismenu/js/metisMenu.min.js')}}></script>
<script src={{asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}></script>
<script src={{asset('admin/plugins/datatable/js/jquery.dataTables.min.js')}}></script>
<script src={{asset('admin/plugins/datatable/js/dataTables.bootstrap5.min.js')}}></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src={{asset('admin/plugins/select2/js/select2-custom.js')}}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(document).ready(function () {
		$('#example').DataTable();
	});
	
	$(document).ready(function () {
		var table = $('#example2').DataTable({
			lengthChange: false,
			buttons: ['copy', 'excel', 'pdf', 'print']
		});

		table.buttons().container()
			.appendTo('#example2_wrapper .col-md-6:eq(0)');
	});
</script>
<!--app JS-->
<script src={{asset('admin/js/app.js')}}></script>
</body>

</html>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="{{asset("assets/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			 style="opacity: .8">
		<span class="brand-text font-weight-light">Admin Page</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->


		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<a class="text-center" href="#">
				<div  class="profile-img">
					<img class="mx-auto img-circle img-thumbnail" style="max-width: 100px;" src="{{asset("images/admins/".Auth::user()->photo)}}">
				</div>
				<h5 style="font-weight: bold">{{Auth::user()->fullname}}</h5>
				@if(Auth::user()->id==1)
					<h6 class="mt-2">Website Owner</h6>
				@else<h6 class="mt-2">Website Administrator</h6>
				@endif
				<p class="text-muted font-size-sm">{{Auth::user()->email}}</p>
				<p class="text-secondary ml-4"><a class="btn btn-info ml-5 mb-2" style="color:whitesmoke;" href="{{route('admin.getprofile')}}">Edit Profile</a></p>
			</a>
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="{{url('admin')}}" class="nav-link {{\Request::is('admin')?'active':''}}">
						<i class="fa fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>

				{{------------------- Sub Categories ----------------------------}}

				<li class="nav-item">
					<a href="{{route('admin.maincategories')}}" class="nav-link {{\Request::is('admin/maincategories*')?'active':''}}">
						<i class="fa fa-list nav-icon"></i>
						<p>Main Categories
							<span class="badge badge-danger right mr-3">{{\App\Models\MainCategory::count()}}</span></p>
					</a>
				</li>

				<li class="nav-item has-treeview {{\Request::is('admin/vendors*')?'menu-open':''}}">
					<a href="#" class="nav-link {{\Request::is('admin/vendors*')?'active':''}}">
						<i class="nav-icon fa fa-store"></i>
						<p>
							Vendors
							<i class="fas fa-angle-left right"></i>
							<span class="badge badge-danger right">{{\App\Models\Vendor::count()}}</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{route('admin.vendors')}}" class="nav-link {{\Request::is('admin/vendors')?'active':''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Accepted Vendors
									<span class="badge badge-danger right">{{\App\Models\Vendor::where('status','<>','-1')->count()}}</span>
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('admin.vendors.pending')}}" class="nav-link {{\Request::is('admin/vendors/pending')?'active':''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Pending Vendors
									<span class="badge badge-danger right">{{\App\Models\Vendor::where('status','-1')->count()}}</span>
								</p>
							</a>
						</li>

					</ul>
				</li>
				<li class="nav-item has-treeview {{\Request::is('admin/cities*')?'menu-open':''}}{{\Request::is('admin/states*')?'menu-open':''}}">
					<a href="#" class="nav-link {{\Request::is('admin/cities*')?'active':''}}{{\Request::is('admin/states*')?'active':''}}">
						<i class="nav-icon fa fa-globe"></i>
						<p>
							Regions control
							<i class="fas fa-angle-left right"></i>
							<span class="badge badge-danger right">{{\App\Models\City::count()+\App\Models\State::count()}}</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{route('admin.cities')}}" class="nav-link {{\Request::is('admin/cities*')?'active':''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Cities
									<span class="badge badge-danger right">{{\App\Models\City::count()}}</span>
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('admin.states')}}" class="nav-link {{\Request::is('admin/states*')?'active':''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>States
									<span class="badge badge-danger right">{{\App\Models\State::count()}}</span>
								</p>
							</a>
						</li>

					</ul>
				</li>

				<li class="nav-item">
					<a href="{{route('admin.users')}}" class="nav-link {{\Request::is('admin/users*')?'active':''}}">
						<i class="fa fa-user nav-icon"></i>
						<p>Users
							<span class="badge badge-danger right mr-3">{{\App\User::count()}}</span></p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{route('admin.orders')}}" class="nav-link {{\Request::is('admin/orders*')?'active':''}}">
						<i class="fa fa-user nav-icon"></i>
						<p>Orders
							<span class="badge badge-danger right mr-3">{{\App\User::count()}}</span></p>
					</a>
				</li>

			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
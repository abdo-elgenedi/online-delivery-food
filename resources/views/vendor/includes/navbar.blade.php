<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="{{asset("assets/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			 style="opacity: .8">
		<span class="brand-text font-weight-light">Vendor Page </span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->


		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<a class="text-center" href="#">
				<div  class="profile-img">
					<img class="mx-auto img-circle img-thumbnail" style="max-width: 100px;" src="{{asset("images/vendors/".Auth::user()->image)}}">
				</div>
				<h5 style="font-weight: bold">{{Auth::user()->name}}</h5>
					<h6 class="mt-2">Vendor</h6>
				<p class="text-muted font-size-sm">{{Auth::user()->email}}</p>
				<p class="text-secondary ml-4"><a class="btn btn-info ml-5 mb-2" style="color:whitesmoke;" href="{{route('vendor.getprofile')}}">Edit Profile</a></p>
			</a>
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="{{route('vendor.index')}}" class="nav-link {{\Request::is('vendor')?'active':''}}">
						<i class="fa fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>

                <li class="nav-item">
                    <a href="{{route('vendor.maincategories')}}" class="nav-link {{\Request::is('vendor/maincategories*')?'active':''}}">
                        <i class="far fa-list-alt nav-icon"></i>
                        <p>Show Main Categories</p>
                    </a>
                </li>

				<li class="nav-item">
					<a href="{{route('vendor.categories')}}" class="nav-link {{\Request::is('vendor/categories*')?'active':''}}">
						<i class="fa fa-list nav-icon"></i>
						<p>Show Your Categories</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{route('vendor.products')}}" class="nav-link {{\Request::is('vendor/products*')?'active':''}}">
						<i class="fa fa-tag nav-icon"></i>
						<p>Show Products</p>
					</a>
				</li>

				<li class="nav-item has-treeview {{\Request::is('vendor/orders*')?'menu-open':''}}">
					<a href="#" class="nav-link {{\Request::is('vendor/orders*')?'active':''}}">
						<i class="nav-icon fas fa-shopping-cart"></i>
						<p>
							Orders
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{route('vendor.orders.current')}}" class="nav-link {{\Request::is('vendor/orders/current')?'active bg-info':''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Current Orders</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('vendor.orders.completed')}}" class="nav-link {{\Request::is('vendor/orders/completed')?'active bg-success':''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Completed Orders</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('vendor.orders.cancelled')}}" class="nav-link {{\Request::is('vendor/orders/cancelled')?'active bg-danger':''}}">
								<i class="far fa-circle nav-icon"></i>
								<p>Cancelled Orders</p>
							</a>
						</li>
					</ul>
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
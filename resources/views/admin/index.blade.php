@extends('layouts.admin')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content pl-5 pr-5 bg-white">
      <div class="container-fluid pl-5 pr-5 pt-2 pb-2 ">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7 m-5">
          <h3 class="text-center">
            <strong>Orders</strong>
          </h3>

          <div class="progress-group">
            Current Orders
            <span class="float-right"><b>{{count($invoices['current'])}}</b>/{{count($invoices['all'])}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-primary" style="width: {{((count($invoices['current']))/(count($invoices['all'])))*100}}%"></div>
            </div>
          </div>
          <!-- /.progress-group -->

          <div class="progress-group">
            Completed Orders
            <span class="float-right"><b>{{count($invoices['completed'])}}</b>/{{count($invoices['all'])}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-success" style="width: {{((count($invoices['completed']))/(count($invoices['all'])))*100}}%"></div>
            </div>
          </div>


          <!-- /.progress-group -->
          <div class="progress-group">
            Cancelled Orders
            <span class="float-right"><b>{{count($invoices['cancelled'])}}</b>/{{count($invoices['all'])}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-danger" style="width: {{((count($invoices['cancelled']))/(count($invoices['all'])))*100}}%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
        </div>
        </div>




         <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7 m-5">
          <h3 class="text-center">
            <strong>Restaurants</strong>
          </h3>

          <div class="progress-group">
            Pending Restaurants
            <span class="float-right"><b>{{count($vendors['pending'])}}</b>/{{count($vendors['all'])}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-primary" style="width: {{((count($vendors['pending']))/(count($vendors['all'])))*100}}%"></div>
            </div>
          </div>
          <!-- /.progress-group -->

          <div class="progress-group">
            Active Restaurants
            <span class="float-right"><b>{{count($vendors['active'])}}</b>/{{count($vendors['all'])}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-success" style="width: {{((count($vendors['active']))/(count($vendors['all'])))*100}}%"></div>
            </div>
          </div>


          <!-- /.progress-group -->
          <div class="progress-group">
            Blocked Restaurants
            <span class="float-right"><b>{{count($vendors['blocked'])}}</b>/{{count($vendors['all'])}}</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-danger" style="width: {{((count($vendors['blocked']))/(count($vendors['all'])))*100}}%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
        </div>
        </div>




        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-7 m-5">
            <h3 class="text-center">
              <strong>Customers</strong>
            </h3>

            <div class="progress-group">
              Active Customers
              <span class="float-right"><b>{{count($users['active'])}}</b>/{{count($users['all'])}}</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" style="width: {{((count($users['active']))/(count($users['all'])))*100}}%"></div>
              </div>
            </div>


            <!-- /.progress-group -->
            <div class="progress-group">
              Blocked Customers
              <span class="float-right"><b>{{count($users['blocked'])}}</b>/{{count($users['all'])}}</span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" style="width: {{((count($users['blocked']))/(count($users['all'])))*100}}%"></div>
              </div>
            </div>
            <!-- /.progress-group -->
          </div>
        </div>



        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-7 m-5">
            <h3 class="text-center">
              <strong>Statisticals</strong>
            </h3>
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <h3 class="info-box-text">Orders</h3>
                <h5 class="info-box-number">({{count($invoices['all'])}}) order</h5>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <h3 class="info-box-text">Products</h3>
                <h5 class="info-box-number">({{count($products)}}) product</h5>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

              <div class="info-box-content">
                <h3 class="info-box-text">Categories</h3>
                <h5 class="info-box-number">({{count($categories)}}) category</h5>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="far fa-comment"></i></span>

              <div class="info-box-content">
                <h3 class="info-box-text">Incomes</h3>
                <h5 class="info-box-number">{{$incomes}} EGP</h5>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <!-- /.card -->
          </div>
        </div>


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

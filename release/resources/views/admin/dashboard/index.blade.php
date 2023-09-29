@extends('admin.layouts.base-layout')
@section('content')
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
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
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$orders->count()}}</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$products->count()}}</h3>

              <p>Total Product</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$users->count()}}</h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$todaysOrder->count()}}</h3>

              <p>Todays Order</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <?php $totalInc = 0; ?>
              @foreach($orders as $or)
              <?php $totalInc = $totalInc + $or->price ; ?>
              @endforeach
              <h3>Rs. {{$totalInc}}</h3>

              <p>Total Income</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <?php $todayInc = 0; ?>
              @foreach($todaysOrder as $or)
              <?php $todayInc = $todayInc + $or->price ; ?>
              @endforeach
              <h3>Rs. {{$todayInc}}</h3>

              <p>Todays Income</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <div class="card col-md-6" style="width:800px;">
          <h3>New User</h3>
          <canvas id="myCharts"></canvas>
        </div>
        <div class="card col-md-6" style="width:800px;">
          <h3>New Orders</h3>
          <canvas id="myChart"></canvas>
        </div>

      </div>
    </div>
    <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>


<script>
        const ctx = document.getElementById('myChart');
        const counts = {!!json_encode($ordersData) !!};

        // group counts by year
        const yearCounts = counts.reduce((acc, count) => {
            if (!acc[count.year]) {
                acc[count.year] = {};
            }
            acc[count.year][count.month] = count.count;
            return acc;
        }, {});

        // create an array of month names
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // convert counts to data arrays
        const labels = [];
        const data = [];

        for (const year in yearCounts) {
            const yearData = [];
            for (let i = 1; i <= 12; i++) {
                const count = yearCounts[year][i] || 0;
                yearData.push(count);
                if (i === 1) {
                    labels.push(year);
                } else {
                    labels.push('');
                }
            }
            data.push(yearData);
        }

        // create chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: data.map((yearData, index) => ({
                    label: Object.keys(yearCounts)[index],
                    data: yearData,
                    borderWidth: 1
                }))
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
  <script>
     const ctxs = document.getElementById('myCharts');
     const countss = {!!json_encode($usersData) !!};

     // group counts by year
     const yearCountss = countss.reduce((acc, count) => {
         if (!acc[count.year]) {
             acc[count.year] = {};
         }
         acc[count.year][count.month] = count.count;
         return acc;
     }, {});

     // create an array of month names
     const monthss = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

     // convert counts to data arrays
     const labelss = [];
     const datas = [];

     for (const year in yearCountss) {
         const yearData = [];
         for (let i = 1; i <= 12; i++) {
             const count = yearCountss[year][i] || 0;
             yearData.push(count);
             if (i === 1) {
                 labelss.push(year);
             } else {
                 labelss.push('');
             }
         }
         datas.push(yearData);
     }

     // create chart
     new Chart(ctxs, {
         type: 'line',
         data: {
             labels: monthss,
             datasets: datas.map((yearData, index) => ({
                 label: Object.keys(yearCountss)[index],
                 data: yearData,
                 borderWidth: 1
             }))
         },
         options: {
             scales: {
                 y: {
                     beginAtZero: true
                 }
             }
         }
     });
 </script>
@endsection
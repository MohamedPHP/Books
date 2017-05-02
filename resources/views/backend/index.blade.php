@extends('backend.layout.admin')

@section('styles')
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/FontAwesome.otf" />
     <link rel="stylesheet" href="{{asset('backend/css/AdminLTE.min.css')}}">
<style>
     span.chip {
    float: right;
}
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
             <section class="content">
               <div class="row">
                 <div class="col s3">
                     <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                           <span class="info-box-text">Users</span>
                           <span class="info-box-number">{{ $usersCount }}</span>

                           <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                           </div>
                           <a href="{{ route('user.index') }}" style="color: #FFF;" class="progress-description">
                              Show All Users
                           </a>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                 </div>
                 <!-- /.col -->
                 <div class="col s3">
                     <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="fa fa-home"></i></span>

                        <div class="info-box-content">
                           <span class="info-box-text">Staff</span>
                           <span class="info-box-number">{{ $staffCount }}</span>

                           <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                           </div>
                           <a href="{{ route('staff.preview') }}" style="color: #FFF;" class="progress-description">
                              Show All Staff
                           </a>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                 </div>
                 <!-- /.col -->
                 <div class="col s3">
                     <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-building"></i></span>

                        <div class="info-box-content">
                           <span class="info-box-text">Books</span>
                           <span class="info-box-number">{{ $bookCount }}</span>

                           <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                           </div>
                           <a href="{{ route('book.index') }}" style="color: #FFF;" class="progress-description">
                              Show All Books
                           </a>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                 </div>
                 <!-- /.col -->
                 <div class="col s3">
                     <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>

                        <div class="info-box-content">
                           <span class="info-box-text">Delete Requests</span>
                           <span class="info-box-number">{{ $bookDeleteRequestCount }}</span>

                           <div class="progress">
                              <div class="progress-bar" style="width: 100%"></div>
                           </div>
                           <a href="{{ route('book.index.table.delete') }}" style="color: #FFF;" class="progress-description">
                              Show All Requests
                           </a>
                        </div>
                        <!-- /.info-box-content -->
                     </div>
                     <!-- /.info-box -->
                 </div>
                 <!-- /.col -->
               </div>
               <!-- /.row -->

               <!-- start the chart -->
               <div class="row">
                 <div class="col s12">
                     <div class="box box-info">
                        <div class="box-header with-border">
                           <h3 class="box-title">Yearly Books Report In Current Year</h3>


                           <div class="box-tools pull-right">
                              <span class="chip info" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                           </span>
                           </div>
                        </div>
                        <!-- /.box-header -->


                        <div class="box-body">
                           <div class="row">
                              <div class="col s12">
                                <p class="text-center"><strong>Chart Explain The Added Books Per Year</strong>
                                </p>
                                <div class="chart">
                                   <!-- Sales Chart Canvas -->
                                   <canvas id="salesChart" style="height: 180px; width: 1069px;" height="180" width="1069">
                                   </canvas>
                                   <!-- <canvas id="myChart" width="600" height="180"></canvas> -->
                                </div>
                                <!-- /.chart-responsive -->
                              </div>
                              <!-- /.col -->
                           </div>
                           <!-- /.row -->
                        </div>
                        <!-- ./box-body -->

                     </div>
                     <!-- /.box -->
                 </div>
                 <!-- /.col -->
               </div>

               <!-- end the chart -->

               <div class="row">
                 <div class="col s6">
                     <!-- PRODUCT LIST -->
                     <div class="box box-success">
                        <div class="box-header with-border">
                           <h3 class="box-title">Recently Added 5 Books</h3>


                           <div class="box-tools pull-right">
                              <span class="chip success" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                           </span>
                           </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <ul class="products-list product-list-in-box">
                              @foreach ($books as $book)
                                <li class="item">
                                   <div class="product-img">
                                       <img alt="{{ $book->title }}" src="{{ asset($book->image) }}">
                                   </div>

                                   <div class="product-info">
                                       <a class="product-title" href="{{ route('books.single', ['id' => $book->id]) }}">
                                          {{ $book->title }}
                                             <span class="chip success" style="margin-right: 5px;">
                                                 version: {{ $book->version }}
                                             </span>
                                             <span class="chip primary" style="margin-right: 5px;">
                                                 {{ $book->specialization->name }}
                                             </span>
                                       </a>
                                       <span class="product-description">{{ $book->description }}</span>
                                   </div>
                                </li>
                                <!-- /.item -->
                              @endforeach

                           </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                           <a class="uppercase" href="{{ route('book.index') }}">View All Books</a>
                        </div>
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                 </div>
                 <!-- /.col -->
                 <div class="col s6">
                     <!-- PRODUCT LIST -->
                     <div class="box box-danger">
                        <div class="box-header with-border">
                           <h3 class="box-title">Recently 5 Delete Requests</h3>


                           <div class="box-tools pull-right">
                                <span class="chip danger" data-widget="collapse">
                                     <i class="fa fa-minus"></i>
                                </span>
                           </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <ul class="products-list product-list-in-box">
                                @foreach ($booksDeleteReueste as $book)
                                     <li class="item">
                                        <div class="product-img">
                                            <img alt="{{ $book->title }}" src="{{ asset($book->image) }}">
                                        </div>

                                        <div class="product-info">
                                            <a class="product-title" href="{{ route('books.single', ['id' => $book->id]) }}">
                                               {{ $book->title }}
                                                  <span class="chip danger" style="margin-right: 5px;">
                                                      version: {{ $book->version }}
                                                  </span>
                                                  <span class="chip warning" style="margin-right: 5px;">
                                                      {{ $book->specialization->name }}
                                                  </span>
                                            </a>
                                            <span class="product-description">{{ $book->description }}</span>
                                        </div>
                                     </li>
                                     <!-- /.item -->
                                @endforeach
                           </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                           <a class="uppercase" href="{{ route('book.index.table.delete') }}">View All Deleted Request</a>
                        </div>
                        <!-- /.box-footer -->
                     </div>
                     <!-- /.box -->
                 </div>
                 <!-- /.col -->
               </div>
               <!-- /.row -->
           </section>
        </div>
    </div>


@endsection



@section('scripts')
     <script src="{{asset('backend/js/Chart.min.js')}}"></script>
     <script src="{{asset('backend/js/app.min.js')}}"></script>
     <script type="text/javascript">
      /* ChartJS
      * -------
      * Here we will create a few charts using ChartJS
      */

      // Get context with jQuery - using jQuery's .get() method.
      var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var salesChart = new Chart(salesChartCanvas);

      var salesChartData = {
        labels: ["January", "February", "March", "April", "May", "June",
               "July", "August","September", "October", "November", "December"],
        datasets: [
           {
             label: "Books",
             fillColor: "rgba(60,141,188,0.9)",
             strokeColor: "rgba(60,141,188,0.8)",
             pointColor: "#3b8bba",
             pointStrokeColor: "rgba(60,141,188,1)",
             pointHighlightFill: "#fff",
             pointHighlightStroke: "rgba(60,141,188,1)",
             data: [

                  @foreach ($chartData as $chart)
                       @if (is_array($chart))
                         {{ $chart['counting'] }},
                       @else
                         {{ $chart }},
                       @endif
                  @endforeach
             ]
           }
        ]
     };

     var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
     };

     //Create the line chart
     salesChart.Line(salesChartData, areaChartOptions);

    </script>
@endsection

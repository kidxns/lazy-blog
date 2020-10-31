@extends('admin.index')
@section('content')

<div class="row">
    <div class="col-3">
        <x-total-card title='Total: Posts' message="{{ count($posts)}}" theme='primary' icon='rss' />
    </div>
    <div class="col-3">
        <x-total-card title='Total: Comments' message="{{ count($comments)}}" theme='success' icon='comments' />
    </div>
    <div class="col-3">
        <x-total-card title='Total: Categories' message="{{ count($categories)}}" theme='info' icon='clipboard-list' />
    </div>
    <div class="col-3">
        <x-total-card title='Total: Media' message="{{ count($media)}}" theme='warning' icon='photo-video' />
    </div>
</div>

<div class="row mt-5">
    <div class="col-6 mt-4">
        <div class="card shadow">
            <div class="card-body">
                <canvas id="myChart" height="100px"></canvas>
            </div>
        </div>
     </div>

    <div class="col-6 mt-4">
        @include('admin.dashboard._categories')
    </div>
</div>

<div class="row justify-content-end">


</div>




</body>
<script src="vendor/chart.js/Chart.min.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar'
        , data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange']
            , datasets: [{
                label: '# of Votes'
                , data: [12, 19, 3, 5, 2, 3]
                , backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                    , 'rgba(54, 162, 235, 0.2)'
                    , 'rgba(255, 206, 86, 0.2)'
                    , 'rgba(75, 192, 192, 0.2)'
                    , 'rgba(153, 102, 255, 0.2)'
                    , 'rgba(255, 159, 64, 0.2)'
                ]
                , borderColor: [
                    'rgba(255, 99, 132, 1)'
                    , 'rgba(54, 162, 235, 1)'
                    , 'rgba(255, 206, 86, 1)'
                    , 'rgba(75, 192, 192, 1)'
                    , 'rgba(153, 102, 255, 1)'
                    , 'rgba(255, 159, 64, 1)'
                ]
                , borderWidth: 1
            }]
        }
        , options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

</script>

@endsection

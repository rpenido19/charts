@extends('layouts.default')

@section('content')
    <div class="row p-3 d-flex justify-content-center">
        <div class="card col-12 col-md-8">
            <div class="card-header">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                    </svg> Filtros
                </button>
            <div class="collapse" id="collapseFilter">
                <form class="mt-3">
                    <div class="form-group">
                        <label>Nome</label>
                        <select class="custom-select" id="name">
                            <option value="" selected>Selecione</option>
                            @foreach(\App\Fundo::select(['id', 'name'])->get() as $i)
                            <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" id="dth_inical">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label>Data Final</label>
                                <input type="date" class="form-control" id="dth_final">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label>Valor Mínmo</label>
                                <input type="number" step="2" class="form-control" id="min_value" placeholder="R$ 00,00">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label>Valor Máximo</label>
                                <input type="number" step="2" class="form-control" id="max_value" placeholder="R$ 00,00">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" id="btn-search" class="btn btn-primary mb-2">Buscar</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div id="chart"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- APEXCHARTS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> 
<script>
$(document).ready(function () {
  charts();
});

$('#btn-search').click(function (e) {
  e.preventDefault();
  alert('Test');
});

function charts() {
  var options = {
    series: [
      {
        name: "High - 2013",
        data: [28, 29, 33, 36, 32, 32, 33]
      },
      {
        name: "Low - 2013",
        data: [12, 11, 14, 18, 17, 13, 13]
      }
    ],
    chart: {
      height: 350,
      type: 'line',
      dropShadow: {
        enabled: true,
        color: '#000',
        top: 18,
        left: 7,
        blur: 10,
        opacity: 0.2
      },
      toolbar: {
        show: false
      }
    },
    colors: ['#77B6EA', '#545454'],
    dataLabels: {
      enabled: true,
    },
    stroke: {
      curve: 'smooth'
    },
    title: {
      text: 'Average High & Low Temperature',
      align: 'left'
    },
    grid: {
      borderColor: '#e7e7e7',
      row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
      },
    },
    markers: {
      size: 1
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
      title: {
        text: 'Month'
      }
    },
    yaxis: {
      title: {
        text: 'Temperature'
      },
      min: 5,
      max: 40
    },
    legend: {
      position: 'top',
      horizontalAlign: 'right',
      floating: true,
      offsetY: -25,
      offsetX: -5
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
}
</script>
@endsection
@extends('layouts.default')

@section('styles')
@endsection

@section('content')
<div class="row p-3 d-flex justify-content-center">
    <div class="card col-12 col-md-8 shadow">
        <div id="alert"></div>
        <div class="card-header bg-white">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                </svg> Filtros
            </button>
            <div class="collapse" id="collapseFilter">
                <div class="form-group mt-3">
                    <label for="id">Nome</label>
                    <select multiple class="custom-select" id="id" name="id[]">
                        @foreach(\App\Fundo::select(['id', 'name'])->get() as $i)
                        <option value="{{$i->id}}">{{$i->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="dth_inical">Data Inicial</label>
                            <input type="date" class="form-control" id="dth_inical" name="dth_inical">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="dth_final">Data Final</label>
                            <input type="date" class="form-control" id="dth_final" name="dth_final">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="min_value">Valor Mínmo</label>
                            <input type="number" step="2" class="form-control" id="min_value" name="min_value" placeholder="R$ 00,00">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="max_value">Valor Máximo</label>
                            <input type="number" step="2" class="form-control" id="max_value" name="max_value" placeholder="R$ 00,00">
                        </div>
                    </div>
                </div>
                <hr>
                    <button id="btn-search" class="btn btn-primary mb-2" onclick="preencheGrafico()">Buscar</button>
            </div>
        </div>
        <div class="card-body">
            <div id="chart"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!--APEXCHARTS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
$(document).ready(function () {
  preencheGrafico();
});

function preencheGrafico() {
  $('#collapseFilter').collapse('hide');
  var aux;
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: "{{route('get_data')}}",
    data: {
      id: $('#id').val(),
      dth_inical: $('#dth_inical').val(),
      dth_final: $('#dth_final').val(),
      min_value: $('#min_value').val(),
      max_value: $('#max_value').val()
    },
    dataType: 'JSON',
    success: function (result) {
      charts(result);
    },
    error: function () {
      var alert = `<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                              <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                              <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                          </svg> Ocorreu um erro!
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>`;
      $('#alert').html(alert);
    }
  });
};

function charts(ajax) {
  var series = [];
  $(ajax).each(function (i) {
    series[i] = {
      name: ajax[i].name,
      data: ajax[i].data.split(",")
    };
  });
  var options = {
    series: series,
    chart: {
      height: 350,
      type: 'line',
      zoom: {
        enabled: false
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'straight'
    },
    title: {
      text: 'Fundos dos patrimônios',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'],
        opacity: 0.5
      },
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return "R$ " + value;
        }
      },
    },
    xaxis: {
      type: 'category',
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
}
</script>
@endsection

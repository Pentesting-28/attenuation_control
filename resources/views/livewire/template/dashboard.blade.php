<main>
	<div class="container-fluid px-4 mt-4">
	    {{-- <h1 class="">Dashboard</h1> --}}
	    {{-- <ol class="breadcrumb mb-4">
	        <li class="breadcrumb-item active">Dashboard</li>
	    </ol> --}}

	    <div class="row">
	        <div class="col-xl-3 col-md-6">
				
	            <div class="card bg-primary text-white mb-4">
	                <div class="card-body text text-center">
						{{--  <span class="text-c-blue f-w-600 pt-5">Total de alumnos registrados</span>  --}}
						<h6 class=""><i class="fas fa-users"></i> Alumnos: <b>{{$this->card_count["students"]}}</b> </h6>
					</div> 
	                <!-- <div class="card-footer d-flex align-items-center justify-content-between">
	                    <a class="small text-white stretched-link" href="#">View Details</a>
	                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
	                </div> -->
	            </div>
	        </div>
	        <div class="col-xl-3 col-md-6">
	            <div class="card bg-secondary text-white mb-4">
					<div class="card-body text text-center">
						<h6><i class="fas fa-clipboard-list"></i> Asistencias: <b>{{$this->card_count["attendaces"]}}</b></h6>
					</div>
	                <!-- <div class="card-footer d-flex align-items-center justify-content-between">
	                    <a class="small text-white stretched-link" href="#">View Details</a>
	                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
	                </div> -->
	            </div>
	        </div>
	        <div class="col-xl-4 col-md-6">
	            <div class="card bg-success text-white mb-4">
					<div class="card-body text text-center">
						<h6><i class="fas fa-clipboard-list"></i> Inasistencias Justificadas: <b>{{$this->card_count["absence_justifications"]}}</b></h6>
					</div>
	                <!-- <div class="card-footer d-flex align-items-center justify-content-between">
	                    <a class="small text-white stretched-link" href="#">View Details</a>
	                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
	                </div> -->
	            </div>
	        </div>
	        <div class="col-xl-2 col-md-6">
	            <div class="card bg-danger text-white mb-4">
					<div class="card-body text text-center">
						<h6><i class="fas fa-money-check-alt"></i> Pagos: <b>{{$this->card_count["students_payments"]}}</b></h6>
					</div>
	                <!-- <div class="card-footer d-flex align-items-center justify-content-between">
	                    <a class="small text-white stretched-link" href="#">View Details</a>
	                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
	                </div> -->
	            </div>
	        </div>
	    </div><br>
		<div class="row">
			<div class="col-xl-6">
				<div class="card mb-4">
					<div class="card-header">
						<i class="fas fa-chart-pie mr-1"></i>
						Asistencia diaria
					</div>
					<div class="card-body"><canvas id="myDonutChart" width="100%" height="60"></canvas></div>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="card mb-4">
					<div class="card-header">
						<i class="fas fa-chart-bar mr-1"></i>
						Asistencia Mensual
					</div>
					<div class="card-body"><canvas id="myBarCharts" width="100%" height="60"></canvas></div>
				</div>
			</div>
		</div>
	    {{--<div class="row">
	        <div class="col-xl-6">
	            <div class="card mb-4">
	                <div class="card-header">
	                    <i class="fas fa-chart-area me-1"></i>
	                    Area Chart Example
	                </div>
	                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
	            </div>
	        </div>
	        <div class="col-xl-6">
	            <div class="card mb-4">
	                <div class="card-header">
	                    <i class="fas fa-chart-bar me-1"></i>
	                    Bar Chart Example
	                </div>
	                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
	            </div>
	        </div>
	    </div>--}}
	</div>
</main>

<script type="text/javascript">
// Doughnut Chart GRAFICOS DE REPORTES
const daily_assistance = @json($daily_assistance);
console.log(daily_assistance);
const ctx_donut = document.getElementById("myDonutChart");
const myDonutChart = new Chart(ctx_donut, {
  type: 'doughnut',
  data: {
    labels: daily_assistance.map((index) => index.name),
    datasets: [{
      label: "Revenue",
      backgroundColor: [
        '#4dc9f6',
        '#f67019',
        '#f53794',
        '#537bc4',
        '#acc236',
        '#166a8f',
        '#00a950',
        '#58595b',
        '#8549ba'
    ],
      data: daily_assistance.map((index) => index.count),
    }],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Doughnut Chart',
      },
    },
  },
});

// Bar Chart GRAFICOS DE ENCUESTAS
const monthly_assistance = @json($monthly_assistance);
{{--  console.log( Math.max.apply(null,monthly_assistance.map((index) =>index.count)));  --}}
const ctx_bar = document.getElementById("myBarCharts");
const myLineChart = new Chart(ctx_bar, {
  type: 'bar',
  data: {
    labels:  monthly_assistance.map((index) => index.name),
    datasets: [{
      label: "Revenue",
      backgroundColor: [
        'rgba(255, 4, 0, 255)',
        'rgba(255, 38, 0, 255)',
        'rgba(255, 98, 0, 255)',
        'rgba(255, 157, 0, 255)',
        'rgba(255, 217, 0, 255)',
        'rgba(234, 255, 0, 255)',
        'rgba(179, 255, 0, 255)',
        'rgba(123, 255, 0, 255)',
        'rgba(64, 255, 0, 255)',
        'rgba(4, 255, 0, 255)',
        'rgba(0, 255, 55, 255)',
        'rgba(0, 255, 115, 255)'
      ],
      data: monthly_assistance.map((index) => index.count),
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        stacked: true,
        ticks: {
          min: 0,
          max: Math.max.apply(
			   null,
			   monthly_assistance.map((index) => index.count)
			  ),
          maxTicksLimit: 12,
          stepSize: 1,
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
</script>

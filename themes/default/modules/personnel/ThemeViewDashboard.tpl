<!-- BEGIN: main -->
<div class="row">
	<div class="col-md-2">
		<div class="info-box bg-info ">
		  <div class="info-box-content height70"> 
			<div class="count"> 20 </div>
			<span class="progress-description">
			  MỚI VÀO TRONG THÁNG
			</span>
		  </div>
		</div>
		<div class="info-box bg-info marginTop10">
		  <div class="info-box-content height70"> 
			<div class="count"> 20 </div>
			<span class="progress-description">
			  NGHỈ VIỆC TRONG THÁNG
			</span>
		  </div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="info-box bg-info">
			<div class="info-box-content height190"> 
				<i class="fas fa-users"></i>
				<div class="count"> 90 </div>
				<span class="progress-description">
					ĐANG LÀM VIỆC
				</span>
			</div>	
		</div>	 
	</div>
	<div class="col-md-2">
		<div class="info-box bg-info ">
		  <div class="info-box-content height70"> 
			<div class="count"> 20 </div>
			<span class="progress-description">
			 ĐÃ TUYỂN THÀNH CÔNG
			</span>
		  </div>
		</div>
		<div class="info-box bg-info marginTop10">
		  <div class="info-box-content height70"> 
			<div class="count"> 20 </div>
			<span class="progress-description">
			  SỐ ỨNG VIÊN CẦN TUYỂN<br>TRONG THÁNG
			</span>
		  </div>
		</div>
	</div>
	
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title">Thống kê nhân sự theo độ tuổi</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartYearOld" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title">Loại hợp đồng</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<div class="col-md-6">
		<!-- BAR CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title" style="font-size:16px">Tổng lương chi 12 tháng gần nhất</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title" style="font-size:16px">Biến động nhân sự 3 tháng gần nhất</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title"  style="font-size:16px">Lượng tuyển dụng theo vị trí</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title" style="font-size:16px">Sinh nhật trong tháng</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title" style="font-size:16px">Hợp đồng sắp hết hạn</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title" style="font-size:16px">Hợp đồng cần gia hạn</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<div class="col-md-3">
		<!-- PIE CHART -->
		<div class="card cardutline">
		  <div class="card-header">
			<h3 class="card-title" style="font-size:16px">Danh sách lịch phỏng vấn sắp tới</h3>
		  </div>
		  <div class="card-body padding10">
			<canvas id="pieChartContract" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	
</div>
<!-- ChartJS -->
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/chart.js/Chart.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/chart.js/chartjs-plugin-datalabels.min.js"></script>

<script type="text/javascript">
$(function () {
	/* THONG KE THEO DO TUOI LAO DONG */
	var data = [{
		data: [30, 30, 30, 10],
		labels: ['20-30', '30-40', '40-50', '50-60'],
		backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
		borderColor: "#fff"
	}];
        
	var options = {
		maintainAspectRatio : false,
		responsive : true,
		tooltips: {
			enabled: false
		},
		plugins: {
			datalabels: {
				formatter: (value, ctx) => {
					let sum = ctx.dataset._meta[0].total;
					let percentage = (value * 100 / sum).toFixed(1) + "%";
					return percentage;
					 
				},
				color: '#fff',
			}
        }
    };
    var pieChartCanvasYearOld = $('#pieChartYearOld').get(0).getContext('2d')
    var pieChartYearOld = new Chart(pieChartCanvasYearOld, {
		type: 'doughnut',
		data: {
			datasets: data
		},
		options: options
    })
	
	
	/* THONG KE THEO LOAI HOP DONG */
	var data2 = [{
		data: [40, 20, 30, 10],
		labels: ['20-30', '30-40', '40-50', '50-60'],
		backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
		borderColor: "#fff"
	}];
        
	var options2 = {
		maintainAspectRatio : false,
		responsive : true,
		tooltips: {
			enabled: false
		},
		plugins: {
			datalabels: {
				formatter: (value, ctx) => {
					let sum = ctx.dataset._meta[1].total;
					let percentage = (value * 100 / sum).toFixed(1) + "%";
					return percentage;
					 
				},
				color: '#fff',
			}
        }
    };
    var pieChartCanvasContract = $('#pieChartContract').get(0).getContext('2d')
    var pieChartContract = new Chart(pieChartCanvasContract, {
		type: 'pie',
		data: {
			datasets: data2
		},
		options: options2
    })
  
})
</script>
<!-- END: main -->

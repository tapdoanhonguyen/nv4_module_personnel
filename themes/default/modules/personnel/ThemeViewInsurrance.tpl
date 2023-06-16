<!-- BEGIN: main -->
<div class="row">
	<div class="col-12">
		<div id="ListInsurrance" class="card">
			<div class="card-header">
				<h3 class="float-left card-title d62f2f">Danh sách tham gia bảo hiểm tháng <span id="searchmonth">{DAY}</span></h3>
				<div class="float-right toolaction">
					<a href="#" style="position:relative" ><input value="" type="text" class="datepickermonth" /><span>Thời gian</span></a>
					<a href="#" data-toggle="tooltip" title="Export nhân sự Excel" onclick="ExportContent()"><i class="fas fa-file-export"> </i><span>Xuất</span></a>
					<a href="#" data-toggle="tooltip" title="Cài đặt"><i class="fas fa-cog"> </i><span>Cài đặt</span></a>
				</div>
			</div>
			<div class="card-body">
				<table id="Insurrance" class="table table-head-fixed text-nowrap">
				  <thead>
					  <tr>
						<th class="text-center" style="width:30px">
							<div class="icheck-danger"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" class="all" id="check_all{TAB.key}"><label for="check_all{TAB.key}"></label></div>
						</th>
						<th>Mã NV</th>
						<th>Họ và tên</th>
						<th>Phòng ban</th>
						<th>Vị trí</th>
						<th>Chức vụ</th>
						<th>Số sổ</th>
						<th>Số thẻ</th>			
						<th class="text-center">Bắt đầu đóng</th>
						<th class="text-right align-middle">Mức đóng</th>
					  </tr>
				  </thead>
				 
				</table>
			</div>
		</div>
	</div>
</div>


  


<script src="{JSONFILE}"></script>

<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css">


<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js"></script>
 
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script> 
 
<link type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/jquery-month-picker/MonthPicker.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/jquery-month-picker/MonthPicker.js"></script>
  
<script type="text/javascript">

function updatePostOrder() {
    var arr = [];
    $("#sortable2 li").each(function () {
        arr.push($(this).attr('data'));
    });
    $('#exportlist').val(arr.join(','));
}
 


function ExportContent()
{
	
	$.ajax({
		url: nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '='+ nv_func_name +'&action=getFormExport&second=' + new Date().getTime(),
		data: {},
		dataType: 'json',
		beforeSend: function ( d ) {
			$('#myModal').remove();
		},
		complete: function ( d ) {
			
		},
		success: function(json) {
			if( json['template'] )
			{
 
				$('body').append(json['template']);
				$('#myModal').modal('show');
	
				$('#myModal').on('shown.bs.modal', function (event) {
				
					$('.droptrue').on('click', 'li', function () {
						$(this).toggleClass('selected');
					});

					$("ul.droptrue").sortable({
						connectWith: 'ul.droptrue',
						opacity: 0.6,
						revert: true,
						helper: function (e, item) {
							console.log('parent-helper');
							console.log(item);
							if(!item.hasClass('selected'))
							   item.addClass('selected');
							var elements = $('.selected').not('.ui-sortable-placeholder').clone();
							var helper = $('<ul/>');
							item.siblings('.selected').addClass('hidden');
							return helper.append(elements);
						},
						start: function (e, ui) {
							var elements = ui.item.siblings('.selected.hidden').not('.ui-sortable-placeholder');
							ui.item.data('items', elements);
						},
						receive: function (e, ui) {
							ui.item.before(ui.item.data('items'));
						},
						stop: function (e, ui) {
							ui.item.siblings('.selected').removeClass('hidden');
							$('.selected').removeClass('selected');
						},
						update: updatePostOrder
					});
					
					
					$("#sortable1, #sortable2").disableSelection();
					$("#sortable1, #sortable2").css('minHeight', $("#sortable1").height() + "px");
					updatePostOrder();
					
					
				})
			}
		}	
	})
	
	
 
	
}

function getInsurrance ()
{
	var table = $('#Insurrance').DataTable({
		"bFilter" : false,               
		"bLengthChange": false,	
		"autoWidth": false,
		"responsive": true,
		"processing": true,
		"destroy": true,
		"fixedHeader": {
			header: true,
			footer: true
		},
		"pageLength": 30,
		"serverSide": true,
		"ordering": false,
		"ajax": {
			"url": nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '='+ nv_func_name +'&action=getData&second=' + new Date().getTime(),
			"data": {month: $('.datepickermonth').val()},
			"complete": function ( d ) {
			 <!-- console.log(d); -->
				$('.all').prop('checked', false)
 
				var lastChecked = null;
				var allCheckboxes = [];
 
				var checkboxes = document.getElementsByClassName("checkboxs");
				 for (var i=0; i<checkboxes.length; i++) {
					   allCheckboxes.push(checkboxes[i]);
					   checkboxes[i].onclick = function(e) {
							 if (!lastChecked) {
								   lastChecked = this;
								   return;
							 }
							 if (e.shiftKey) {
								   var startTemp = allCheckboxes.indexOf(this);
								   var endTemp = allCheckboxes.indexOf(lastChecked);
								   var start = Math.min(startTemp, endTemp);
								   var end = Math.max(startTemp, endTemp);
								   for (var i=start; i<=end; i++) {
										 allCheckboxes[i].checked = lastChecked.checked;
								   }
							 }
							 lastChecked = this;
					   };  
				 }  
 
				
				$('.text-department').each(function(){
					id = $(this).attr('data');
					$(this).text( globalData.department[id]['title'] );
				});
				$('.text-position').each(function(){
					id = $(this).attr('data');
					$(this).text( globalData.position[id]['t'] );
				});
				$('.text-jobtitle').each(function(){
					id = $(this).attr('data');
					$(this).text( globalData.job_title[id]['t'] );
				});
				
				 
				 
			}
		}, 
		createdRow: function(row, data, dataIndex){
		console.log(row);
			// If name is "Ashton Cox"
			if(data[0] === 'Ashton Cox'){
				// Add COLSPAN attribute
				$('td:eq(1)', row).attr('colspan', 3);

				// Hide required number of columns
				// next to the cell with COLSPAN attribute
				$('td:eq(2)', row).css('display', 'none');
				$('td:eq(3)', row).css('display', 'none');

				// Update cell data
				this.api().cell($('td:eq(1)', row)).data('N/A');
			}
		},		
		'columnDefs': [{
		 'targets': 0,
		 'searchable': false,
		 'orderable': false,
		 'className': 'text-center align-middle',
		 'render': function (data, type, full, meta){
			 return '<div class="icheck-danger checkbox"><input class="checkboxs" type="checkbox" value="' + $('<div/>').text(data).html() + '" name="selected[]" id="check' + $('<div/>').text(data).html() + '"> <label for="check' + $('<div/>').text(data).html() + '"></label> </div>'; 
		 }
		 
	  },{
		 'targets': 3,
		 'searchable': false,
		 'orderable': false,
		 'render': function (data, type, full, meta){
			 return '<span class="text-department" data="' + $('<div/>').text(data).html() + '"></span>'; 
		 }
		 
	  },{
		 'targets': 4,
		
		 'searchable': false,
		 'orderable': false,
		 'render': function (data, type, full, meta){
			 return '<span class="text-position" data="' + $('<div/>').text(data).html() + '"></span>'; 
		 }
		 
	  },{
		 'targets': 5,
		 'searchable': false,
		 'orderable': false,
		 'render': function (data, type, full, meta){
			 return '<span class="text-jobtitle" data="' + $('<div/>').text(data).html() + '"></span>'; 
		 } 
	  },{
		 'targets': 8,
		 'searchable': false,
		 'orderable': false,
		 'className': 'text-center align-middle', 
	  },{
		 'targets': 9,
		 'searchable': false,
		 'orderable': false,
		 'className': 'text-right align-middle', 
	  }],
 
	});

}


$(function () {
	getInsurrance();

	$(".datepickermonth").MonthPicker({

		Button: '<button class="MonthPicker" ><i class="fas fa-calendar-alt"></i></button>',
		i18n: {
			year: 'Năm',
			prevYear: 'Năm trước',
			nextYear: 'Năm sau',
			next12Years: '12 năm tiếp theo',
			prev12Years: 'Về 12 năm trước',
			nextLabel: 'Next',
			prevLabel: 'Prev',
			buttonText: 'Công cụ chọn tháng mở',
			jumpYears: 'Nhảy tới năm',
			backTo: 'Quay lại',
			months: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']
		},
		OnAfterMenuClose: function( selectedDate ){
			
			getInsurrance();
			$('#searchmonth').text( $(this).val());
		}
	});
 
	 
});
</script>
<!-- END: main -->

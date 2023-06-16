<!-- BEGIN: main -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="float-left card-title d62f2f">Danh sách hợp đồng</h3>
				<div class="float-right toolaction">
					<a href="#" data-toggle="tooltip" title="Import nhân sự Excel" ><i class="fas fa-file-upload"> </i><span>Nhập<span></a>
					<a href="#" onclick="ExportContent()"><i class="fas fa-file-export"> </i><span>Xuất<span></a>
					<a href="#" data-toggle="tooltip" title="Cài đặt"><i class="fas fa-cog"> </i><span>Cài đặt<span></a>
					<input type="hidden" value="0" name="contract_type" id="contract_type">
				</div>
			</div>
			<div id="nav-tab" class="nav nav-tabs" role="tablist">
				
				<!-- BEGIN: tab -->
				<a class="nav-item nav-link {TAB.active}"href="#tab-table{TAB.key}" data-tab="{TAB.key}" data-toggle="tab">{TAB.title}({TAB.total})</a>
				<!-- END: tab -->

			</div>	 
			<div class="tab-content">
				<!-- BEGIN: tabcontent -->
				<div class="tab-pane fade {TAB.active2}" id="tab-table{TAB.key}">
					<div class="card-body table-responsive">
						<table id="Contract{TAB.key}" class="table table-head-fixed text-nowrap">
						  <thead>
						  <tr>
							<th class="text-center" style="width:30px">
								<div class="icheck-danger"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" class="all" id="check_all{TAB.key}"><label for="check_all{TAB.key}"></label></div>
							</th>
							<th style="max-width:50px">Người tạo</th>
							<th>Mã HĐ</th>
							<th>Tên nhân sự</th>
							<th>Phòng ban</th>
							<th>Tên hợp đồng</th>
							<th>Ngày ký</th>
							<th>Hiệu lực</th>
						  </tr>
						  </thead>
						 
						</table>
					</div>
				</div>
				<!-- END: tabcontent -->
			</div>
		</div>
	</div>
</div>

<script src="{JSONFILE}"></script>

<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>


<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css">


<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js"></script>
 
<script>
 
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
 
 
function getDataTable( tab )
{
 
	var table = $('#Contract' + tab).DataTable({
		"ordering": false,
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
		"ajax": {
			"url": nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '='+ nv_func_name +'&action=getData&contract_type='+ tab +'&second=' + new Date().getTime(),
			"complete": function ( d ) {
				
				$('.all').prop('checked', false)
				$('table.dataTable').each(function(){
 					
					if( $(this).attr('id') != 'Contract'+tab ) 
					{ 
						$(this).find('tbody').remove();
					}		
				}); 
 
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
				$('.text-contract').each(function(){
					id = $(this).attr('data');
					$(this).text( globalData.contract[id]['t'] );
				});
				
				$('[data-toggle="tooltip"]').tooltip();
				 
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
		 'targets': 1,
		 'searchable': false,
		 'orderable': false,
		 'className': 'text-center align-middle',
		 'render': function (data, type, full, meta){
			 return '<span class="text-usercreate" data-toggle="tooltip" title="' + $('<div/>').text(data).html() + '"><i class="fas fa-user-plus"></i></span>'; 
		 }
		 
	  },{
		 'targets': 4,
		 'searchable': false,
		 'orderable': false,
		 'render': function (data, type, full, meta){
			 return '<span class="text-department" data="' + $('<div/>').text(data).html() + '"></span>'; 
		 }
		 
	  },{
		 'targets': 5,
		 'searchable': false,
		 'orderable': false,
		 'render': function (data, type, full, meta){
			 return '<span class="text-contract" data="' + $('<div/>').text(data).html() + '"></span>'; 
		 }
		 
	  }]
	});
 
}
 
$(function () {
	
	
	getDataTable( 0 );
	
	$('a[data-toggle="tab"]').on('click', function(){
		var contract_type = $(this).attr('data-tab');
		$('#contract_type').val(contract_type);
		getDataTable( contract_type );
	});
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	
		$(this).
		$.fn.dataTable.tables({ visible: true, api: true })
			.columns.adjust()
			.fixedHeader.adjust()
			.fixedColumns().relayout()
			.responsive.recalc();
	});
 
});
</script>
<!-- END: main -->

<!-- BEGIN: main -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg modal-dialog-centered">
	  <div class="modal-content">
		<div class="modal-header">
		  <h4 class="modal-title">Xuất dữ liệu excel</h4>
		  <button type="button" class="close" data-dismiss="modal">×</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="titlebox">Lựa chọn trường</div>
					<div class="card">				
					<div class="card-body">						
					  <ul id="sortable1" class="droptrue">
						<!-- BEGIN: export -->
						<li data="{EXPORT.key}" class="external-event bg-danger">{EXPORT.title}</li>
						 
						<!-- END: export -->
					  </ul>
					</div>
 				  </div>
			  </div>          
			  <div class="col-md-6 col-sm-6">
				<div class="titlebox">Trường xuất</div>
				  <div class="card">					
					<div class="card-body">						
						<ul id="sortable2" class="droptrue">
					</div>
 				  </div>
			  </div>
          </div>
		  <input type="hidden" id="exportlist" name="exportlist" value="" />
		  <input type="hidden" id="{TOKENKEY}" name="{TOKENKEY}" value="{TOKEN}" />
		</div>
		<div class="modal-footer text-center">
			<button type="button" data-submit data="0" class="btn btn-danger btn-sm"><i class="fas fa-file-export"></i> Xuất dữ liệu tháng đã chọn</button>
			<button type="button" data-submit data="1" class="btn btn-danger btn-sm"><i class="fas fa-file-export"></i> Xuất dữ liệu tất cả</button>
		</div>
	  </div>
	</div>
</div>
<script>

$('button[data-submit]').on('click', function(){
	var obj = $(this)
	var all = obj.attr('data');
	var month = $('#searchmonth').text();
	$.ajax({
		url: nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '='+ nv_func_name +'&action=Export&second=' + new Date().getTime(),
		method: 'post',
		data: {exportlist: $('#exportlist').val(), month : month, all : all, {TOKENKEY} : '{TOKEN}'},
		dataType: 'json',
		beforeSend: function() {
			obj.find('i').replaceWith('<i class="fas fa-circle-notch fa-spin"></i>');
			$('#myModal .modal-body').addClass('opacity50');
			$('button[data-submit]').prop('disabled', true);
		},	
		complete: function() {
			obj.find('i').replaceWith('<i class="fas fa-file-export"></i>');
			$('button[data-submit]').prop('disabled', false);
			$('#myModal .modal-body').removeClass('opacity50');
		},
		success: function(json) {
			if( json['error'] ) alert( json['error'] );  		
			if( json['link'] ) window.location.href= json['link'];  		
		}
	})

})

</script>
<!-- END: main -->

<!-- BEGIN: main -->
<div id="content"> 
	<!-- BEGIN: success -->
	<div class="alert alert-success">
		<i class="fa fa-check-circle"></i> {SUCCESS}<i class="fa fa-times"></i>
	</div>
	<!-- END: success -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left; text-transform:uppercase;font-weight:bold"><i class="fa fa-list"></i> {LANG.class_list}</h3> 
			 <div class="pull-right">
				<a href="{ADD_NEW}" data-toggle="tooltip" data-placement="top" title="{LANG.add_new}" class="btn btn-success  btn-sm"><i class="fa fa-plus"></i></a>
				<button type="button" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm" id="button-delete" title="{LANG.delete}">
					<i class="fa fa-trash-o"></i>
				</button>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<div class="row">
				
				<form  action="{NV_BASE_ADMINURL}index.php" method="get" id="formsearch" style="margin-bottom: 15px;display:block"> 
					<input type="hidden" name ="{NV_NAME_VARIABLE}"value="{MODULE_NAME}" />
					<input type="hidden" name ="{NV_OP_VARIABLE}"value="{OP}" />
					<div class="col-sm-24">
					
						<div class="input-group" style="max-width: 300px">
							<input type="text" name="q" id="keyword" value="{DATA.q}" class="form-control" placeholder="{LANG.class_keyword}"> 
							<label class="input-group-btn">
									<button type="submit" class="btn btn-info"> <i class="fa fa-search"></i>{LANG.search} </button>
							</label>
						</div>

					</div> 
					<div class="clearfix"></div>
				</form>
				
				<form action="#" method="post" enctype="multipart/form-data" id="form-class">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<td class="col-sm-0 text-center"><input name="check_all[]" type="checkbox" value="yes" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" ></td>
									<td class="col-sm-2 text-center"><a {WEIGHT_ORDER} href="{URL_WEIGHT}"><strong>{LANG.weight}</strong></a></td>
									<td class="col-sm-3 text-center"><a {CLASS_NAME_ORDER} href="{URL_CLASS_NAME}"><strong>{LANG.class_class_name}</strong></a> </td>
									<td class="col-sm-3 text-center"><a {PRICE_ORDER} href="{URL_PRICE}"><strong>{LANG.class_price}</strong></a> </td>
									<td class="col-sm-2 text-center"><a {NUMBERLEARN_ORDER} href="{URL_NUMBERLEARN}"><strong>{LANG.class_numberlearn}</strong></a> </td>
									<td class="col-sm-3 text-center"><a {TYPE_ORDER} href="{URL_TYPE}"><strong>{LANG.class_type}</strong></a> </td>
									<td class="col-sm-3 text-center"><a {TEACHER_ORDER} href="{URL_TEACHER}"><strong>{LANG.class_teacher}</strong></a> </td>
									<td class="col-sm-3 text-center"><a {OPENING_DAY_ORDER} href="{URL_OPENING_DAY}"><strong>{LANG.class_opening_day}</strong></a> </td>
									<td class="col-sm-2 text-center"><a {STATUS_ORDER} href="{URL_STATUS}"><strong>{LANG.class_status}</strong></a> </td>
									<td class="col-sm-3 text-right"> <strong>{LANG.action} </strong></td>
								</tr>
							</thead>
							<tbody>
								 <!-- BEGIN: loop --> 
								<tr id="group_{LOOP.class_id}">
									<td class="text-center">
										<input type="checkbox" name="selected[]" value="{LOOP.class_id}" >
									</td>	
									<td class="text-center">
										<select id="id_weight_{LOOP.class_id}"  class="form-control formajax" data-action="weight" data-id="{LOOP.class_id}" data-token="{LOOP.token}">
										<!-- BEGIN: weight -->
										<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.name}</option>
										<!-- END: weight -->
										</select>
									</td>
									<td class="text-left"><a href="{LOOP.link}" target="_blank">{LOOP.class_name}</a></td>
									<td class="text-center">{LOOP.price}</td>
									<td class="text-center">{LOOP.numberlearn}</td>
									<td class="text-left">{LOOP.type}</td>
									<td class="text-left">{LOOP.teacher}</td>
									<td class="text-center">{LOOP.opening_day}</td>
									<td class="text-center">
										<select id="id_status_{LOOP.class_id}" class="form-control formajax" data-action="status" data-id="{LOOP.class_id}" data-token="{LOOP.token}">
										<!-- BEGIN: status -->
										<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
										<!-- END: status -->
										</select>
									</td>
									<td class="text-right">
										<a href="{LOOP.edit}" data-toggle="tooltip" title="{LANG.edit}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										<a href="javascript:void(0);" onclick="delete_class('{LOOP.class_id}', '{LOOP.token}')" data-toggle="tooltip" title="{LANG.delete}" class="btn btn-danger  btn-sm"><i class="fa fa-trash-o"></i>
									</td>
								</tr>
								 <!-- END: loop -->
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
		<!-- BEGIN: generate_page -->
		<div class="row">
			<div class="col-sm-24 text-center">
			{GENERATE_PAGE}			
			</div>
		</div>
		<!-- END: generate_page -->
	</div>
</div>

<script type="text/javascript">
function delete_class(class_id, token) {
	if(confirm('{LANG.confirm}')) {
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=class&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'class_id=' + class_id + '&token=' + token,
			beforeSend: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				$('.alert').remove();
				$('div[class="tooltip fade top in"]').remove();
				if (json['error']) {
					$('#class-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#class-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

$('.formajax').on('change', function() {
	var action = $(this).attr('data-action');
	var token = $(this).attr('data-token');
	var class_id = $(this).attr('data-id');
	var new_vid = $(this).val();
	var id = $(this).attr('id');
	$.ajax({
		url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=class&nocache=' + new Date().getTime(),
		type: 'post',
		dataType: 'json',
		data: 'action=' + action + '&class_id=' + class_id + '&new_vid=' + new_vid + '&token='+token,
		beforeSend: function() {
			$('#'+id ).prop('disabled', true);
			$('.alert').remove();
		},	
		complete: function() {
			$('#'+id ).prop('disabled', false);
		},
		success: function(json) {
			$('div[class="tooltip fade top in"]').remove();
			if ( json['error'] ) alert( json['error'] );	
			if ( json['link'] ) location.href = json['link'];
 
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
 
$('#button-delete').on('click', function() {
	if(confirm('{LANG.confirm}')) 
	{
		var listid = [];
		$("input[name=\"selected[]\"]:checked").each(function() {
			listid.push($(this).val());
		});
		if (listid.length < 1) {
			alert("{LANG.please_select_one}");
			return false;
		}
	 
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=class&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'listid=' + listid + '&token={TOKEN}',
			beforeSend: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-delete').prop('disabled', true);
			},	
			complete: function() {
				$('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
				$('#button-delete').prop('disabled', false);
			},
			success: function(json) {
				$('.alert').remove();
				$('div[class="tooltip fade top in"]').remove();
 
				if (json['error']) {
					$('#class-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#class-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
					 $.each(json['id'], function(i, id) {
						$('#group_' + id ).remove();
					});
				}		
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}	
});

</script>
<!-- END: main -->
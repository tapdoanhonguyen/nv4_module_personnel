﻿<!-- BEGIN: main -->
<div id="content"> 
	<!-- BEGIN: success -->
		<div class="alert alert-success">
			<i class="fa fa-check-circle"></i> {SUCCESS}<i class="fa fa-times"></i>
		</div>
	<!-- END: success -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left; text-transform:uppercase;font-weight:bold"><i class="fa fa-list"></i> {LANG.registermedical_list}</h3> 
			 <div class="pull-right">
				<a href="{ADD_NEW}" data-toggle="tooltip" data-placement="top" title="{LANG.add_new}" class="btn btn-success  btn-sm"><i class="fa fa-plus"></i></a>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<form action="#" method="post" enctype="multipart/form-data" id="form-registermedical">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="col-sm-4 text-center"><a {WEIGHT_ORDER} href="{URL_WEIGHT}"><strong>{LANG.weight}</strong></a></td>
								<td class="col-sm-8 text-center"><a {TITLE_ORDER} href="{URL_TITLE}"><strong>{LANG.registermedical_title}</strong></a> </td>
								<td class="col-sm-4 text-center"><a {PROVINCE_ORDER} href="{URL_PROVINCE}"><strong>{LANG.registermedical_province}</strong></a> </td>
								<td class="col-sm-4 text-center"><a {STATUS_ORDER} href="{URL_STATUS}"><strong>{LANG.registermedical_status}</strong></a> </td>
								<td class="col-sm-4 text-right"> <strong>{LANG.action} </strong></td>
							</tr>
						</thead>
						<tbody>
							 <!-- BEGIN: loop --> 
							<tr id="group_{LOOP.registermedical_id}">
								<td class="text-center">
									<select id="id_weight_{LOOP.registermedical_id}"  class="form-control formajax" data-action="weight" data-id="{LOOP.registermedical_id}" data-token="{LOOP.token}">
									<!-- BEGIN: weight -->
									<option value="{WEIGHT.key}"{WEIGHT.selected}>{WEIGHT.name}</option>
									<!-- END: weight -->
									</select>
								</td>
								<td class="text-left">{LOOP.title}</a></td>
								<td class="text-center"><a href="{LOOP.link_province}" target="_blank">{LOOP.province}</a></td>
								<td class="text-center">
									<select id="id_status_{LOOP.registermedical_id}" class="form-control formajax" data-action="status" data-id="{LOOP.registermedical_id}" data-token="{LOOP.token}">
									<!-- BEGIN: status -->
									<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
									<!-- END: status -->
									</select>
								</td>
								<td class="text-right">
									<a href="{LOOP.edit}" data-toggle="tooltip" title="{LANG.edit}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
									<a href="javascript:void(0);" onclick="delete_registermedical('{LOOP.registermedical_id}', '{LOOP.token}')" data-toggle="tooltip" title="{LANG.delete}" class="btn btn-danger  btn-sm"><i class="fa fa-trash-o"></i>
								</td>
							</tr>
							 <!-- END: loop -->
						</tbody>
					</table>
				</div>
			</form>
			<!-- BEGIN: generate_page -->
			<div class="row">
				<div class="col-sm-24 text-center">
				{GENERATE_PAGE}			
				</div>
			</div>
			<!-- END: generate_page -->
		</div>
	</div>
</div>

<script type="text/javascript">
function delete_registermedical(registermedical_id, token) {
	if(confirm('{LANG.confirm}')) {
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=registermedical&action=delete&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'registermedical_id=' + registermedical_id + '&token=' + token,
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

				if (json['error']) {
					$('#registermedical-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#registermedical-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
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
	var registermedical_id = $(this).attr('data-id');
	var new_vid = $(this).val();
	var id = $(this).attr('id');
	$.ajax({
		url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=registermedical&nocache=' + new Date().getTime(),
		type: 'post',
		dataType: 'json',
		data: 'action=' + action + '&registermedical_id=' + registermedical_id + '&new_vid=' + new_vid + '&token='+token,
		beforeSend: function() {
			$('#'+id ).prop('disabled', true);
			$('.alert').remove();
		},	
		complete: function() {
			$('#'+id ).prop('disabled', false);
		},
		success: function(json) {
			
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
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=registermedical&action=delete&nocache=' + new Date().getTime(),
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
 
				if (json['error']) {
					$('#registermedical-content').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
				}
				
				if (json['success']) {
					$('#registermedical-content').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');
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
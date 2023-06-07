<!-- BEGIN: main -->
<div id="content">
    <!-- BEGIN: error_warning -->
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> {error_warning}<i class="fa fa-times"></i>
    </div>
    <!-- END: error_warning -->
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i> {CAPTION}</h3>
			<div class="pull-right">
				<button type="submit" form="form-stock" data-toggle="tooltip" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i></button> 
				<a href="{CANCEL}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<form action="" method="post"  enctype="multipart/form-data" id="form-class" class="form-horizontal">
				<input type="hidden" name ="class_id" value="{DATA.class_id}" />
				<input name="save" type="hidden" value="1" />
 
				<div class="form-group required">
					<label class="col-sm-4 control-label" for="input-class_name">{LANG.class_class_name}</label>
					<div class="col-sm-20">
						<input type="text" name="class_name" value="{DATA.class_name}" placeholder="{LANG.class_class_name}" id="input-titles" class="form-control" />
						<!-- BEGIN: error_class_name --><div class="text-danger">{error_class_name}</div><!-- END: error_class_name -->
					</div>
				</div> 
				<div class="form-group required">
					<label class="col-sm-4 control-label" for="input-alias">{LANG.class_alias}</label>
					<div class="col-sm-20">
						<div class="input-group">
							<input type="text" name="alias" id="input-alias" value="{DATA.alias}" class="form-control" placeholder="{LANG.class_alias}"> 
							<label class="input-group-btn">
								<span class="btn btn-info">
									<i class="fa fa-refresh fa-lg fa-pointer" onclick="get_alias( );"></i>
								</span>
							</label>
						</div>
					</div>
				</div> 
				 
				<div class="form-group required">
					<label class="col-sm-4 control-label" for="input-price">{LANG.class_price}</label>
					<div class="col-sm-20">
						<input type="text" name="price" value="{DATA.price}" placeholder="{LANG.class_price}" id="input-price" class="form-control money" />
						<!-- BEGIN: error_price --><div class="text-danger">{error_price}</div><!-- END: error_price -->
					</div>
				</div> 
                <div class="form-group required">
					<label class="col-sm-4 control-label" for="input-numberlearn">{LANG.class_numberlearn}</label>
					<div class="col-sm-20">
						<input type="text" name="numberlearn" value="{DATA.numberlearn}" placeholder="{LANG.class_numberlearn}" id="input-numberlearn" class="form-control" />
						<!-- BEGIN: error_numberlearn --><div class="text-danger">{error_numberlearn}</div><!-- END: error_numberlearn -->
					</div>
				</div> 
                <div class="form-group required">
					<label class="col-sm-4 control-label" for="input-opening_day">{LANG.class_opening_day}</label>
					<div class="col-sm-20">
						<input type="text" name="opening_day" value="{DATA.opening_day}" placeholder="dd/mm/yyyy" id="input-openingday" class="form-control" style="display:inline-block;width:100px" />
						<!-- BEGIN: error_opening_day --><div class="text-danger">{error_opening_day}</div><!-- END: error_opening_day -->
						<select class="form-control" name="opening_hour" style="width:100px;display:inline-block">
							<!-- BEGIN: opening_hour -->
							<option value="{OPENING_HOUR.key}" {OPENING_HOUR.selected}>{OPENING_HOUR.name}</option>
							<!-- END: opening_hour -->
						</select>
						<select class="form-control" name="opening_minute" style="width:100px;display:inline-block">
							<!-- BEGIN: opening_minute -->
							<option value="{OPENING_MINUTE.key}" {OPENING_MINUTE.selected}>{OPENING_MINUTE.name}</option>
							<!-- END: opening_minute --> 
						</select>
					</div>
				</div> 
 
                <div class="form-group required">
					<label class="col-sm-4 control-label" for="input-class_name">{LANG.class_image}</label>
					<div class="col-sm-20">
						<div class="input-group" style="max-width: 300px">
							<input type="text" name="image" id="image" value="{DATA.image}" class="form-control" placeholder="{LANG.class_select_image}"> 
							<label class="input-group-btn">
								<span class="btn btn-info">
									{LANG.class_select_image}<input id="selectimage" type="button" style="display: none;">
								</span>
							</label>
						</div>
						<!-- BEGIN: error_image --><div class="text-danger">{error_image}</div><!-- END: error_image -->
					</div>
				</div> 
                	 
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-type">{LANG.class_category}</label>
					<div class="col-sm-20">
						<select name="category_id" id="input-category" class="form-control select2">
							<option value="0" >{LANG.class_select_category}</option>
							<!-- BEGIN: category -->
							<option value="{CATEGORY.key}" {CATEGORY.selected}>{CATEGORY.name}</option>
							<!-- END: category -->
						</select>
						<!-- BEGIN: error_category --><div class="text-danger">{error_category}</div><!-- END: error_category -->
					</div>
				</div>  
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-teacher">{LANG.class_teacher}</label>
					<div class="col-sm-20">
						<select name="teacher_id" id="input-teacher" class="form-control select2">
							<option value="0" >{LANG.class_select_teacher}</option>
							<!-- BEGIN: teacher -->
							<option value="{TEACHER.key}" {TEACHER.selected}>{TEACHER.name}</option>
							<!-- END: teacher -->
						</select>
						<!-- BEGIN: error_teacher --><div class="text-danger">{error_teacher}</div><!-- END: error_teacher -->
					</div>
				</div>                    
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-type">{LANG.class_type}</label>
					<div class="col-sm-20">
						<select name="type_id" id="input-type" class="form-control select2">
							<option value="0" >{LANG.class_select_type}</option>
							<!-- BEGIN: type -->
							<option value="{TYPE.key}" {TYPE.selected}>{TYPE.name}</option>
							<!-- END: type -->
						</select>
						<!-- BEGIN: error_type --><div class="text-danger">{error_type}</div><!-- END: error_type -->
					</div>
				</div>  
				<div class="form-group required">
					<label class="col-sm-4 control-label" for="input-description">{LANG.class_description}</label>
					<div class="col-sm-20">
						<textarea type="text" name="description"  placeholder="{LANG.class_description}" id="input-description" class="form-control">{DATA.description}</textarea>
						<!-- BEGIN: error_description --><div class="text-danger">{error_description}</div><!-- END: error_description -->
					</div>
				</div>				
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-type">{LANG.class_detail}</label>
					<div class="col-sm-20">
						 {DATA.detail}
						 <!-- BEGIN: error_detail --><div class="text-danger">{error_detail}</div><!-- END: error_detail -->
					</div>
				</div>                    
					 
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-status">{LANG.class_status}</label>
					<div class="col-sm-20">
						<select name="status" id="input-status" class="form-control">
							<!-- BEGIN: status -->
							<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
							<!-- END: status -->
						</select>
					</div>
				</div>                    
				<div align="center">
					<input class="btn btn-primary" type="submit" value="{LANG.save}">
					<a class="btn btn-default" href="{CANCEL}" title="{LANG.cancel}">{LANG.cancel}</a> 
				</div>          
			</form>
		</div>
	</div>
</div>
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
 
<script type="text/javascript">


$(document).ready(function() {
	$("#input-openingday").datepicker({
		showOn : "both",
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
		buttonImage : nv_base_siteurl + "assets/images/calendar.gif",
		buttonImageOnly : true
	});
	$('.select2').select2({language: '{NV_LANG_INTERFACE}'})
	$('.money').price_format();
	$("#selectimage").click(function() {
		var area = "image";
		var path = "{NV_UPLOADS_DIR}/{MODULE_UPLOAD}";
		var currentpath = "{CURRENT}";
		var type = "image";
		nv_open_browse("{NV_BASE_ADMINURL}index.php?{NV_NAME_VARIABLE}=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type + "&currentpath=" + currentpath, "NVImg", 850, 500, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});
 	$('#form-class').on('submit', function() {
		$('#submitform,button[type="submit"]').prop('disabled', true);
		$('#submitform .fa-spinner').show();
	});
	function get_alias ( class_id )
	{
		$.ajax({
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=class&nocache=' + new Date().getTime(),
			type: 'post',
			dataType: 'json',
			data: 'action=alias&class_id=' + class_id + '&title=' + $('#input-titles' ).val(),
			beforeSend: function() {
				$('#input-titles' ).prop('disabled', true);
				$('#input-alias' ).prop('disabled', true);
 			},	
			complete: function() {
				$('#input-titles' ).prop('disabled', false);
				$('#input-alias' ).prop('disabled', false);
			},
			success: function(json) {
				
				if( json['alias'] )
				{
					$('#input-alias' ).val(json['alias']);
				}
	 
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
	<!-- BEGIN: getalias -->
	$("#input-titles").change(function() {
		get_alias({DATA.class_id});
	});
	<!-- END: getalias --> 
});

</script>
<!-- END: main -->
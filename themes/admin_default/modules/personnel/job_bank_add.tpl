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
			<form action="" method="post"  enctype="multipart/form-data" id="form-job_bank" class="form-horizontal">
				<input type="hidden" name ="data_id" value="{DATA.data_id}" />
				<input name="save" type="hidden" value="1" />
 
				<div class="form-group required">
					<label class="col-sm-4 control-label" for="input-title">{LANG.job_bank_title}</label>
					<div class="col-sm-20">
						<input type="text" name="title" value="{DATA.title}" placeholder="{LANG.job_bank_title}" id="input-titles" class="form-control" />
						<!-- BEGIN: error_title --><div class="text-danger">{error_title}</div><!-- END: error_title -->
					</div>
				</div> 
 
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-status">{LANG.job_bank_status}</label>
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
<script type="text/javascript">
$(document).ready(function() {
 	$('#form-job_bank').on('submit', function() {
		$('#submitform,button[type="submit"]').prop('disabled', true);
		$('#submitform .fa-spinner').show();
	});	 
});
</script>
<!-- END: main -->
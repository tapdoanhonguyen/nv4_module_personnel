<!-- BEGIN: main -->
<div id="photo-content">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i> {LANG.setting}</h3>
            <div class="pull-right">
                <button type="submit" form="form-stock" data-toggle="tooltip" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i>
                </button> <a href="{CANCEL}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
            </div>
            <div style="clear:both"></div>
        </div>
		<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">
				<input type="hidden" value="1" name="savesetting" />				
				<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
				<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}" />
 
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_perpage}:</label>
					<div class="col-sm-18">
						<input type="text" class="form-control" name="perpage" value="{DATA.perpage}">
					</div>
				</div>
 
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_comment}:</label>
					<div class="col-sm-18">
						<a class="btn btn-primary" href="{LINK_COMMENT}" target="blank">{LANG.setting_comment_link}</a>
					</div>
				</div>    
 
				<div class="form-group">
					<label class="col-sm-6 control-label">{LANG.setting_captcha}:</label>
					<div class="col-sm-18">
						 <a class="btn btn-primary" href="{LINK_CAPTCHA}" target="blank">{LANG.setting_captcha_link}</a>		
					</div>
				</div>    
 
				
			</form>
		</div>
    </div>
</div>
 
<script type="text/javascript">

$('button[type=\'submit\']').on('click', function() {
	$("form[id*='form-']").submit();
});
 
</script>
<!-- END: main -->
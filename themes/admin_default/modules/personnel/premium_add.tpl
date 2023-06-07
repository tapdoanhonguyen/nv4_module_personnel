<!-- BEGIN: main -->
<div id="group-exam-content">
    <!-- BEGIN: error_warning -->
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> {WARNING}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <br>
    </div>
    <!-- END: error_warning -->
    <div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title" style="float:left"><i class="fa fa-pencil"></i> {CAPTION}</h3>
			<div class="pull-right">
				<button type="submit" form="form-group-exam" data-toggle="tooltip" class="btn btn-primary" title="{LANG.save}"><i class="fa fa-save"></i></button> 
				<a href="{CANCEL}" data-toggle="tooltip" class="btn btn-default" title="{LANG.cancel}"><i class="fa fa-reply"></i></a>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="panel-body">
			<form action="" method="post"  enctype="multipart/form-data" id="form-premium" class="form-horizontal">
				<input type="hidden" name ="premium_id" value="{DATA.premium_id}" />
				<input type="hidden" name ="parentid_old" value="{DATA.parent_id}" />
				<input name="save" type="hidden" value="1" />
 
				<div class="form-group required">
					<label class="col-sm-4 control-label" for="inputs-title">{LANG.premium_title}</label>
					<div class="col-sm-20">
						<input type="text" name="title" value="{DATA.title}" placeholder="{LANG.premium_title}" id="input-titles" class="form-control btn-sm" />
						<!-- BEGIN: error_title --><div class="text-danger">{error_title}</div><!-- END: error_title -->
					</div>
				</div>
				 
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-parent">{LANG.premium_sub}</label>
					<div class="col-sm-20">
						<select class="form-control btn-sm" name="parent_id">
							<option value="0">{LANG.premium_sub_sl}</option>
							<!-- BEGIN: premium -->
							<option value="{CATEGORY.key}" {CATEGORY.selected}>{CATEGORY.name}</option>
							<!-- END: premium -->
						</select>
					</div>
				</div>			
 		
                <div class="form-group">
                     <label class="col-sm-4 control-label" for="input-description">{LANG.premium_description} </label>
                     <div class="col-sm-20">
                          <textarea name="description" rows="2" placeholder="{LANG.premium_description}" id="input-description" class="form-control btn-sm">{DATA.description}</textarea>
						  <!-- <span class="text-middle"> {GLANG.length_characters}: <span id="descriptionlength" class="red">0</span>. {GLANG.description_suggest_max} </span> -->            
                      </div>
                 </div>
                                    
				<div class="form-group">
					<label class="col-sm-4 control-label" for="input-status">{LANG.premium_show_status}</label>
					<div class="col-sm-20">
						<select name="status" id="input-status" class="form-control btn-sm">
							<!-- BEGIN: status -->
							<option value="{STATUS.key}" {STATUS.selected}>{STATUS.name}</option>
							<!-- END: status -->
						</select>
					</div>
				</div>                    
				<div align="center">
					<input class="btn btn-primary btn-sm" type="submit" value="{LANG.save}">
					<a class="btn btn-primary btn-sm" href="{CANCEL}" title="{LANG.cancel}">{LANG.cancel}</a> 
				</div>          
			</form>
		</div>
	</div>
</div>
 
<!-- END: main -->
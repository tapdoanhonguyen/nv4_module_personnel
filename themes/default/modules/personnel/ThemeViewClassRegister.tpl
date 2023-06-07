<!-- BEGIN: main -->
<form class="user-reg-form" action="{USER_REGISTER}" method="post" onsubmit="return registerValidForm(this);" autocomplete="off" novalidate>
    <div class="nv-info margin-bottom" data-default="{LANG.class_info}">{LANG.class_info}</div>
    <div class="form-detail">
        <div class="form-group">
            <div>
                <input type="text" class="form-control disabled" value="{LANG.item_class}: {DATA.class_name}" disabled="disabled">
            </div>
        </div>
		<div class="form-group">
            <div>
                <input type="text" class="form-control disabled" value="{LANG.class_opening_day}: {DATA.opening_day}" disabled="disabled">
            </div>
        </div>
		<div class="form-group">
            <div>
                <input type="text" class="form-control disabled" value="{LANG.class_price}: {DATA.price}" disabled="disabled">
            </div>
        </div>
		<div class="form-group">
            <div>
                <input type="text" class="form-control disabled" value="{LANG.class_numberlearn}: {DATA.numberlearn} {LANG.class_numberlearn_note}" disabled="disabled">
            </div>
        </div>
		<div class="form-group">
            <div>
                <input type="text" class="form-control disabled" value="{LANG.class_teacher}:{DATA.teacher_name}" disabled="disabled">
            </div>
        </div>
		<div class="form-group">
            <div>
                <input type="text" class="required form-control" placeholder="{LANG.item_full_name}" value="" name="full_name" maxlength="250" onkeypress="validErrorHidden(this);" data-mess="{LANG.item_full_name_empty}">
            </div>
        </div>

        <div class="form-group">
            <div>
                <input type="email" class="required form-control" placeholder="{LANG.item_email}" value="" name="email" maxlength="100" onkeypress="validErrorHidden(this);" data-mess="{LANG.item_email_empty}">
            </div>
        </div>
		
		<div class="form-group">
            <div>
                <input type="text" class="required form-control" placeholder="{LANG.item_phone}" value="" name="phone" maxlength="100" onkeypress="validErrorHidden(this);" data-mess="{LANG.item_phone_empty}">
            </div>
        </div>
  
        <!-- BEGIN: captcha -->
        <div class="form-group">
            <div class="middle text-center clearfix">
                <img class="captchaImg display-inline-block" src="{SRC_CAPTCHA}" width="{GFX_WIDTH}" height="{GFX_HEIGHT}" alt="{N_CAPTCHA}" title="{N_CAPTCHA}" />
                <em class="fa fa-pointer fa-refresh margin-left margin-right" title="{CAPTCHA_REFRESH}" onclick="change_captcha('.rsec');"></em>
                <input type="text" style="width:100px;" class="rsec required form-control display-inline-block" name="captcha" value="" maxlength="{GFX_MAXLENGTH}" placeholder="{GLANG.securitycode}" data-pattern="/^(.){{GFX_MAXLENGTH},{GFX_MAXLENGTH}}$/" onkeypress="validErrorHidden(this);" data-mess="{GLANG.securitycodeincorrect}" />
            </div>
        </div>
        <!-- END: captcha -->
        <!-- BEGIN: recaptcha -->
        <div class="form-group">
            <div class="middle text-center clearfix">
                <div class="nv-recaptcha-default">
                    <div id="{RECAPTCHA_ELEMENT}" data-toggle="recaptcha"></div>
                </div>
                <script type="text/javascript">
                    nv_recaptcha_elements.push({
                        id : "{RECAPTCHA_ELEMENT}",
                        btn : $('[type="submit"]', $('#{RECAPTCHA_ELEMENT}').parent().parent().parent().parent()),
                        pnum : 4,
                        btnselector : '[type="submit"]'
                    })
                </script>
            </div>
        </div>
        <!-- END: recaptcha -->
        <div class="text-center margin-bottom-lg">
            <input type="hidden" name="token" value="{DATA.token}" />
            <input type="hidden" name="class_id" value="{DATA.class_id}" />
            <!-- <input type="button" value="{GLANG.reset}" class="btn btn-default" onclick="validReset(this.form);return!1;"/> -->
            <input type="submit" id="registerClass" class="btn btn-primary" value="{LANG.register}" />
        </div>

    </div>
</form>
<!-- END: main -->
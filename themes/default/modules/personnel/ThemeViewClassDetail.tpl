<!-- BEGIN: main -->
<div class="Detail">	
	<div class="GroupExam">
		<div class="row">
			<div class="col-md-8 col-sm-24 fixed">
				<a href="#" title="{DATA.class_name}"><img alt="{DATA.class_name}" src="{DATA.image}"></a>
			</div>		
			<div class="col-md-16 col-sm-24 fixed">
				<ul class="list-group">
					<li class="list-group-item"><h1>{DATA.class_name}</h1></li>
					<li class="list-group-item"><strong>{LANG.class_opening_day}:</strong> {DATA.opening_day} </li>
					<li class="list-group-item"><strong>{LANG.class_price}:</strong> {DATA.price}</li>
					<li class="list-group-item"><strong>{LANG.class_numberlearn}:</strong> {DATA.numberlearn} {LANG.class_numberlearn_note}</li>
					<li class="list-group-item"><strong>{LANG.class_teacher}:</strong><a href="#" data-name="{DATA.teacher_name}" class="showinfo" data-id="{DATA.teacher_id}"> {DATA.teacher_name}<a></li>
					<li class="list-group-item"><strong>{LANG.class_type}:</strong> {DATA.type}</li>
					<li class="list-group-item"><a class="btn btn-primary" href="#" onclick="getFormRegister('{DATA.class_id}', '{DATA.token}')">{LANG.class_register}</a></li>
				</ul>
			</div>
			<div class="clearfix">&nbsp;</div>			
		</div>
		
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#Tabdetail">{LANG.item_tab_detail}</a></li>
			<!-- BEGIN: tab_comment -->
			<li><a data-toggle="tab" href="#Tabcomment">{LANG.item_tab_comment}</a></li>
			<!-- END: tab_comment -->
		</ul>

		<div class="tab-content">
			<div id="Tabdetail" class="tab-pane fade in active">
				<div class="panel-body">
					{DATA.detail}
				</div>	
					
			</div>
			<!-- BEGIN: comment -->
			<div id="Tabcomment" class="tab-pane fade">	
				<div class="panel-body">
					{COMMENT}
				</div>				
			</div>
			<!-- END: comment -->
 		</div> 
	</div> 
</div> 
<div class="modal fade" id="ModalAddList" role="dialog">
	<div class="modal-dialog modal-md">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title"></h4>
		</div>
		<div class="modal-body">
		 
		</div>
 
	  </div>  
	</div>
</div>
<script type="text/javascript">
 
function getFormRegister(class_id, token) {
	 $.ajax({
		url: nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&action=getForm&second=' + new Date().getTime(),
		type: 'post',
		dataType: 'json',
		data: { class_id:class_id, token:token },
		beforeSend: function() {
		},	
		complete: function() {
		},
		success: function(json) {
			if ( json['template'] ) 
			{
				$('#ModalAddList .modal-title').html( '{LANG.class_register_title}: ' + json['title'] ); 
				$('#ModalAddList .modal-body').html( json['template'] ); 
				$('#ModalAddList').modal('show') 
			}
			else if ( json['error'] ) 
			{
				alert( json['error'] );	
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}


function validErrorHidden(a, b) {
    if (!b) b = 2;
    b = parseInt(b);
    var c = $(a),
        d = $(a);
    for (var i = 0; i < b; i++) {
        c = c.parent();
        if (i >= 2) d = d.parent()
    }
    d.tooltip("destroy");
    c.removeClass("has-error")
}

function formErrorHidden(a) {
    $(".has-error", a).removeClass("has-error");
    $("[data-mess]", a).tooltip("destroy")
}

function validReset(a) {
    var d = $(".nv-info", a).attr("data-default");
    if (!d) d = $(".nv-info-default", a).html();
    $(".nv-info", a).removeClass("error success").html(d);
    formErrorHidden(a);
    $("input,button", a).prop("disabled", !1);
    $(a)[0].reset()
}
function validErrorShow(a) {
    $(a).parent().parent().addClass("has-error");
    $("[data-mess]", $(a).parent().parent().parent()).not(".tooltip-current").tooltip("destroy");
    $(a).tooltip({
       container: "body",
        placement: "bottom",
        title: function() {
            return "" != $(a).attr("data-current-mess") ? $(a).attr("data-current-mess") : nv_required
        }
    });
    $(a).focus().tooltip("show");
    "DIV" == $(a).prop("tagName") && $("input", a)[0].focus()
}

function validCheck(a) {
    if ($(a).is(':visible')) {
        var c = $(a).attr("data-pattern"),
            d = $(a).val(),
            b = $(a).prop("tagName"),
            e = $(a).prop("type");
        if ("INPUT" == b && "email" == e) {
            if (!nv_mailfilter.test(d)) return !1
        } else if ("SELECT" == b) {
            if (!$("option:selected", a).length) return !1
        } else if ("DIV" == b && $(a).is(".radio-box")) {
            if (!$("[type=radio]:checked", a).length) return !1
        } else if ("DIV" == b && $(a).is(".check-box")) {
            if (!$("[type=checkbox]:checked", a).length) return !1
        } else if ("INPUT" == b || "TEXTAREA" == b) if ("undefined" == typeof c || "" == c) {
            if ("" == d) return !1
        } else if (a = c.match(/^\/(.*?)\/([gim]*)$/), !(a ? new RegExp(a[1], a[2]) : new RegExp(c)).test(d)) return !1;
    }
    return !0
}

function registerValidForm(a) {
    // Xử lý các trình soạn thảo
 
    $(".has-error", a).removeClass("has-error");
    var d = 0,
        c = [];
    $(a).find("input.required.required.required,div.required").each(function() {
        var b = $(this).prop("tagName");
        "INPUT" != b && "TEXTAREA" != b || "password" == $(a).prop("type") || "radio" == $(a).prop("type") || "checkbox" == $(a).prop("type") || $(this).val(trim(strip_tags($(this).val())));
        if (!validCheck(this)) return d++, $(".tooltip-current", a).removeClass("tooltip-current"), $(this).addClass("tooltip-current").attr("data-current-mess", $(this).attr("data-mess")), validErrorShow(this), !1
    });
    d || (c.type = $(a).prop("method"), c.url = $(a).prop("action"), c.data = $(a).serialize(), formErrorHidden(a), $(a).find("input,button,select,textarea").prop("disabled", !0), $.ajax({
        type: c.type,
        cache: !1,
        url: c.url,
        data: c.data,
        dataType: "json",
        success: function(b) {
            var c = $("[onclick*='change_captcha']", a);
            c && c.click();
            "error" == b.status ? ($("input,button,select", a).prop("disabled", !1), $(".tooltip-current", a).removeClass("tooltip-current"), "" != b.input ? $(a).find("[name=\"" + b.input + "\"]").each(function() {
                $(this).addClass("tooltip-current").attr("data-current-mess", b.mess);
                validErrorShow(this)
            }) : ($(".nv-info", a).html(b.mess).addClass("error").show(), $("html, body").animate({
                scrollTop: $(".nv-info", a).offset().top
            }, 800)), (nv_is_recaptcha && change_captcha())) : ($(".nv-info", a).html(b.mess + '<span class="load-bar"></span>').removeClass("error").addClass("success").show(), ("ok" == b.input ? setTimeout(function() {
                $(".nv-info", a).fadeOut();
                $("input,button,select", a).prop("disabled", !1);
                $("[onclick*=validReset]", a).click()
            }, 6E3) : $("html, body").animate({
                scrollTop: $(".nv-info", a).offset().top
            }, 800, function() {
                $(".form-detail", a).hide();
                setTimeout(function() {
					window.location.href = window.location.href;
                }, 6E3)
            })))
        },
        error: function (xhr, opt, err) {
            if (window.console.log) {
                console.log(xhr.status + ': ' + err);
            } else {
                alert(xhr.status + ': ' + err);
            }
        }
    }));
    return !1
}


</script>
<!-- END: main -->

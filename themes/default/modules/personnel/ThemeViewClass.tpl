<!-- BEGIN: main -->
<div class="BoxGroupExam">
	<!-- BEGIN: category -->
	<div class="GroupExam">
		<ul class="list-inline">
			<li><h2><a href="{CATEGORY.link}" title="{CATEGORY.title}">{CATEGORY.title}</a></h2></li>
			<!-- BEGIN: subcatloop -->
			<li class="hidden-xs"><h4><a title="{SUBGROUP.title}" href="{SUBGROUP.link}">{SUBGROUP.title}</a></h4></li>
			<!-- END: subcatloop -->
			<!-- BEGIN: subcatmore -->
			<a class="dimgray pull-right hidden-xs" title="{MORE.title}" href="{MORE.link}"><em class="fa fa-sign-out">&nbsp;</em></a>
			<!-- END: subcatmore -->
		</ul>
		<div class="boxexam">
			<!-- BEGIN: loop -->
			<div class="col-md-6 col-sm-12 fixed">
				<div class="grb">
					<div class="gri"><a href="{LOOP.link}" title="{LOOP.title}"><img alt="{LOOP.title}" src="{LOOP.image}"></a></div>
					<div class="grt">
						<a href="{LOOP.link}" title="{LOOP.title}">{LOOP.title_cut}</a>
						<div class="infoex">
							<p>{LANG.class_numberlearn}: {LOOP.numberlearn} {LANG.class_numberlearn_note}</p>
							<p class="price">{LANG.item_price}: {LOOP.price}</p>
						</div>
					</div>
				</div>
			</div>
			<!-- END: loop -->
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- END: category -->
	 
</div>

<!-- END: main -->

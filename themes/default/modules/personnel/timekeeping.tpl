<!-- BEGIN: main -->

    <div class="col-12">       
		<div class="card">
            <div class="card-header">
                <h3 class="float-left card-title d62f2f">{DATA.header_title}</h3>
                <div class="float-right toolaction">
                    <a href="#" data-toggle="tooltip" title="Import nhân sự Excel"><i class="fas fa-file-upload"> </i><span>Nhập<span></a>
                    <a href="#" data-toggle="tooltip" title="Cài đặt"><i class="fas fa-cog"> </i><span>Cài đặt<span></a>
                </div>
            </div>
		
            <div id="nav-tab" class="nav nav-tabs" role="tablist">
                <a class="nav-item nav-link active" href="#tab-table1" data-tab="1" data-toggle="tab">Chấm công của tôi</a>
                <a class="nav-item nav-link timekeeping-table" href="#tab-table2" data-tab="2" data-toggle="tab">Bảng chấm công tuần</a>
                <a class="nav-item nav-link" href="#tab-table5" data-tab="5" data-toggle="tab">Lịch trình của tôi</a>
				<!-- BEGIN: admin -->
                <a class="nav-item nav-link" href="#tab-table3" data-tab="3" data-toggle="tab">Chấm công toàn nhân viên</a>
                <a class="nav-item nav-link" href="#tab-table4" data-tab="4" data-toggle="tab">Báo biểu chấm công</a>
				<!-- END: admin -->
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-table1">
                    <div class="card-body">
                        <div class="row">
							<div class="oxd-layout-context" data-v-130c27f5="">
								<div class="oxd-table-filter" data-v-b4b62742="" data-v-50a2ff8a="">
									<div class="oxd-table-filter-header" data-v-b4b62742="">
										<div class="oxd-table-filter-header-title" data-v-b4b62742="">
											<h5 class="oxd-text oxd-text--h5 oxd-table-filter-title" data-v-7b563373="" data-v-b4b62742="">Bảng chấm công của tôi</h5>
										</div>
										<div class="oxd-table-filter-header-options" data-v-b4b62742="">
											<div class="--toggle" data-v-b4b62742="">
											</div>
											<div class="--export" data-v-b4b62742="">
											</div>
											<div class="--toggle" data-v-b4b62742="">
												<button class="oxd-icon-button" type="button" data-v-f5c763eb="" data-v-b4b62742="">
												<i class="oxd-icon bi-caret-up-fill" data-v-bddebfba="" data-v-f5c763eb=""></i>
												</button>
											</div>
										</div>
									</div>
									<hr class="oxd-divider" role="separator" aria-orientation="horizontal" data-v-9f847659="" data-v-b4b62742="" style="">
									<div class="oxd-table-filter-area" data-v-b4b62742="" style="">
										<form class="oxd-form" novalidate="" data-v-d5bfe35b="" data-v-50a2ff8a="" id="timekeeping">
											<div class="oxd-form-row" data-v-2130bd2a="" data-v-50a2ff8a="">
												<div class="oxd-grid-4 orangehrm-full-width-grid" data-v-d7b71de4="" data-v-50a2ff8a="">
													<div class="oxd-grid-item oxd-grid-item--gutters" data-v-c93bdbf3="" data-v-50a2ff8a="">
														<div class="oxd-input-group oxd-input-field-bottom-space" data-v-957b4417="" data-v-50a2ff8a="">
															<div class="oxd-input-group__label-wrapper" data-v-957b4417="">
																<label class="oxd-label oxd-input-field-required" data-v-30ff22b1="" data-v-957b4417="">Ngày</label>
															</div>
															<div class="" data-v-957b4417="">
																<div class="oxd-date-wrapper" data-v-4a95a2e0="">
																	<div class="oxd-date-input" data-v-4a95a2e0="">
																		<input id="date_timekeeping" name="date_timekeeping" class="oxd-input oxd-input--active datepicker" placeholder="{DATE_TIMEKEEPING}" value="{DATE_TIMEKEEPING}" data-v-1f99f73c="" data-v-4a95a2e0="">
																			
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<hr class="oxd-divider" role="separator" aria-orientation="horizontal" data-v-9f847659="" data-v-50a2ff8a="">
											<div class="oxd-form-actions" data-v-19c2496b="" data-v-50a2ff8a="">
												<p class="oxd-text oxd-text--p orangehrm-form-hint" data-v-7b563373="" data-v-319fc346="" data-v-50a2ff8a=""> * Yêu cầu</p>
												<button type="submit" class="oxd-button oxd-button--medium oxd-button--secondary" id="mytimekeeping-submit" data-v-10d463b7="" data-v-50a2ff8a=""> Xem </button>
											</div>
										</form>
									</div>
								</div>
								<br data-v-50a2ff8a="">
								<div class="orangehrm-paper-container" data-v-50a2ff8a="">
									<div class="orangehrm-header-container" data-v-50a2ff8a="">
										<span class="oxd-text oxd-text--span orangehrm-header-total" data-v-7b563373="" data-v-50a2ff8a="">Total Duration (Hours): <span class="total_duration" >  </span></span>
									</div>
									<div data-v-0dea79bd="" data-v-50a2ff8a="">
										<hr class="oxd-divider orangehrm-horizontal-margin" role="separator" aria-orientation="horizontal" data-v-9f847659="" data-v-0dea79bd="">
										<div class="orangehrm-horizontal-padding orangehrm-vertical-padding" data-v-0dea79bd="">
											<span class="oxd-text oxd-text--span" data-v-7b563373="" data-v-0dea79bd=""> (<span class="records"> </span>) Records Found</span>
										</div>
									</div>
									<div class="orangehrm-container" data-v-50a2ff8a="">
										<div class="oxd-table orangehrm-my-attendance" role="table" row-decorator="oxd-table-decorator-card" data-v-50a2ff8a="">
											<div class="oxd-table-header" role="rowgroup" data-v-f9688068="" data-v-2f1b665b="">
												<div class="oxd-table-row oxd-table-row--with-border" role="row" data-v-0d5ef602="" data-v-2f1b665b="">
													<div class="oxd-table-header-cell oxd-padding-cell oxd-table-th" role="columnheader" data-v-ff19d791="" data-v-2f1b665b="" style="flex: 1 1 0%;">Đăng nhập
													</div>
													<div class="oxd-table-header-cell oxd-padding-cell oxd-table-th" role="columnheader" data-v-ff19d791="" data-v-2f1b665b="" style="flex: 1 1 0%;">Ghi chú khi đăng nhập
													</div>
													<div class="oxd-table-header-cell oxd-padding-cell oxd-table-th" role="columnheader" data-v-ff19d791="" data-v-2f1b665b="" style="flex: 1 1 0%;">Đăng xuất
													</div>
													<div class="oxd-table-header-cell oxd-padding-cell oxd-table-th" role="columnheader" data-v-ff19d791="" data-v-2f1b665b="" style="flex: 1 1 0%;">Ghi chú khi đăng xuất
													</div>
													<div class="oxd-table-header-cell oxd-padding-cell oxd-table-th" role="columnheader" data-v-ff19d791="" data-v-2f1b665b="" style="flex: 1 1 0%;">Thời gian (giờ)
													</div>
													<div class="oxd-table-header-cell oxd-padding-cell oxd-table-th" role="columnheader" data-v-ff19d791="" data-v-2f1b665b="">
												</div>
											</div>
										</div>
										<div class="oxd-table-body" role="rowgroup" data-v-8bca8bf7="" data-v-f2168256="">
											
											
											
										</div>
									</div>
								</div>
								<div class="orangehrm-bottom-container" data-v-50a2ff8a="">
								</div>
							</div>
						</div>
								 
                             
                            
                        </div>
						
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table5">
                    <div class="card-body">
                        <<div class="">
                            <div class="oxd-layout-context" data-v-130c27f5="">
								<div class="orangehrm-background-container">
									
										<div class="orangehrm-timesheet-header" data-v-425cbc6c="">
											<div class="orangehrm-timesheet-header--title" data-v-425cbc6c="">
												<h6 class="oxd-text oxd-text--h6 orangehrm-main-title" data-v-7b563373="">Bảng chấm công trong tuần này</h6>
											</div>
											
										</div>
										<div class="orangehrm-timesheet-body" data-v-425cbc6c="">
											<table class="orangehrm-timesheet-table" data-v-425cbc6c="">
												<thead class="orangehrm-timesheet-table-header" data-v-425cbc6c="">
													<tr class="orangehrm-timesheet-table-header-row" data-v-425cbc6c="">
														<!-- BEGIN: time_weeks -->
														<th class="orangehrm-timesheet-table-header-cell --center" data-v-425cbc6c="">
															<span class="--day" data-v-425cbc6c="">{DATE.date}</span><span data-v-425cbc6c="">{DATE.datename}</span>
														</th>
														<!-- END: time_weeks -->
																											</tr>
												</thead>
												<tbody class="orangehrm-timesheet-table-body" data-v-425cbc6c="">
													<tr class="orangehrm-timesheet-table-body-row" data-v-425cbc6c="">
														<!-- BEGIN: schedule_week_look -->
														<td class="orangehrm-timesheet-table-body-cell --center" data-v-425cbc6c="">
															<button class="oxd-icon-button oxd-icon-button--secondary orangehrm-timesheet-icon-comment" type="button" data-v-f5c763eb="" data-v-425cbc6c="" style="display: none;">
																<i class="oxd-icon bi-chat-dots" data-v-bddebfba="" data-v-f5c763eb=""></i>
															</button>
															<!-- BEGIN: sloop -->
															<span data-v-425cbc6c="">{SCHEDULE.unit} </span> <br>
															<!-- END: sloop -->
														</td>
														<!-- END: schedule_week_look -->
														
													</tr>

												</tbody>
											</table>
										</div>
										
									
									<br>
								</div>
							</div>
                            
                        </div>
						
                    </div>
                </div>
				<div class="tab-pane fade" id="tab-table2">
					<div class="card-body">
                        <div class="">
                            <div class="oxd-layout-context" data-v-130c27f5="">
								<div class="orangehrm-background-container">
									
										<div class="orangehrm-timesheet-header" data-v-425cbc6c="">
											<div class="orangehrm-timesheet-header--title" data-v-425cbc6c="">
												<h6 class="oxd-text oxd-text--h6 orangehrm-main-title" data-v-7b563373="">Bảng chấm công trong tuần này</h6>
											</div>
											
										</div>
										<div class="orangehrm-timesheet-body timekeeping-tab-table2" data-v-425cbc6c="">
										</div>
										
									
									<br>
								</div>
							</div>
                            
                        </div>
						
                    </div>	
                    
                </div>
				<!-- BEGIN: admin_tab -->
                <div class="tab-pane fade" id="tab-table3">
                    <div class="card-body">
                        <div class="row">
							<div class="oxd-layout-context" data-v-130c27f5="" style="width: 100%;">
								<div class="oxd-table-filter" data-v-b4b62742="" data-v-50a2ff8a="">
									<div class="oxd-table-filter-header" data-v-b4b62742="">
										<div class="oxd-table-filter-header-title" data-v-b4b62742="">
											<h5 class="oxd-text oxd-text--h5 oxd-table-filter-title" data-v-7b563373="" data-v-b4b62742="">Bảng chấm công của nhân viên</h5>
										</div>
										<div class="oxd-table-filter-header-options" data-v-b4b62742="">
											<div class="--toggle" data-v-b4b62742="">
											</div>
											<div class="--export" data-v-b4b62742="">
											</div>
											<div class="--toggle" data-v-b4b62742="">
												<button class="oxd-icon-button" type="button" data-v-f5c763eb="" data-v-b4b62742="">
												<i class="oxd-icon bi-caret-up-fill" data-v-bddebfba="" data-v-f5c763eb=""></i>
												</button>
											</div>
										</div>
									</div>
									<hr class="oxd-divider" role="separator" aria-orientation="horizontal" data-v-9f847659="" data-v-b4b62742="" style="">
									<div class="oxd-table-filter-area" data-v-b4b62742="" style="">
										<form class="oxd-form" novalidate="" data-v-d5bfe35b="" data-v-50a2ff8a="" id="userstimekeeping">
											<div class="oxd-form-row" data-v-2130bd2a="" data-v-50a2ff8a="">
												<div class="oxd-grid-4 orangehrm-full-width-grid" data-v-d7b71de4="" data-v-50a2ff8a="">
													<div class="oxd-grid-item oxd-grid-item--gutters" data-v-c93bdbf3="" data-v-50a2ff8a="">
														<div class="oxd-input-group oxd-input-field-bottom-space" data-v-957b4417="" data-v-50a2ff8a="">
															<div class="oxd-input-group__label-wrapper" data-v-957b4417="">
																<label class="oxd-label oxd-input-field-required" data-v-30ff22b1="" data-v-957b4417="">Tên nhân viên</label>
															</div>
															<div class="" data-v-957b4417="">
																<div class="oxd-date-wrapper" data-v-4a95a2e0="">
																	<div class="oxd-date-input" data-v-4a95a2e0="">
																	
																	
																	
																	
																		<select id="users_timekeeping" name="users_timekeeping"  placeholder="{DATE_TIMEKEEPING}" class="oxd-select-text oxd-select-text">
																			<!-- BEGIN:users_timekeeping -->
																				<option value="{USER_EMPLOYER.userid}" > {USER_EMPLOYER.username} </option>
																			<!-- END:users_timekeeping -->
																		</select>
																	</div>
																</div>
															</div>
															<div class="oxd-input-group__label-wrapper" data-v-957b4417="">
																<label class="oxd-label oxd-input-field-required" data-v-30ff22b1="" data-v-957b4417="">Ngày bắt đầu</label>
															</div>
															<div class="" data-v-957b4417="">
																<div class="oxd-date-wrapper" data-v-4a95a2e0="">
																	<div class="oxd-date-input" data-v-4a95a2e0="">
																		<input id="date_begin_timekeeping" name="date_begin_timekeeping" class="oxd-input oxd-input--active datepicker" placeholder="{DATE_TIMEKEEPING}" value="{DATE_TIMEKEEPING}" data-v-1f99f73c="" data-v-4a95a2e0="">
																			
																	</div>
																</div>
															</div>
															<div class="oxd-input-group__label-wrapper" data-v-957b4417="">
																<label class="oxd-label oxd-input-field-required" data-v-30ff22b1="" data-v-957b4417="">Ngày kết thúc</label>
															</div>
															<div class="" data-v-957b4417="">
																<div class="oxd-date-wrapper" data-v-4a95a2e0="">
																	<div class="oxd-date-input" data-v-4a95a2e0="">
																		<input id="date_end_timekeeping" name="date_end_timekeeping" class="oxd-input oxd-input--active datepicker" placeholder="{DATE_TIMEKEEPING}" value="{DATE_TIMEKEEPING}" data-v-1f99f73c="" data-v-4a95a2e0="">
																			
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<hr class="oxd-divider" role="separator" aria-orientation="horizontal" data-v-9f847659="" data-v-50a2ff8a="">
											<div class="oxd-form-actions" data-v-19c2496b="" data-v-50a2ff8a="">
												<p class="oxd-text oxd-text--p orangehrm-form-hint" data-v-7b563373="" data-v-319fc346="" data-v-50a2ff8a=""> * Yêu cầu</p>
												<button type="submit" class="oxd-button oxd-button--medium oxd-button--secondary" data-v-10d463b7="" data-v-50a2ff8a=""> Xem </button>
											</div>
										</form>
									</div>
								</div>
								<br data-v-userstimekeeping="">
								
							</div>
								 
                             
                            
                        </div>
							
                    </div>
                </div>
 
                <div class="tab-pane fade" id="tab-table4">
                    <div class="card-body">
						
					 </div>
                </div>
				<!-- END: admin_tab -->
 
            
				
			</div>
		</div>
	</div>
<!-- Daterange picker -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/select2/js/select2.full.min.js"></script>


<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={GOGGLEMAP_API}&callback=initMap" async defer></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript">
 
                         
                               
function AddDatepicker(selector){
	$(selector).datepicker({   
		showOn : "both",       
		dateFormat : "dd/mm/yy",
		changeMonth : true,    
		changeYear : true,     
		showOtherMonths : true,
		buttonText: '',
		buttonImage : "",      
		buttonImageOnly : false,
		yearRange: "-100:+0",  
	});                        
}                              
                               
function AddDatepicker2(selector){
	$(selector).datepicker({   
		viewMode: 'year',      
		format: 'mm-yyyy',     
		showOn : "both",       
		dateFormat : "mm/yy",  
		changeMonth : true,    
		changeYear : true,     
		showOtherMonths : true,
		buttonText: '',
		buttonImage : "",      
		buttonImageOnly : false
	});                        
}                              
 function show_view_in(date_login,locationid,location,address,image_file,note,lat,lng,ipaddress){
		var mess = '';
		var formattedTime = moment.unix(date_login).utcOffset(7).format('H:mm:ss');
		mess += '<div>' + 
					'<div>' +
						
					'</div>'+
					'<div id="map" style="height: 800px;"></div>' +
				'</div>'+
				'<script src="https://maps.googleapis.com/maps/api/js?key={GOGGLEMAP_API}&callback=initMap" async defer><\/script>' +
				'<script>' +
				  'var map;' +
				  'function initMap() {' +
					'map = new google.maps.Map(document.getElementById(\'map\'), {' +
					  'center: {lat: 0, lng: 0},' +
					  'zoom: 8' +
					'});' +
					'var pos = {' +
					  'lat: ' + lat + ',' +
					  'lng: ' + lng + 
					'};' +
					'var marker = new google.maps.Marker({' +
					  'position: pos,' +
					  'map: map,' +
					  'icon: "",' +
						'draggable: false,' +
					 ' title: \'' + location + '\'' +
					'});' +
					'var imageInfoWindow = new google.maps.InfoWindow({' + 
						'content: "<div style=\'max-width: 200px; max-height: 500px;\'><img src=\'{NV_BASE_SITEURL}uploads/personnel/timekeeper/capture/' + image_file + '\' style=\'width: 100%; height: auto;\'></div>' +
						'<div > Vào ca lúc : ' + formattedTime + '</div>' +
						'<div > Vào ca tại : ' + address + '</div>' +
						'<div > Ghi chú : ' + note + '</div>' +
						'", ' +
					  '});' +
					  'marker.addListener("click", function () {' +
						'imageInfoWindow.open(map, marker);' +
					  '});' +
					'map.setCenter(pos);' +
					'map.setZoom(15);' +
				  '}' +
				'<\/script>';
				
				
		$('#sitemodal').find('.modal-dialog').addClass('h-100 my-0 mx-auto d-flex flex-column justify-content-center');
		$('#sitemodal').modal().find('.modal-body').html(mess);
	}                          
 function show_view_out(date_login,locationid,location,address,image_file,note,lat,lng,ipaddress){
		var mess = '';
		var formattedTime = moment.unix(date_login).utcOffset(7).format('H:mm:ss');
		mess += '<div>' + 
					'<div>' +
						
					'</div>'+
					'<div id="map" style="height: 800px;"></div>' +
				'</div>'+
				'<script src="https://maps.googleapis.com/maps/api/js?key={GOGGLEMAP_API}&callback=initMap" async defer><\/script>' +
				'<script>' +
				  'var map;' +
				  'function initMap() {' +
					'map = new google.maps.Map(document.getElementById(\'map\'), {' +
					  'center: {lat: 0, lng: 0},' +
					  'zoom: 8' +
					'});' +
					'var pos = {' +
					  'lat: ' + lat + ',' +
					  'lng: ' + lng + 
					'};' +
					'var marker = new google.maps.Marker({' +
					  'position: pos,' +
					  'map: map,' +
					  'icon: "",' +
						'draggable: false,' +
					 ' title: \'' + location + '\'' +
					'});' +
					'var imageInfoWindow = new google.maps.InfoWindow({' + 
						'content: "<div style=\'max-width: 200px; max-height: 500px;\'><img src=\'{NV_BASE_SITEURL}uploads/personnel/timekeeper/capture/' + image_file + '\' style=\'width: 100%; height: auto;\'></div>' +
						'<div > Ra ca lúc : ' + formattedTime + '</div>' +
						'<div > Ra ca tại : ' + address + '</div>' +
						'<div > Ghi chú : ' + note + '</div>' +
						'", ' +
					  '});' +
					  'marker.addListener("click", function () {' +
						'imageInfoWindow.open(map, marker);' +
					  '});' +
					'map.setCenter(pos);' +
					'map.setZoom(15);' +
				  '}' +
				'<\/script>';
				
				
		$('#sitemodal').find('.modal-dialog').addClass('h-100 my-0 mx-auto d-flex flex-column justify-content-center');
		$('#sitemodal').modal().find('.modal-body').html(mess);
	} 
$(function () {                
	               AddDatepicker('.datepicker');            

	              
                 
	setTimeout(function(){     
	                           
	                           
		function formatResult(node) {
                               
			$xt = '';          
			if (node.element !== undefined) {
				lev = node.element.getAttribute("lev");
				if( lev > 0 )  
				{              
					$xt+= '<span style="opacity:0.3;font-weight:bolder">';
					$xt+= '&nbsp;';
					for( $i = 1; $i <= lev; $i++ )
					{          
						$xt+= '-';
					}          
					$xt+= '</span>';
					$xt+= '&nbsp;';
				}              
				               
			}                  
			$xt+= node.text;   
			return $('<span>' + $xt + '</span>');
		};                     
		function formatSelect(node) {
			return node.text;  
		};                     
                  
		                
                               
	$(document).on('focusout', '.money', function(){
		price = $(this).val().replace(/[^0-9.]/g, '');
		id = $(this).attr('data');
		console.log(price);    
		$('.salaryc'+ id).val( ( price * globalData['salaryPremiumBase']['c'] )/100 ).price_format();
		$('.salaryp'+ id).val( ( price * globalData['salaryPremiumBase']['p'] )/100 ).price_format();
	})                         
	                           
	$('.select2').select2({    
		searchInputPlaceholder: 'Tìm kiếm...', 
		language : '{NV_LANG_DATA}'
	}).on('select2:open', function(e){
		$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
	});                        
	                       
	                           
	$('input[type="text"]').on('keyup', function(){
		if( $(this).val().length > 3 )
		{                      
			$(this).next('.text-danger').remove();
			$(this).parent().removeClass('has-error');
			$(this).tooltip('dispose');
		}                      
	                           
	})                         
	                           
	function has_error( obj )  
	{                          
		var element = obj.parent();				
		if (element.hasClass('form-group')) { element.addClass('has-error') }
		obj.addClass('tooltip-current');
		$('.tooltip-current').tooltip({'title': obj.attr('data-error')});
		$('.tooltip-current').tooltip('show');
	}                          
                               
   
	
	$( 'body' ).on('focus', '#timekeeping input, #timekeeping select', function() {
		obj = $(this);         
		setTimeout(function(){ 
			obj.tooltip('hide');
		}, 500);	           
	})                         
	                           
	$("#timekeeping").on('submit', function(e) {
		e.preventDefault();    
		$.ajax({               
			type: "POST",      
			dataType: 'json',  
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=timekeeping&action=timekeeping&second=' + new Date().getTime(),
			data: $('#timekeeping').serialize(),
			beforeSend: function() {
				<!-- $('#registerForm').css('opacity', '0.7'); -->
				$('#submitreg').prop('disabled', true);
				$('.message').remove();
				$('.text-danger').remove();
				$('.has-error').removeClass('has-error');
				$('.tab-content').after('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
			},	               
			complete: function() {
				<!-- $('#registerForm').css('opacity', 1); -->
				$('#submitreg').prop('disabled', false);
				$('div[class="tooltip fade top in"]').remove();
				 $('.overlay').remove();
			},                 
			success: function(json) {
				if( json['success'] )
				{     
					var mess = '';
				$('.oxd-table-body').html('');
				console.log(mess);				
				    $.each(json['data'],function(key,data){
					
						mess += '<div class="oxd-table-card" data-v-f2168256="">'+
												'<div class="oxd-table-row oxd-table-row--with-border" role="row" data-v-0d5ef602="" data-v-f2168256="">'+
													'<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">'+
														'<div class="oxd-table-card-cell" item="[object Object]" rowitem="[object Object]" data-v-8f3074ce="">'+
															'<div class="header" data-v-8f3074ce="" style="display: none;">Check in</div>'+
															'<div class="data" data-v-8f3074ce="">'+
															'<p class="oxd-text oxd-text--p" data-v-7b563373="" data-v-8f3074ce=""> '+
															data['time_login'] + '<a href="javascript:void(0);" onclick="show_view_in( ' + data['date_login'] + ',' + data['locationid'] + ',\'' + data['location'] + '\',\'' + data['address'] + '\',\'' + data['image_file'] + '\',\'' + data['note'] + '\',' + data['lat'] + ',' + data['lng'] + ',\'' + data['ip'] + '\')" <span> xem chi tiết </span> </a>' +
															'</p>'+
															'<p class="oxd-text oxd-text--p" data-v-7b563373="" data-v-8f3074ce=""> '+
																data['location'] +
															'</p>'+
															'</div>'+
														'</div>'+
													'</div>'+
													'<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">'+
														'<div class="oxd-table-card-cell" data-v-ed6b0c3f="" >'+
															'<span class="oxd-text oxd-text--span" data-v-7b563373="" data-v-ed6b0c3f="">' + data['note'] +  '</span>'+
														'</div>'+
													'</div>'+
													'<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">'+
														'<div class="oxd-table-card-cell" item="[object Object]" rowitem="[object Object]" data-v-8f3074ce="">'+
															'<div class="header" data-v-8f3074ce="" style="display: none;">Đăng xuất</div>'+
															'<div class="data" data-v-8f3074ce="">'+
																'<p class="oxd-text oxd-text--p" data-v-7b563373="" data-v-8f3074ce="">'+
																data['time_checkout'] + '<a href="javascript:void(0);" onclick="show_view_out( ' + data['date_checkout'] + ',' + data['locationid_checkout'] + ',\'' + data['location_checkout'] + '\',\'' + data['address_checkout'] + '\',\'' + data['image_checkout'] + '\',\'' + data['note_checkout'] + '\',' + data['lat_checkout'] + ',' + data['lng_checkout'] + ',\'' + data['ip_checkout'] + '\')" <span> xem chi tiết </span> </a>' +
																'</p>'+
																'<p class="oxd-text oxd-text--p" data-v-7b563373="" data-v-8f3074ce=""> '+
																data['location_checkout'] +
															'</p>'+
															'</div>'+
														'</div>'+
													'</div>'+
													'<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">'+
														'<div class="oxd-table-card-cell" data-v-ed6b0c3f="" >'+
															'<span class="oxd-text oxd-text--span" data-v-7b563373="" data-v-ed6b0c3f="">' + data['note_checkout'] +  '</span>'+
														'</div>'+
													'</div>'+
													'<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">'+
														'<div data-v-6c07a142="">' + data['time_duration'] + '</div>'+
													'</div>'+
													'<div class="oxd-table-cell oxd-padding-cell" role="cell">'+
														'<div data-v-6c07a142=""></div>'+
													'</div>'+
												'</div>'+
											'</div>';
											
					
					});           
					$('.oxd-table-body').html(mess);
					$('.total_duration').html(json['total_duration']);
					$('.records').html(json['records_found']);
					
					
					
				}              
				else if( json['error'] )
				{              
					           
					var mess = ''+
					'<div class="modal-headerx">'+
					'<h5 class="modal-title" >Thông báo</h5>'+
					'</div>';  
					 $(json['error']).each(function(i, item){
						       
						var obj = $('#' + item.input);
						obj.attr('data-error', item.mess);
						obj.parent().addClass('has-error');
						obj.addClass('tooltip-current');
						$('.tooltip-current').tooltip({'title': obj.attr('data-error')});
						mess+= '<div class="alert-danger"><i class="fa fa-exclamation-circle"></i> ' + item.mess + '</div>';
					});        
					$('#sitemodal').find('.modal-dialog').addClass('h-100 my-0 mx-auto d-flex flex-column justify-content-center');
					$('#sitemodal').modal().find('.modal-body').html(mess);
				}              
				setTimeout(function(){$('.message').slideUp(1000).remove()}, 1000)	
			},                 
			error: function(xhr, ajaxOptions, thrownError) {
				 $('.overlay').remove();
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}                  
		});                    
	}); 

	
	$("#userstimekeeping").on('submit', function(e) {
		e.preventDefault();    
		$.ajax({               
			type: "POST",      
			dataType: 'json',  
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=timekeeping&action=userstimekeeping&second=' + new Date().getTime(),
			data: $('#userstimekeeping').serialize(),
			beforeSend: function() {
				<!-- $('#registerForm').css('opacity', '0.7'); -->
				$('#submitreg').prop('disabled', true);
				$('.message').remove();
				$('.text-danger').remove();
				$('.has-error').removeClass('has-error');
				$('.tab-content').after('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>');
			},	               
			complete: function() {
				<!-- $('#registerForm').css('opacity', 1); -->
				$('#submitreg').prop('disabled', false);
				$('div[class="tooltip fade top in"]').remove();
				 $('.overlay').remove();
			},                 
			success: function(json) {
				if( json['success'] )
				{     
					var mess = '';
				$('.userstimekeeping-body').html('');
						mess += '<div  data-v-32e798aa="">' +
									'<div  data-v-32e798aa="">' +
										
										
											'<div class="main-viewport">' +
												'<div class="viewports">' +
													
														'<div  >' +
															
															'<div >' +
																'<table style="width: 100%;">';
																	mess +='<tr>';

					
																		mess +='<td  >' +
																					'Ngày chấm công' +
																				'<//td>' +
																				'<td >';
																					
																						
																						mess +='Thời gian vào ca - ra ca';
																					
																		mess +='</td>' +
																				'<td >' +
																					'Tổng thời gian làm việc trong ngày' +
																				'</td>';
	
																				
																	mess +='</tr>';
																	mess +='';
																			$.each(json['data'],function(key,data){
					
																		mess +='<tr><td>' +
																					key +
																				'</td>' +
																				'<td>';
																					$.each(data['data'],function(key,data_time){
																						mess += '<p> ' + data_time['time_login'] + '<a href="javascript:void(0);" onclick="show_view_in( ' + data_time['date_login'] + ',' + data_time['locationid'] + ',\'' + data_time['location'] + '\',\'' + data_time['address'] + '\',\'' + data_time['image_file'] + '\',\'' + data_time['note'] + '\',' + data_time['lat'] + ',' + data_time['lng'] + ',\'' + data_time['ip'] + '\')" <span> xem chi tiết </span> </a>';
																						if(data_time['time_checkout'] != null){
																							mess += ' - ' + data_time['time_checkout'] + '<a href="javascript:void(0);" onclick="show_view_out( ' + data_time['date_checkout'] + ',' + data_time['locationid_checkout'] + ',\'' + data_time['location_checkout'] + '\',\'' + data_time['address_checkout'] + '\',\'' + data_time['image_checkout'] + '\',\'' + data_time['note_checkout'] + '\',' + data_time['lat_checkout'] + ',' + data_time['lng_checkout'] + ',\'' + data_time['ip_checkout'] + '\')" <span> xem chi tiết </span> </a>';
																						}
																						mess +='</p>';
																					});
																		mess +='</td>' +
																				'<td>' +
																					'0' +
																				'</td></tr>';
																			});	
																				
																	mess +='' +
																		
																	
																'</table>' +
															'</div>' +
															'<div class="footer-wrapper">' +
																
															'</div>' +
														'</div>' +
													
													'<div class="draggable-wrapper hidden">' +
														'<div class="draggable">' +
															'<span class="revo-alt-icon">' +
															'</span>' +
															'<span>' +
															'</span>' +
														'</div>' +
														'<div class="drag-position">' +
														'</div>' +
													'</div>' +
												'</div>' +
											'</div>' +
											
										
										
									'</div>' +
								'</div>';
				     
					var brElement = document.querySelector('br[data-v-userstimekeeping]');

					// Kiểm tra nếu tìm thấy thẻ <br>
					if (brElement) {
						var elementToRemove = brElement.nextSibling;

					  // Loại bỏ phần tử HTML
					  if (elementToRemove) {
						elementToRemove.parentNode.removeChild(elementToRemove);
					  }
					  // Tạo đối tượng HTML mới
					  var newElement = document.createElement('div');
					  newElement.innerHTML = mess; // Thêm nội dung HTML mới tại đây
					
					  // Chèn đối tượng HTML mới vào sau thẻ <br>
					  brElement.parentNode.insertBefore(newElement, brElement.nextSibling);
					}					
					//$('.userstimekeeping-body').html(mess);
					//$('.total_duration').html(json['total_duration']);
					//$('.records').html(json['records_found']);
					
					
					
				}              
				else if( json['error'] )
				{              
					           
					var mess = ''+
					'<div class="modal-headerx">'+
					'<h5 class="modal-title" >Thông báo</h5>'+
					'</div>';  
					 $(json['error']).each(function(i, item){
						       
						var obj = $('#' + item.input);
						obj.attr('data-error', item.mess);
						obj.parent().addClass('has-error');
						obj.addClass('tooltip-current');
						$('.tooltip-current').tooltip({'title': obj.attr('data-error')});
						mess+= '<div class="alert-danger"><i class="fa fa-exclamation-circle"></i> ' + item.mess + '</div>';
					});        
					$('#sitemodal').find('.modal-dialog').addClass('h-100 my-0 mx-auto d-flex flex-column justify-content-center');
					$('#sitemodal').modal().find('.modal-body').html(mess);
				}              
				setTimeout(function(){$('.message').slideUp(1000).remove()}, 1000)	
			},                 
			error: function(xhr, ajaxOptions, thrownError) {
				 $('.overlay').remove();
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}                  
		});                    
	}); 


	
});  
});   
<!-- BEGIN:time_week_loop -->

$(document).ready(function() {
  // Lắng nghe sự kiện khi người dùng nhấp vào tab
  $('.timekeeping-table').click(function() {
    $('.timekeeping-tab-table2').ready(function() {
		// Gọi AJAX tới file timekeeping.php
		$.ajax({
		  url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=timekeeping&action=usersweektimekeeping&second=' + new Date().getTime(),
		  method: 'GET',
		  dataType: 'json', 
		  success: function(response) {
			if( response['success'] )
			{ 
				// Hiển thị nội dung trong bảng chấm công
				var html = '';
					html += '<table class="orangehrm-timesheet-table" data-v-425cbc6c=""> ' +
														'<thead class="orangehrm-timesheet-table-header" data-v-425cbc6c="">' +
															'<tr class="orangehrm-timesheet-table-header-row" data-v-425cbc6c="">';
															$.each(response['data'],function(key,data){
																html += '<th class="orangehrm-timesheet-table-header-cell --center" data-v-425cbc6c=""> ' +
																	'<span class="--day" data-v-425cbc6c="">' + data['date'] + '</span><span data-v-425cbc6c="">' + data['datename'] + '</span>' +
																'</th>';
															});	
													html += '</tr>' +
														'</thead> '+
														'<tbody class="orangehrm-timesheet-table-body" data-v-425cbc6c="">' +
															'<tr class="orangehrm-timesheet-table-body-row" data-v-425cbc6c="">';
													$.each(response['data'],function(key,data){
														
														html += '<td class="orangehrm-timesheet-table-body-cell --center" data-v-425cbc6c="">' +
																	'<button class="oxd-icon-button oxd-icon-button--secondary orangehrm-timesheet-icon-comment" type="button" data-v-f5c763eb="" data-v-425cbc6c="" style="display: none;">' +
																		'<i class="oxd-icon bi-chat-dots" data-v-bddebfba="" data-v-f5c763eb=""></i>' +
																	'</button>';
																	
															html += '<span data-v-425cbc6c="">';
															$.each(data['datetimekeeping'],function(keys,datas){
																html += '' + datas['time_login'] + ' - ' + datas['time_checkout'];
															});
															html += '</span> <br>';
																	
														html += '</td>';
																
													});			
													html += '</tr>' +

														'</tbody>' +
													'</table>';
				
				
				$('.timekeeping-tab-table2').html(html);
			}
		  },
		  error: function() {
			alert('Có lỗi xảy ra khi gọi AJAX.');
		  }
		});
	  });
  });
});

			
											<!-- END:time_week_loop --> 
											
											<!-- BEGIN:time_current_look -->
window.addEventListener('load', function() {
  document.getElementById('mytimekeeping-submit').click();
});
			
											<!-- END:time_current_look --> 



											
</script>                      
          
                               




    <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/chunk-vendors.css" rel="stylesheet">
  <link href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/app.css" rel="stylesheet">
 <style>
    :root {
            --oxd-primary-one-color:#FF7B1D;
            --oxd-primary-font-color:#FFFFFF;
            --oxd-secondary-four-color:#76BC21;
            --oxd-secondary-font-color:#FFFFFF;
            --oxd-primary-gradient-start-color:#FF920B;
            --oxd-primary-gradient-end-color:#F35C17;
            --oxd-secondary-gradient-start-color:#FF920B;
            --oxd-secondary-gradient-end-color:#F35C17;
            --oxd-primary-one-lighten-5-color:#ff8a37;
            --oxd-primary-one-lighten-30-color:#ffd4b6;
            --oxd-primary-one-darken-5-color:#ff6c03;
            --oxd-primary-one-alpha-10-color:rgba(255, 123, 29, 0.1);
            --oxd-primary-one-alpha-15-color:rgba(255, 123, 29, 0.15);
            --oxd-primary-one-alpha-20-color:rgba(255, 123, 29, 0.2);
            --oxd-primary-one-alpha-50-color:rgba(255, 123, 29, 0.5);
            --oxd-secondary-four-lighten-5-color:#84d225;
            --oxd-secondary-four-darken-5-color:#68a61d;
            --oxd-secondary-four-alpha-10-color:rgba(118, 188, 33, 0.1);
            --oxd-secondary-four-alpha-15-color:rgba(118, 188, 33, 0.15);
            --oxd-secondary-four-alpha-20-color:rgba(118, 188, 33, 0.2);
            --oxd-secondary-four-alpha-50-color:rgba(118, 188, 33, 0.5);
        }
  </style>


<!-- END: main -->


<table class="orangehrm-timesheet-table" data-v-425cbc6c="">
												<thead class="orangehrm-timesheet-table-header" data-v-425cbc6c="">
													<tr class="orangehrm-timesheet-table-header-row" data-v-425cbc6c="">
														<!-- BEGIN: time_week -->
														<th class="orangehrm-timesheet-table-header-cell --center" data-v-425cbc6c="">
															<span class="--day" data-v-425cbc6c="">{DATE.date}</span><span data-v-425cbc6c="">{DATE.datename}</span>
														</th>
														<!-- END: time_week -->
																											</tr>
												</thead>
												<tbody class="orangehrm-timesheet-table-body" data-v-425cbc6c="">
													<tr class="orangehrm-timesheet-table-body-row" data-v-425cbc6c="">
														<!-- BEGIN: time_week_look -->
														<td class="orangehrm-timesheet-table-body-cell --center" data-v-425cbc6c="">
															<button class="oxd-icon-button oxd-icon-button--secondary orangehrm-timesheet-icon-comment" type="button" data-v-f5c763eb="" data-v-425cbc6c="" style="display: none;">
																<i class="oxd-icon bi-chat-dots" data-v-bddebfba="" data-v-f5c763eb=""></i>
															</button>
															<!-- BEGIN: loop -->
															<span data-v-425cbc6c="">{TIMEKEEPING.time_login} - {TIMEKEEPING.time_checkout}</span> <br>
															<!-- END: loop -->
														</td>
														<!-- END: time_week_look -->
														
													</tr>

												</tbody>
											</table>
							









					'<div class="modal-headerx">'+
					'<h5 class="modal-title" >Thông báo</h5>'+
					'</div>';  
					mess+= '<div class="alert-success alert"><i class="fa fa-exclamation-circle"></i> ' + json['success'] + '</div>';
					<!-- BEGIN:add -->
					mess+= '<a class="btn btn-block btn-info btn-flat" href="javascript:location.reload();">Nhập tiếp</a>';
					<!-- END:add -->
					mess+= '<a class="btn btn-block btn-info btn-flat" href="{LIST_PERSOLNEL}">Tới danh sách</a>';
					           
					$('#sitemodal').find('.modal-dialog').addClass('h-100 my-0 mx-auto d-flex flex-column justify-content-center');
					$('#sitemodal').modal().find('.modal-body').html(mess);
				               
					<!-- $('#submitreg').after('<span class="message success">'+ json['success'] +'</span>').slideDown(1000); -->


<!-- BEGIN:time -->
											<div class="oxd-table-card" data-v-f2168256="">
												<div class="oxd-table-row oxd-table-row--with-border" role="row" data-v-0d5ef602="" data-v-f2168256="">
													<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">
														<div class="oxd-table-card-cell" item="[object Object]" rowitem="[object Object]" data-v-8f3074ce="">
															<div class="header" data-v-8f3074ce="" style="display: none;">Đăng nhập
															</div>
															<div class="data" data-v-8f3074ce="">
															<p class="oxd-text oxd-text--p" data-v-7b563373="" data-v-8f3074ce="">
															{TIMEKEEPING_CURRENT.time_login}
															</p>
															</div>
														</div>
													</div>
													<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">
														<div class="oxd-table-card-cell" data-v-ed6b0c3f="" style="display: none;">
															<span class="oxd-text oxd-text--span" data-v-7b563373="" data-v-ed6b0c3f=""></span>
														</div>
													</div>
													<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">
														<div class="oxd-table-card-cell" item="[object Object]" rowitem="[object Object]" data-v-8f3074ce="" style="display: none;">
															<div class="header" data-v-8f3074ce="" style="display: none;">Đăng xuất</div>
															<div class="data" data-v-8f3074ce="">
																<p class="oxd-text oxd-text--p" data-v-7b563373="" data-v-8f3074ce="">
																	{TIMEKEEPING_CURRENT.time_checkout}
																</p>
															</div>
														</div>
													</div>
													<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">
														<div class="oxd-table-card-cell" data-v-ed6b0c3f="" style="display: none;">
															<span class="oxd-text oxd-text--span" data-v-7b563373="" data-v-ed6b0c3f=""></span>
														</div>
													</div>
													<div class="oxd-table-cell oxd-padding-cell" role="cell" style="flex: 1 1 0%;">
														<div data-v-6c07a142="">0.00</div>
													</div>
													<div class="oxd-table-cell oxd-padding-cell" role="cell">
														<div data-v-6c07a142=""></div>
													</div>
												</div>
											</div>
											<!-- END:time -->
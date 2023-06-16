<!-- BEGIN: main -->
<form id="registerForm" class="row">
	<input name="personnel_id" value="{DATA.personnel_id}" type="hidden">
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
                <a class="nav-item nav-link active" href="#tab-table1" data-tab="1" data-toggle="tab">Thông tin chung</a>
                <a class="nav-item nav-link" href="#tab-table2" data-tab="2" data-toggle="tab">Hợp đồng</a>
                <a class="nav-item nav-link" href="#tab-table3" data-tab="3" data-toggle="tab">Bảo hiểm</a>
                <a class="nav-item nav-link" href="#tab-table4" data-tab="4" data-toggle="tab">Tiếp nhận</a>
                <a class="nav-item nav-link" href="#tab-table5" data-tab="5" data-toggle="tab">Thôi việc</a>
                <a class="nav-item nav-link" href="#tab-table6" data-tab="6" data-toggle="tab">Đính kèm({COUNT_ATTACHMENTS})</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-table1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Thông tin cá nhân</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body fixscrollbar">
										<div class="row">
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Chọn tài khoản đã có</label>
                                                    <select  name="userid" id="userid" placeholder="Tài khoản" class="form-control form-control-sm select2">
														<option value="-1"> {LANG.select}</option>
														<!-- BEGIN: userid -->
														<option value="{USER.key}" {USER.selected}> {USER.name}</option>
														<!-- END: userid -->
													</select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Mã nhân sự</label>
                                                    <input type="text" value="{DATA.personnel_code}" name="personnel_code" id="personnel_code" placeholder="Mã nhân sự" class="form-control form-control-sm ">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Mã chấm công</label>
                                                    <input type="text" value="{DATA.timekeeping_code}" name="timekeeping_code" id="timekeeping_code" placeholder="Mã chấm công" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Mã hồ sơ</label>
                                                    <input type="text" value="{DATA.profile_code}" name="profile_code" id="profile_code" placeholder="Mã hồ sơ" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
											
                                            <div class="col-sm-4 col-md-4">
												<div class="form-group">
													<label>Họ và tên</label>
													<input type="text" value="{DATA.full_name}" name="full_name" id="full_name" placeholder="Họ và tên" class="form-control form-control-sm">
												</div>
											</div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Ngày sinh</label>
													<div class="relative">
														<input type="text" value="{DATA.birthday}" id="birthday" name="birthday" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker"/>
													</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label >Giới tính</label>
                                                    <select  name="gender" id="gender" placeholder="Giới tính" class="form-control form-control-sm select2">
														<option value="-1"> {LANG.select}</option>
														<!-- BEGIN: gender -->
														<option value="{GENDER.key}" {GENDER.selected}> {GENDER.name}</option>
														<!-- END: gender -->
													</select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nơi sinh</label>
                                            <input type="text" value="{DATA.place_of_birth}" name="place_of_birth" id="place_of_birth" placeholder="Nơi sinh" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Nguyên quán</label>
                                            <input type="text" value="{DATA.origin_state}" name="origin_state" id="origin_state" placeholder="Nguyên quán" class="form-control form-control-sm">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="private_code">CMT/Căn cước/Hộ Chiếu</label>
                                                    <input type="text" value="{DATA.private_code}" name="private_code" id="private_code" placeholder="1234567890" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Ngày cấp</label>
													<div class="relative">
														<input type="text" value="{DATA.private_code_date}" name="private_code_date" id="private_code_date" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Nơi cấp</label>
                                                    <input type="text" value="{DATA.private_code_place}" name="private_code_place" id="private_code_place" placeholder="Nơi cấp" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Tình trạng hôn nhân</label>
 													<select name="marital_status" id="marital_status" class="form-control form-control-sm select2">												
														<option value="-1"> {LANG.select}</option>
														<!-- BEGIN: marital -->
														<option value="{MARITAL.key}" {MARITAL.selected}> {MARITAL.name}</option>
														<!-- END: marital -->
													</select>
												</div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Quốc tịch</label>
                                                    <select name="nationality" id="nationality" class="form-control form-control-sm select2"></select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Dân tộc</label>
                                                    <select name="people" id="people" class="form-control form-control-sm select2">
													</select>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Tôn giáo</label>
													<select name="religious" id="religious" class="form-control form-control-sm select2">
													</select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Số tài khoản</label>
                                                    <input type="text" value="{DATA.job_bank_account}" name="job_bank_account" id="job_bank_account" placeholder="Số tài khoản" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Tên tài khoản</label>
                                                    <input type="text" value="{DATA.job_bank_account_name}" name="job_bank_account_name" id="job_bank_account_name" placeholder="Tên tài khoản" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Ngân hàng</label>
                                                    <select name="job_bank_id" id="job_bank_id" class="form-control form-control-sm select2">
													</select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Chi nhánh</label>
                                                    <input type="text" value="{DATA.job_bank_desc}" name="job_bank_desc" id="job_bank_desc" placeholder="Chi nhánh" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-6 col-md-6">
                                                <div class="form-group">
													<label>Mã số thuế cá nhân</label>
													<input type="text" value="{DATA.job_tax}" name="job_tax" id="job_tax" placeholder="Mã số thuế cá nhân" class="form-control form-control-sm">
												</div>
												
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
													<label>Cấp bậc</label>
													<select name="level_id" id="level_id" class="form-control form-control-sm select2"></select>
												</div>
                                            </div>
 
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="level_school">Trình độ phổ thông</label>
													<select name="level_school" id="level_school" class="form-control form-control-sm select2">
													<option value="-1"> {LANG.select}</option>
													<!-- BEGIN: level_school -->
													<option value="{LEVEL_SCHOOL.key}" {LEVEL_SCHOOL.selected}> {LEVEL_SCHOOL.name}</option>
													<!-- END: level_school -->
													</select>
													
												</div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Chuyên môn cao nhất</label>
                                                    <select name="level_academic" id="level_academic" class="form-control form-control-sm select2"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Thông tin liên hệ</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Điện thoại</label>
                                            <input type="text" value="{DATA.mobile}" name="mobile" id="mobile" placeholder="Điện thoại" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" value="{DATA.email}" name="email" id="email" placeholder="Email" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label>Thường trú</label>
                                            <input type="text" value="{DATA.home_address}" name="home_address" id="home_address" placeholder="Số 12, Quang trung" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group" >
                                            <label>Địa chỉ thường trú</label>
 											<select name="place_home" id="place_home" class="form-control form-control-sm">
												<!-- BEGIN: place_home -->
												<option value="{PLACE_HOME.key}" {PLACE_HOME.selected}>{PLACE_HOME.name}</option>
												<!-- END: place_home -->
											</select>
										</div>
                                        <div class="form-group" >
                                            <label>Chỗ ở hiện nay</label>
                                            <input value="{DATA.current_address}" name="current_address" id="current_address" placeholder="Số 12, Quang trung..." class="form-control form-control-sm" >
 		 
                                        </div>
                                        <div class="form-group">
                                            <label >Địa chỉ hiện nay</label>
											<select name="place_current" id="place_current" class="form-control form-control-sm">
												<!-- BEGIN: place_current -->
												<option value="{PLACE_CURRENT.key}" {PLACE_CURRENT.selected}>{PLACE_CURRENT.name}</option>
												<!-- END: place_current -->
											</select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div id="card-body-fixp" class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Thông tin gia đình</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" ><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body padding10">
										<div id="family">
											<!-- BEGIN: family -->
											<div class="row">
											   <div class="col-sm-1 col-md-1">
												  <div class="form-group">
													 <label>Mối quan hệ</label>			
													 <select family name="family[{FAMILY.key}][relative_id]"  data-id="{FAMILY.relative_id}" class="form-control form-control-sm family{FAMILY.key}">
														 
													 </select>
												  </div>
											   </div>
											   <div class="col-sm-2 col-md-2">
												  <div class="form-group"><label>Họ và tên</label><input type="text" name="family[{FAMILY.key}][full_name]" placeholder="Họ và tên" value="{FAMILY.full_name}" class="form-control form-control-sm"></div>
											   </div>
											   <div class="col-sm-1 col-md-1">
												  <div class="form-group">
													 <label>Ngày sinh</label>			
													 <div class="relative">
														<input type="text" name="family[{FAMILY.key}][birthday]" placeholder="dd/mm/yyyy" value="{FAMILY.birthday}" class="form-control form-control-sm datepicker">
													 </div>
												  </div>
											   </div>
											   <div class="col-sm-2 col-md-2">
												  <div class="form-group"><label>Nghề nghiệp</label><input type="text" name="family[{FAMILY.key}][job]" placeholder="Nghề nghiệp" value="{FAMILY.job}" class="form-control form-control-sm"></div>
											   </div>
											   <div class="col-sm-2 col-md-2">
												  <div class="form-group"><label>Địa chỉ</label><input type="text" name="family[{FAMILY.key}][origin_state_address]" value="{FAMILY.origin_state_address}" placeholder="Địa chỉ" class="form-control form-control-sm"></div>
											   </div>
											   <div class="col-sm-2 col-md-2">
												  <div class="form-group"><label>Điện thoại</label><input type="text" name="family[{FAMILY.key}][phone]" value="{FAMILY.job}" placeholder="Điện thoại" class="form-control form-control-sm"></div>
											   </div>
											   <div class="col-sm-2 col-md-2">
												  <div class="form-group">
													 <label>Người phụ thuộc</label>			
													 <select family data-id="{FAMILY.is_dependent}" name="family[{FAMILY.key}][is_dependent]" class="form-control form-control-sm family{FAMILY.key}">
														 
													 </select>
												  </div>
											   </div>
											</div>
											<!-- END: family -->
											 
										</div>
										<a href="#" onclick="addFamily();" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div id="card-body-fixp" class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Trình độ học vấn</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" ><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>

                                    <div class="card-body padding10">
										<div id="degrees" >
											<!-- BEGIN: degrees -->
											<div class="row">
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
														<label>Từ tháng</label>
														<div class="relative">
															<input type="text" value="{DEGREES.date_from}" name="degrees[{DEGREES.key}][date_from]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">
														</div>
													</div>
												</div>
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
														<label>Đến tháng</label>
														<div class="relative">
															<input type="text" value="{DEGREES.date_to}" name="degrees[{DEGREES.key}][date_to]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">
														</div>
													</div>
												</div>
												<div class="col-sm-3 col-md-3">
													<div class="form-group" data-select2-id="69">
														<label>Hình thức đào tạo</label>
														<select type_id data-id="{DEGREES.type_id}" name="degrees[{DEGREES.key}][type_id]" class="form-control form-control-sm degrees{DEGREES.key}">
															
														</select>
													</div>
												</div>
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Chuyên ngành</label>
														<input value="{DEGREES.specialization}" type="text" name="degrees[{DEGREES.key}][specialization]" placeholder="Chuyên ngành" class="form-control form-control-sm">
													</div>
												</div>
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Trình độ học vấn</label>
														<select level_id data-id="{DEGREES.level_id}" name="degrees[{DEGREES.key}][level_id]" class="form-control form-control-sm degrees{DEGREES.key}">
															
														</select>
													</div>
												</div>
												<div class="col-sm-3 col-md-3">
													<div class="form-group">
														<label>Nơi đào tạo</label>
														<input type="text" value="{DEGREES.place}" name="degrees[{DEGREES.key}][place]" placeholder="Nơi đào tạo" class="form-control form-control-sm">
													</div>
												</div>
											</div>
											<!-- END: degrees -->												 
										</div>
										<a href="#" onclick="addDegrees();" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
                                <div id="card-body-fixp" class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Kinh nghiệm làm việc</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" ><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body padding10">
										<div id="experience">
											<!-- BEGIN: experience -->
											<div class="row">
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
													   <div class="form-group">
															<label>Từ tháng</label>
															<div class="relative">
																<input type="text" value="{EXPERIENCE.date_from}" name="experience[{EXPERIENCE.key}][date_from]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">
															</div>
														</div>
													</div>   
												</div>       
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
														<label>Đến tháng</label>
														<div class="relative">
															<input type="text" value="{EXPERIENCE.date_to}" name="experience[{EXPERIENCE.key}][date_to]" placeholder="Đến tháng" class="form-control form-control-sm datepicker2">
														</div>
													</div>   
												</div>       
												<div class="col-sm-3 col-md-3">
													<div class="form-group">
														<label>Công ty</label>
														<input type="text" value="{EXPERIENCE.company_title}" name="experience[{EXPERIENCE.key}][company_title]" placeholder="Tên công ty" class="form-control form-control-sm">
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Vị trí</label>
														<input type="text" value="{EXPERIENCE.position_id}" name="experience[{EXPERIENCE.key}][position_id]" placeholder="Nhân viên" class="form-control form-control-sm">
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Người tham chiếu</label>
														<input type="text" value="{EXPERIENCE.contact_info}" name="experience[{EXPERIENCE.key}][contact_info]" placeholder="Họ và tên" class="form-control form-control-sm">
													</div>   
												</div>       
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
														<label>Điện thoại</label>
														<input type="text" value="{EXPERIENCE.phone}" name="experience[{EXPERIENCE.key}][phone]" placeholder="Điện thoại" class="form-control form-control-sm">
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Mô tả công việ</label>
														<input type="text" value="{EXPERIENCE.work_desc}" name="experience[{EXPERIENCE.key}][work_desc]" placeholder="Mô tả công việc" class="form-control form-control-sm">
													</div>   
												</div>       
											</div>
											<!-- END: experience -->
										</div>
										<a href="#"  onclick="addExperience()"class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
							</div>
						</div>					
                    </div>	
                </div>
                <div class="tab-pane fade" id="tab-table2">
                    <div class="card-body">
                        <div class="row">
                             
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Thông tin chung</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
										<div class="row">
                             
											<div class="col-md-6">
												 <div class="form-group">
													<label for="contract_code">Mã hợp đồng</label>
													<input type="text" value="{DATA.contract_code}" name="contract_code" id="contract_code" placeholder="Mã hợp đồng" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-6">
												 <div class="form-group">
													<label>Hợp đồng</label>
													<select  name="contract_type" id="contract_type" class="form-control form-control-sm select2">
														
													</select>
													
												</div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label for="department_id">Phòng ban</label>
                                            <select  name="department_id" id="department_id" class="form-control form-control-sm select2">
												<option value="-1">{LANG.select}</option>
												<!-- BEGIN: department -->
												<option value="{DEPARTMENT.key}" {DEPARTMENT.selected}>{DEPARTMENT.name}</option>
												<!-- END: department -->		
											</select>
                                        </div>
                                        <div class="form-group">
                                            <label for="work_type">Hình thức</label>
                                            <select  name="work_type" id="work_type" class="form-control form-control-sm select2">
												<option value="-1">{LANG.select}</option>
												<!-- BEGIN: work_type -->
												<option value="{WORK_TYPE.key}" {WORK_TYPE.selected}>{WORK_TYPE.name}</option>
												<!-- END: work_type -->			
											</select>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_id">Vị trí</label>
                                            <select  name="position_id" id="position_id" class="form-control form-control-sm select2">
												<option value="-1">{LANG.select}</option>		
											</select>
                                        </div>
 
                                        <div class="form-group">
                                            <label>Chức vụ</label>
											<select  name="job_title" id="job_title" class="form-control form-control-sm select2">
													<option value="-1">{LANG.select}</option>	
											</select>
										</div>
										<div class="form-group">
                                            <label>Nơi làm việc</label>
											<select  name="work_place" id="work_place" class="form-control form-control-sm select2">
													<option value="-1">{LANG.select}</option>	
											</select>	
										</div>
										 <div class="row">
                             
											<div class="col-md-6">
												 <div class="form-group">
													<label>Hiệu lực từ ngày</label>
													<div class="relative">
														<input type="text" value="{DATA.date_start}" name="date_start" id="date_start" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												 <div class="form-group">
													<label>Đến ngày</label>
													<div class="relative">
														<input type="text" value="{DATA.date_finish}" name="date_finish" id="date_finish" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
										</div>
                                       <div class="row">
											<div class="col-md-6">
												 <div class="form-group">
													<label>Ngày ký</label>
													<div class="relative">
														<input type="text" value="{DATA.date_reg}" name="date_reg" id="date_reg" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												 <div class="form-group" >
													<label>Người ký</label>
													<select name="signer_id" id="signer_id" class="form-control form-control-sm">
														<!-- BEGIN: signer -->
														<option value="{SIGNER.key}" {SIGNER.selected}>{SIGNER.name}</option>
														<!-- END: signer -->	
													</select>
												</div>
											</div>
											
										</div>
                                       
                                       
                                       

                                    </div>
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Lương & Phụ cấp</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Từ ngày</label>
													<div class="relative">
														<input type="text" value="{DATA.salary_date_from}" name="salary_date_from" id="salary_date_from" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Hình thức lương</label>
													<select name="salary_method_id" id="salary_method_id" class="form-control form-control-sm select2">
														 
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Số tiền</label>
													<input type="text" value="{DATA.salary_money}" name="salary_money" id="salary_money" placeholder="Số tiền" class="form-control form-control-sm money">
												</div>
												
											</div>
										</div>
										
										<div id="allowancesMore">
											<!-- BEGIN: allowances -->
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Phụ cấp</label>
														<select allow_id data-id="{ALLOWANCES.allow_id}" name="allowances[{ALLOWANCES.key}][allow_id]" class="form-control form-control-sm allowances'+salary_row+'">
																
														</select>
													</div>   
												</div>   
												<div class="col-md-6">
													<div class="form-group">
														<label>Tiền phụ cấp</label>
														<input type="text" value="{ALLOWANCES.money}" name="allowances[{ALLOWANCES.key}][money]" value="0" placeholder="Tiền phụ cấp" class="form-control form-control-sm money">
													</div>   
												</div>   
											</div> 
											<!-- END: allowances -->
										</div>
										<div class="row">
											<a href="#" onclick="addAllowances();" class="btn btn-inline btn-success btn-xs margl75"><i class="fas fa-plus-circle"></i></a>
										
										</div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
						
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table3">
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Thông tin bảo hiểm</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip">
									  <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                             
											<div class="col-md-6">
												<div class="form-group">
													<label>Số sổ bảo hiểm</label>
													<input type="text"  value="{DATA.premium_number}" name="premium_number" id="premium_number" placeholder="Số sổ bảo hiểm" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Trạng thái sổ</label>
													<select  id="premium_insurance_status" name="premium_insurance_status" class="form-control form-control-sm select2">
														 
													</select>
												</div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label>Pháp nhân đóng</label>
                                            <select name="premium_personnel" id="premium_personnel" class="form-control form-control-sm ">
												
											</select>
                                        </div>
										 <div class="row">
                             
											<div class="col-md-6">
												 <div class="form-group">
													<label>Số thẻ BHYT</label>
													<input type="text"  value="{DATA.premium_card}"  name="premium_card" id="premium_card" placeholder="Số thẻ BHYT" class="form-control form-control-sm">													
												</div>
											</div>
											<div class="col-md-6">
												 <div class="form-group">
													<label>Mã cấp tỉnh</label>
													<select name="premium_code" id="premium_code" class="form-control form-control-sm">
													</select>
												</div>
											</div>
										</div>
                                       
                                       <div class="form-group">
											<label>Đăng ký khám chữa bệnh</label>
											<select  name="premium_place" id="premium_place" class="form-control form-control-sm select2">
												<option value="1"> Chọn nơi khám </option>
												<!-- BEGIN: premium_place -->
												<option value="{PREMIUM_PLACE.key}" {PREMIUM_PLACE.selected}>{PREMIUM_PLACE.name}</option>
												<!-- END: premium_place -->												
											</select>
										</div> 
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="row"> 
							<div class="col-md-6">
								<div class="card">
									<div class="card-header padding6-10">
										<h3 class="card-title">Nghiệp vụ báo tăng</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"><i class="fas fa-minus"></i></button>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>NV hoàn thiện HS</label>
													<div class="relative">
														<input type="text" value="{DATA.insup_date_get}" name="insup_date_get" id="insup_date_get" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>NS hoàn thiện HS</label>
													<div class="relative">
														<input type="text"  value="{DATA.insup_date_complete}" name="insup_date_complete" id="insup_date_complete" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Ngày nhận thẻ BHYT</label>
													<div class="relative">
														<input type="text"  value="{DATA.insup_date_receive}" name="insup_date_receive" id="insup_date_receive" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Ngày trả thẻ BHYT</label> 

													<div class="relative">
														<input type="text"  value="{DATA.insup_date_return}" name="insup_date_return" id="insup_date_returns" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
										</div> 
									</div>
								</div>
							</div>
						</div>
						<div class="row"> 
							<div class="col-md-6">
								<div class="card">
									<div class="card-header padding6-10">
										<h3 class="card-title">Nghiệp vụ báo giảm</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"><i class="fas fa-minus"></i></button>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Ngày nhận sổ BH từ NLĐ</label>
													<div class="relative">
														<input type="text" value="{DATA.insdown_date_get}" name="insdown_date_get" id="insdown_date_get" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>NS hoàn thiện HS</label>
													<div class="relative">
														<input type="text" value="{DATA.insdown_date_complete}" name="insdown_date_complete" id="insdown_date_complete" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Ngày nhận sổ BH đã chốt</label>
													<div class="relative">
														<input type="text" value="{DATA.insdown_date_apply}" name="insdown_date_apply" id="insdown_date_apply" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Ngày trả số cho NLĐ</label>
													<div class="relative">
														<input type="text" value="{DATA.insdown_date_return}"  name="insdown_date_return" id="insdown_date_return" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
													</div>
												</div>
											</div>
										</div> 
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div id="card-body-fixp" class="card">
									<div class="card-header padding6-10">
										<h3 class="card-title">Lịch sử đóng bảo hiểm</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" ><i class="fas fa-minus"></i></button>
										</div>
									</div>
									<div class="card-body padding10">
										<div id="historyInsurances">
											<!-- BEGIN: historyinsurances -->
											<div class="row">
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
													   <div class="form-group">
															<label>Từ tháng</label>
															<div class="relative">
																<input type="text" value="{HISTORYINSURANCES.date_from}" name="historyInsurances[{HISTORYINSURANCES.key}][date_from]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">
															</div>
														</div>
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Hình thức</label>
														<select type data-id="{HISTORYINSURANCES.type}" name="historyInsurances[{HISTORYINSURANCES.key}][type]" class="form-control form-control-sm historyInsurances{HISTORYINSURANCES.key}">      
														</select>
													</div>   
												</div>       
												<div class="col-sm-3 col-md-3">
													<div class="form-group">
														<label>Lý do</label>
														<select reason data-id="{HISTORYINSURANCES.reason}" name="historyInsurances[{HISTORYINSURANCES.key}][reason]"class="form-control form-control-sm historyInsurances{HISTORYINSURANCES.key}">   
														</select>
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Mức đóng bảo hiểm</label>
														<input  value="{HISTORYINSURANCES.salary_premium_base}" type="text" name="historyInsurances[{HISTORYINSURANCES.key}][salary_premium_base]" data="{HISTORYINSURANCES.key}" placeholder="Nhập..." class="form-control form-control-sm salary{HISTORYINSURANCES.key} money">
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>CT đóng</label>
														<input value="{HISTORYINSURANCES.salary_premium_company}" type="text" name="historyInsurances[{HISTORYINSURANCES.key}][salary_premium_company]" data="{HISTORYINSURANCES.key}" disabled="disabled" placeholder="0" class="form-control form-control-sm salaryc{HISTORYINSURANCES.key} money">
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>NLD đóng</label>
														<input value="{HISTORYINSURANCES.salary_premium_person}" type="text" name="historyInsurances[{HISTORYINSURANCES.key}][salary_premium_person]" data="{HISTORYINSURANCES.key}" disabled="disabled" placeholder="0" class="form-control form-control-sm salaryp{HISTORYINSURANCES.key} money">
													</div>   
												</div>       
											</div>  
											<!-- END: historyinsurances -->
										</div>
 
										<a href="#" onclick="addhistoryInsurances()" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div id="card-body-fixp" class="card">
									<div class="card-header padding6-10">
										<h3 class="card-title">Lịch sử giải quyết chế độ</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" ><i class="fas fa-minus"></i></button>
										</div>
									</div>
									<div class="card-body padding10">
										<div id="historySolves">
											<!-- BEGIN: historySolves -->
											<div class="row">
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Loại chế độ</label>
														<select model data-id="{HISTORYSOLVES.model}" name="historySolves[{HISTORYSOLVES.key}][model]" class="form-control form-control-sm historysolves{HISTORYSOLVES.key}">
																  
														</select>
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
													   <div class="form-group">
															<label>Ngày nhận hồ sơ</label>
															<div class="relative">
																<input type="text" value="{HISTORYSOLVES.premium_date_get}" name="historySolves[{HISTORYSOLVES.key}][premium_date_get]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
															</div>
														</div>
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
													   <div class="form-group">
															<label>Ngày hoàn thiện thủ tục</label>
															<div class="relative">
																<input type="text" value="{HISTORYSOLVES.premium_date_complete}" name="historySolves[{HISTORYSOLVES.key}][premium_date_complete]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
															</div>
														</div>
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
													   <div class="form-group">
															<label>Ngày nhận tiền BH trả</label>
															<div class="relative">
																<input type="text" value="{HISTORYSOLVES.premium_date_close}" name="historySolves[{HISTORYSOLVES.key}][premium_date_close]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
															</div>
														</div>
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
													   <div class="form-group">
															<label>Ngày trả chế độ</label>
															<div class="relative">
																<input type="text" value="{HISTORYSOLVES.premium_date_return}" name="historySolves[{HISTORYSOLVES.key}][premium_date_return]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">
															</div>
														</div>
													</div>   
												</div>       
												<div class="col-sm-2 col-md-2">
													<div class="form-group">
														<label>Số tiền</label>
														<input type="text"  value="{HISTORYSOLVES.price}" name="historySolves[{HISTORYSOLVES.key}][price]" placeholder="Nhập..." class="form-control form-control-sm money">
													</div>   
												</div>       
											</div>
											<!-- END: historySolves -->											
										</div>
 
										<a href="#" onclick="addHistorySolves()" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
							</div>
						</div>
							
                    </div>
                </div>
 
                <div class="tab-pane fade" id="tab-table4">
                    <div class="card-body">
						<!-- BEGIN: identitycard -->
                        <div class="icheck-danger checkbox"><input type="checkbox" value="{IDENTITYCARD.key}" {IDENTITYCARD.checked}  name="status_identity_card[]" id="takeover{IDENTITYCARD.key}"> <label for="takeover1"></label> {IDENTITYCARD.name}</div>
						<!-- END: identitycard -->
					 </div>
                </div>
                <div class="tab-pane fade" id="tab-table5">
                      <div class="card-body">
						<!-- BEGIN: resigntobill -->
                        <div class="icheck-danger checkbox"><input type="checkbox" value="{RESIGNTOBILL.key}" {RESIGNTOBILL.checked} name="resign_to_bill[]" id="takeovers{RESIGNTOBILL.key}"> <label for="takeovers"></label> {RESIGNTOBILL.name}</div>
						<!-- END: resigntobill -->
                     </div>
                </div>
				<div class="tab-pane fade" id="tab-table6">
                    <div class="card-body"> 
						<div class="attachmentgroup"> 
							<input id="file_upload" name="file_upload" type="file" multiple="true" /> 
							<div id="queue"></div>
							<div class="clearfix"></div>
							<div id="show_success">
								<ul id="composerAttachmentsHolder">
									<!-- BEGIN: attachments -->
									<li class="attachment" id="attachment_{ATTACHMENTS.attachment_id}"><div><input type="hidden" class="filenameoriginal" name="attachments[]" value="{ATTACHMENTS.attachment_id}">	<img class="type" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/attachment/{ATTACHMENTS.ext}.gif" width="16" height="16"><a href="javascript:void(0);" onclick="downloadAttachments('{ATTACHMENTS.attachment_id}','{ATTACHMENTS.token}')"><span>{ATTACHMENTS.basename}({ATTACHMENTS.size})</span></a><a class="attach-btn" href="javascript:void(0);" onclick="removeAttachment('{ATTACHMENTS.attachment_id}','{ATTACHMENTS.token}'); return false;"><i class="fa fa-times" aria-hidden="true"></i></a></div></li>
									<!-- END: attachments -->
								</ul>
							</div>			
						</div>
                    </div>
                </div>
 
            
				<div class="card-body paddinglr15">
					<div class="row">
						<div class="col-12">
							<a href="#" onclick="history.back(1);" class="btn btn-secondary btn-sm">Hủy</a>
							<input type="submit" id="submitreg" value="{PESOLNEL_ACTION}" class="btn btn-success btn-sm float-right">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- Daterange picker -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/select2/js/select2.full.min.js"></script>


<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<link type="text/css" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/uploadifive/uploadifive.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/plugins/uploadifive/jquery.uploadifive.js"></script>
<script src="{JSONFILE}"></script>
<script >var userData = {JSONDATA}</script>
<script type="text/javascript">
 
var family_row = {family_row};
var degrees_row = {degrees_row};
var experience_row = {experience_row};
var salary_row = {salary_row};
var history_row = {history_row};
var solves_row = {solves_row};
 
function addFamily ( ) {
	var html='';
	html += '<div class="row">';
	html += '	<div class="col-sm-1 col-md-1">';
	html += '		<div class="form-group">';
	html += '			<label>Mối quan hệ</label>';
	html += '			<select name="family['+ family_row +'][relative_id]"class="form-control form-control-sm family'+ family_row +'">';
	html += '				<option value="-1"> {LANG.select} </option>';
	$.each(globalData['family'], function(i, v){
		html += '			<option value="'+v.k+'" > '+v.t+' </option>';
	})
	html += '			</select>';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label >Họ và tên</label>';
	html += '			<input type="text" name="family['+ family_row +'][full_name]" placeholder="Họ và tên" value="{FAMILY.full_name}" class="form-control form-control-sm">';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-1 col-md-1">';
	html += '		<div class="form-group">';
	html += '			<label>Ngày sinh</label>';
	html += '			<div class="relative">';
	html += '				<input type="text" name="family['+ family_row +'][birthday]" placeholder="dd/mm/yyyy" value="{FAMILY.birthday}" class="form-control form-control-sm datepicker">';
	html += '			</div>';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label >Nghề nghiệp</label>';
	html += '			<input type="text" name="family['+ family_row +'][job]" placeholder="Nghề nghiệp" value="{FAMILY.job}" class="form-control form-control-sm">';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label>Địa chỉ</label>';
	html += '			<input type="text" name="family['+ family_row +'][origin_state_address]" placeholder="Địa chỉ" class="form-control form-control-sm">';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label>Điện thoại</label>';
	html += '			<input type="text" name="family['+ family_row +'][phone]"  placeholder="Điện thoại" class="form-control form-control-sm">';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label >Người phụ thuộc</label>';
	html += '			<select  name="family['+ family_row +'][is_dependent]" class="form-control form-control-sm family'+ family_row +'">';
	html += '				<option value="-1"> {LANG.select} </option>';
	$.each(globalData['family'], function(i, v){
		html += '			<option value="'+v.k+'" > '+v.t+' </option>';
	})
	html += '			</select>';
	html += '		</div>';
	html += '	</div>											';
	html += '</div>';
	
	$('#family').append(html);
	setTimeout(function(){
		$('.family'+family_row).select2({
			searchInputPlaceholder: 'Tìm kiếm...', 
			language : '{NV_LANG_DATA}'
		}).on('select2:open', function(e){
			$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
		});
		family_row++
	}, 200);
	AddDatepicker('.datepicker');
	AddDatepicker2('.datepicker2');
	
} 

function addDegrees( ) {
	var html='';
	html += '<div class="row">';
	html += '	<div class="col-sm-1 col-md-1">';
	html += '		<div class="form-group">';
	html += '			<label>Từ tháng</label>';
	html += '			<div class="relative">';
	html += '				<input type="text" name="degrees['+ degrees_row +'][date_from]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">';
	html += '			</div>';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-1 col-md-1">';
	html += '		<div class="form-group">';
	html += '			<label>Đến tháng</label>';
	html += '			<div class="relative">';
	html += '				<input type="text" name="degrees['+ degrees_row +'][date_to]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">';
	html += '			</div>';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-3 col-md-3">';
	html += '		<div class="form-group">';
	html += '			<label>Hình thức đào tạo</label>';
	html += '			<select  name="degrees['+ degrees_row +'][type_id]" class="form-control form-control-sm degrees'+ degrees_row +'">';
	html += '				<option value="-1"> {LANG.select} </option>	';
	$.each(globalData['type'], function(i, v){
		html += '			<option value="'+v.k+'" > '+v.t+' </option>';
	})
	html += '			</select>';
	html += '		</div>';
	html += '	</div>';
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label>Chuyên ngành</label>';
	html += '			<input type="text" name="degrees['+ degrees_row +'][specialization]" placeholder="Chuyên ngành" class="form-control form-control-sm">';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label>Trình độ học vấn</label>';
	html += '			<select  name="degrees['+ degrees_row +'][level_id]" class="form-control form-control-sm degrees'+ degrees_row +'">';
	html += '				<option value="-1"> {LANG.select} </option>	';
	$.each(globalData['deg_level'], function(i, v){
		html += '			<option value="'+v.k+'" > '+v.t+' </option>';
	})                         
	html += '			</select>';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-3 col-md-3">';
	html += '		<div class="form-group">';
	html += '			<label>Nơi đào tạo</label>';
	html += '			<input type="text" name="degrees['+ degrees_row +'][place]" placeholder="Nơi đào tạo" class="form-control form-control-sm">';
	html += '		</div>';   
	html += '	</div>';       
	html += '</div>';          
	                           
	$('#degrees').append(html);
	setTimeout(function(){     
		$('.degrees'+ degrees_row +'' ).select2({
			searchInputPlaceholder: 'Tìm kiếm...', 
			language : '{NV_LANG_DATA}'
		}).on('select2:open', function(e){
			$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
		})                     
		degrees_row++;         
	}, 200)                    
	AddDatepicker2('.datepicker2');
}                              
                               
function addExperience() {     
	var html='';               
	html += '<div class="row">';
	html += '	<div class="col-sm-1 col-md-1">';
	html += '		<div class="form-group">';
	html += '		   <div class="form-group">';
	html += '				<label>Từ tháng</label>';
	html += '				<div class="relative">';
	html += '					<input type="text" name="experience['+ experience_row +'][date_from]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">';
	html += '				</div>';
	html += '			</div>';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-1 col-md-1">';
	html += '		<div class="form-group">';
	html += '			<label>Đến tháng</label>';
	html += '			<div class="relative">';
	html += '				<input type="text" name="experience['+ experience_row +'][date_to]" placeholder="Đến tháng" class="form-control form-control-sm datepicker2">';
	html += '			</div>';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-3 col-md-3">';
	html += '		<div class="form-group">';
	html += '			<label>Công ty</label>';
	html += '			<input type="text" name="experience['+ experience_row +'][company_title]" placeholder="Tên công ty" class="form-control form-control-sm">';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label>Vị trí</label>';
	html += '			<input type="text" name="experience['+ experience_row +'][position_id]" placeholder="Nhân viên" class="form-control form-control-sm">';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label>Người tham chiếu</label>';
	html += '			<input type="text" name="experience['+ experience_row +'][contact_info]" placeholder="Họ và tên" class="form-control form-control-sm">';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-1 col-md-1">';
	html += '		<div class="form-group">';
	html += '			<label>Điện thoại</label>';
	html += '			<input type="text" name="experience['+ experience_row +'][phone]" placeholder="Điện thoại" class="form-control form-control-sm">';
	html += '		</div>';   
	html += '	</div>';       
	html += '	<div class="col-sm-2 col-md-2">';
	html += '		<div class="form-group">';
	html += '			<label>Mô tả công việ</label>';
	html += '			<input type="text" name="experience['+ experience_row +'][work_desc]" placeholder="Mô tả công việc" class="form-control form-control-sm">';
	html += '		</div>';   
	html += '	</div>';       
	html += '</div>';          
	                           
	$('#experience').append(html);
	experience_row++;          
	AddDatepicker2('.datepicker2');
}                              
                               
function addAllowances() {     
	                           
	                           
	var html='';               
	html +='<div class="row">';
	html +='	<div class="col-md-6">';
	html +='		<div class="form-group">';
	html +='			<label>Phụ cấp</label>';
	html +='			<select name="allowances['+salary_row+'][allow_id]" class="form-control form-control-sm allowances'+salary_row+'">';
	html +='			 	<option value="-1"> {LANG.select} </option>	';
	$.each(globalData['allowances'], function(i, v){
		html += '			<option value="'+v.k+'" > '+v.t+' </option>';
	})                         
	html +='			</select>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-md-6">';
	html +='		<div class="form-group">';
	html +='			<label>Tiền phụ cấp</label>';
	html +='			<input type="text" name="allowances['+salary_row+'][money]" value="0" placeholder="Tiền phụ cấp" class="form-control form-control-sm money">';
	html +='		</div>';   
	html +='	</div>';       
	html +='</div>';           
	                           
	$('#allowancesMore').append(html);
	setTimeout(function(){     
		$('.allowances'+salary_row).select2({
			searchInputPlaceholder: 'Tìm kiếm...', 
			language : '{NV_LANG_DATA}'
		}).on('select2:open', function(e){
			$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
		})                     
		salary_row++;          
	}, 200)                    
                               
	$('.money').price_format();
	                           
}                              
                               
function addhistoryInsurances() {
	var html='';               
	html +='<div class="row">';
	html +='	<div class="col-sm-1 col-md-1">';
	html +='		<div class="form-group">';
	html +='		   <div class="form-group">';
	html +='				<label>Từ tháng</label>';
	html +='				<div class="relative">';
	html +='					<input type="text" name="historyInsurances['+ history_row +'][date_from]" placeholder="Từ tháng" class="form-control form-control-sm datepicker2">';
	html +='				</div>';
	html +='			</div>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='			<label>Hình thức</label>';
	html +='			<select  name="historyInsurances['+ history_row +'][type]" class="form-control form-control-sm historyInsurances'+history_row+'">';
	html +='				<option value="1"> {LANG.select} </option>';
	$.each(globalData['updown'], function(key, val){
		html += '			<option value="'+key+'" > '+val+' </option>';
	})                         
	html +='			</select>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-3 col-md-3">';
	html +='		<div class="form-group">';
	html +='			<label>Lý do</label>';
	html +='			<select  name="historyInsurances['+ history_row +'][reason]"class="form-control form-control-sm historyInsurances'+history_row+'">';
	html +='				<option value="1"> {LANG.select} </option>';
	$.each(globalData['reason'], function(i, v){
		html += '			<option value="'+v.k+'" > '+v.t+' </option>';
	})                         
	html +='			</select>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='			<label>Mức đóng bảo hiểm</label>';
	html +='			<input type="text" name="historyInsurances['+ history_row +'][salary_premium_base]" data="'+ history_row +'" placeholder="Nhập..." class="form-control form-control-sm salary'+ history_row +' money">';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='			<label>CT đóng</label>';
	html +='			<input type="text" name="historyInsurances['+ history_row +'][salary_premium_company]" data="'+ history_row +'" disabled="disabled" placeholder="0" class="form-control form-control-sm salaryc'+ history_row +' money">';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='			<label>NLD đóng</label>';
	html +='			<input type="text" name="historyInsurances['+ history_row +'][salary_premium_person]" data="'+ history_row +'" disabled="disabled" placeholder="0" class="form-control form-control-sm salaryp'+ history_row +' money">';
	html +='		</div>';   
	html +='	</div>';       
	html +='</div>';           
	                           
	$('#historyInsurances').append(html);
	setTimeout(function(){     
		$('.historyInsurances'+history_row).select2({
			searchInputPlaceholder: 'Tìm kiếm...', 
			language : '{NV_LANG_DATA}'
		}).on('select2:open', function(e){
			$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
		})                     
		history_row++;         
	})                         
                               
	AddDatepicker2('.datepicker2');
	$('.money').price_format();
	                           
}                              
                               
function addHistorySolves() {  
	var html='';               
	html +='<div class="row">';
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='			<label>Loại chế độ</label>';
	html +='			<select name="historySolves['+ solves_row +'][model]" class="form-control form-control-sm historysolves'+ solves_row +'">';
	html +='				<option value="1"> {LANG.select} </option>';
	$.each(globalData['historysolves'], function(i, v){
		html += '			<option value="'+v.k+'" > '+v.t+' </option>';
	})                         
	html +='			</select>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='		   <div class="form-group">';
	html +='				<label>Ngày nhận hồ sơ</label>';
	html +='				<div class="relative">';
	html +='					<input type="text" name="historySolves['+ solves_row +'][premium_date_get]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">';
	html +='				</div>';
	html +='			</div>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='		   <div class="form-group">';
	html +='				<label>Ngày hoàn thiện thủ tục</label>';
	html +='				<div class="relative">';
	html +='					<input type="text" name="historySolves['+ solves_row +'][premium_date_complete]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">';
	html +='				</div>';
	html +='			</div>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='		   <div class="form-group">';
	html +='				<label>Ngày nhận tiền BH trả</label>';
	html +='				<div class="relative">';
	html +='					<input type="text" name="historySolves['+ solves_row +'][premium_date_close]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">';
	html +='				</div>';
	html +='			</div>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='		   <div class="form-group">';
	html +='				<label>Ngày trả chế độ</label>';
	html +='				<div class="relative">';
	html +='					<input type="text" name="historySolves['+ solves_row +'][premium_date_return]" placeholder="dd/mm/yyyy" class="form-control form-control-sm datepicker">';
	html +='				</div>';
	html +='			</div>';
	html +='		</div>';   
	html +='	</div>';       
	html +='	<div class="col-sm-2 col-md-2">';
	html +='		<div class="form-group">';
	html +='			<label>Số tiền</label>';
	html +='			<input type="text" name="historySolves['+ solves_row +'][price]" placeholder="Nhập..." class="form-control form-control-sm money">';
	html +='		</div>';   
	html +='	</div>';       
	html +='</div>';           
	                           
	$('#historySolves').append(html);
	setTimeout(function(){     
		$('.historysolves'+solves_row).select2({
			searchInputPlaceholder: 'Tìm kiếm...', 
			language : '{NV_LANG_DATA}'
		}).on('select2:open', function(e){
			$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
		});                    
		solves_row++;          
	})                         
	AddDatepicker('.datepicker');
	$('.money').price_format();
	                           
}                              
                               
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
                               
function removeAttachment( attachment_id, token ){	
	if (confirm('Bạn có chắc xóa file này ?')) {
		$.ajax({               
			type: 'POST',      
			url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&action=removeFile&second=' + new Date().getTime(),
			data: {attachment_id : attachment_id, token: token},
			dataType: 'json',  
			success: function (json){
			                   
				if( json['success'] )
				{              
					$( '#attachment_'+attachment_id ).remove();
				}              
				if( json['error'] )
				{              
					alert(json['error']);
				}              
				               
			},                 
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}                  
		});                    
	}                          
}                              
                               
function downloadAttachments( attachment_id, token ){	
	$.ajax({
		url: nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=download&second=' + new Date().getTime(),
		type: 'POST',
		data: 'action=export&attachment_id=' + attachment_id+'&token=' + token,
		success: function (json) {
			
			if( json['success'] )
			{
				window.location =  nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=download&action=download&attachment_id=' + attachment_id+'&token=' + token;
			}else if( json['error'] )
			{
				alert( json['error'] ); 
			}
		}
	});                         
}                              

$(function () {                
	                           
	AddDatepicker('.datepicker');
	AddDatepicker2('.datepicker2');
	<!-- BEGIN: empty_data -->
	addFamily();           
	addDegrees();  
	addExperience();           
	addAllowances();           
	addhistoryInsurances();    
	addHistorySolves(); 	
	<!-- END: empty_data -->
	
	<!-- BEGIN: exist_data -->
	$('select[family]').each(function(){
		var id = $(this).attr('data-id');
		temp= '<option value="-1"> {LANG.select} </option>';
		$.each(globalData['family'], function(i, v){
		selected = ( id == v.k ) ? 'selected="selected"' : '';
		temp += '<option value="'+v.k+'" '+ selected +'> '+v.t+' </option>';
		})
		$(this).html(temp);
	})         
	$('select[type_id]').each(function(){
		var id = $(this).attr('data-id');
		temp= '<option value="-1"> {LANG.select} </option>';
		$.each(globalData['type'], function(i, v){
		selected = ( id == v.k ) ? 'selected="selected"' : '';
		temp += '<option value="'+v.k+'" '+ selected +'> '+v.t+' </option>';
		})
		$(this).html(temp);
	})         
	$('select[level_id]').each(function(){
		var id = $(this).attr('data-id');
		temp= '<option value="-1"> {LANG.select} </option>';
		$.each(globalData['deg_level'], function(i, v){
		selected = ( id == v.k ) ? 'selected="selected"' : '';
		temp += '<option value="'+v.k+'" '+ selected +'> '+v.t+' </option>';
		})
		$(this).html(temp);
	})         
	$('select[allow_id]').each(function(){
		var id = $(this).attr('data-id');
		temp= '<option value="-1"> {LANG.select} </option>';
		$.each(globalData['allowances'], function(i, v){
		selected = ( id == v.k ) ? 'selected="selected"' : '';
		temp += '<option value="'+v.k+'" '+ selected +'> '+v.t+' </option>';
		})
		$(this).html(temp);
	})         
	$('select[reason]').each(function(){
		var id = $(this).attr('data-id');
		temp= '<option value="-1"> {LANG.select} </option>';
		$.each(globalData['reason'], function(i, v){
		selected = ( id == v.k ) ? 'selected="selected"' : '';
		temp += '<option value="'+v.k+'" '+ selected +'> '+v.t+' </option>';
		})
		$(this).html(temp);
	})         
	$('select[type]').each(function(){
		var id = $(this).attr('data-id');
		temp= '<option value="-1"> {LANG.select} </option>';
		$.each(globalData['updown'], function(k, v){
		selected = ( id == k ) ? 'selected="selected"' : '';
		temp += '<option value="'+k+'" '+ selected +'> '+v+' </option>';
		})
		$(this).html(temp);
	})  
	$('select[model]').each(function(){
		var id = $(this).attr('data-id');
		temp= '<option value="-1"> {LANG.select} </option>';
		$.each(globalData['historysolves'], function(i, v){
		selected = ( id == v.k ) ? 'selected="selected"' : '';
		temp += '<option value="'+v.k+'" '+ selected +'> '+v.t+' </option>';
		})
		$(this).html(temp);
	})  
 
	
	<!-- END: exist_data -->
	
 	
		
	
	
	$('.money').price_format();
	                           
	<!-- CẤP BẬC -->           
	var level = '<option value="">{LANG.select}</option>';
	$.each(globalData['level'], function(i, v){
		sl = ( userData.level_id == v.k ) ? 'selected="selected"' : '';
		level += '<option value="'+v.k+'" '+ sl +' >'+v.t+'</option>';
	})                         
	$('#level_id').html(level);
	                           
	<!-- CHUYÊN MÔN CAO NHẤT -->
	var academic = '<option value="">{LANG.select}</option>';
	$.each(globalData['deg_level'], function(i, v){
		sl = ( userData.level_academic == v.k ) ? 'selected="selected"' : '';
		academic += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#level_academic').html(academic);
                               
	<!-- DÂN TỘC -->           
 	var people = '<option value="">{LANG.select}</option>';
	$.each(globalData['people'], function(i, v){
		sl = ( userData.people == v.k ) ? 'selected="selected"' : '';
		people += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#people').html(people); 
 	<!-- TÔN GIÁO -->          
	var religious = '<option value="">{LANG.select}</option>';
	$.each(globalData['religious'], function(i, v){
		sl = ( userData.religious == v.k ) ? 'selected="selected"' : '';
		religious += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#religious').html(religious);
 	                           
	<!-- NGÂN HÀNG -->         
	var job_bank = '<option value="">{LANG.select}</option>';
	$.each(globalData['job_bank'], function(i, v){
		sl = ( userData.job_bank_id == v.k ) ? 'selected="selected"' : '';
		job_bank += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#job_bank_id').html(job_bank);
	                           
 	<!-- LOẠI HỢP ĐỒNG -->     
	var contract_type = '<option value="">{LANG.select}</option>';
	$.each(globalData['contract'], function(i, v){
		sl = ( userData.contract_type == v.k ) ? 'selected="selected"' : '';
		contract_type += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#contract_type').html(contract_type);
	                           
 	<!-- VỊ TRÍ TUYỂN DỤNG --> 
	var position = '<option value="">{LANG.select}</option>';
	$.each(globalData['position'], function(i, v){
		sl = ( userData.position_id == v.k ) ? 'selected="selected"' : '';
		position += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#position_id').html(position);
	                           
 	<!-- CHỨC VỤ -->           
	var job_title = '<option value="">{LANG.select}</option>';
	$.each(globalData['job_title'], function(i, v){
		sl = ( userData.job_title == v.k ) ? 'selected="selected"' : '';
		job_title += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#job_title').html(job_title);
	                           
 	<!-- NOI LÀM VIỆC -->      
	var work_place = '<option value="">{LANG.select}</option>';
	$.each(globalData['work_place'], function(i, v){
		sl = ( userData.work_place == v.k ) ? 'selected="selected"' : '';
		work_place += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#work_place').html(work_place);
	                           
 	<!-- Hình thức luong -->   
	var salary_method_id = '<option value="">{LANG.select}</option>';
	$.each(globalData['salarymethod'], function(i, v){
		sl = ( userData.salary_method_id == v.k ) ? 'selected="selected"' : '';
		salary_method_id += '<option value="'+v.k+'"'+ sl +' >'+v.t+'</option>';
	})                         
	$('#salary_method_id').html(salary_method_id);
 	<!-- Quoc gia -->          
	var nationality = '<option value="">{LANG.select}</option>';
	$.each(globalData['country'], function(i, v){
		sl = ( userData.nationality == v.k ) ? 'selected="selected"' : '';
		nationality += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#nationality').html(nationality);
 	                           
	<!-- TRẠNG THÁI SỔ-->      
	var bookstatus = '<option value="">{LANG.select}</option>';
	$.each(globalData['bookstatus'], function(i, v){
		sl = ( userData.premium_insurance_status == v.k ) ? 'selected="selected"' : '';
		bookstatus += '<option value="'+v.k+'" '+ sl +'>'+v.t+'</option>';
	})                         
	$('#premium_insurance_status').html(bookstatus);
 	                           
	<!-- PHÁP NHÂN-->          
	var premium_code = '<option value="">{LANG.select}</option>';
	$.each(globalData['province'], function(i, v){
		sl = ( userData.premium_code == v.k ) ? 'selected="selected"' : '';
		premium_code += '<option value="'+v.k+'" '+ sl +'>'+v.t+' - '+v.c+'</option>';
	})                         
	$('#premium_code').html(premium_code);
                               
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
		var premium = '<option value="">{LANG.select}</option>';
		$.each(globalData['premium'], function(i, v){
			sl = ( userData.premium_personnel == v.k ) ? 'selected="selected"' : '';
			premium += '<option value="'+v.k+'" lev="'+v.l+'" '+ sl +' >'+v.t+'</option>';
		})                     
	                           
		$('#premium_personnel').html(premium);
	                           
		$('#premium_personnel').select2({
			searchInputPlaceholder: 'Tìm kiếm...', 
			language : '{NV_LANG_DATA}',
			templateResult: formatResult,
            templateSelection: function(node) {
				return node.text;
			}                  
			                   
		}).on('select2:open', function(e){
			$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
		})                     
		$('#premium_code').select2({
			searchInputPlaceholder: 'Tìm kiếm...', 
			language : '{NV_LANG_DATA}'
			                   
		}).on('select2:open', function(e){
		                       
			$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
			                   
		}).on('select2:select', function(e){
	                           
			$.ajax({           
				url: nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&action=registermedical&second=' + new Date().getTime(),
				type: 'post',  
				dataType: 'json',
				data: {province_id: e.params.data.id},
				beforeSend: function() {
					$('#premium_place').html('');
				},	           
				complete: function() {
					           
				},             
				success: function(json) {
					if( json['data'] )
					{          
					           
						var premium_place = '';
						$.each(json['data'], function(i, v){
							premium_place += '<option value="'+v.id+'" >'+v.text+'</option>';
						})     
						$('#premium_place').html(premium_place);
					           
						$('#premium_place').select2({
							searchInputPlaceholder: 'Tìm kiếm...', 
							language : '{NV_LANG_DATA}'
						}).on('select2:open', function(e){
							$('.select2-search__field').attr('placeholder', 'Tìm kiếm...');
						});    
					           
					}					 
				},             
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}              
			});                
			                   
		})                     
                               
	}, 200)                    
                               
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
	                           
	$("#signer_id").select2({  
		multiple: true,        
		maximumSelectionLength: 1,
		placeholder: 'Chọn người ký...',
		ajax: {                
			url: nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&action=signer&second=' + new Date().getTime(),
			type: "post",      
			dataType: 'json',  
			delay: 250,        
			data: function (params) {
				return {       
					q: params.term  
				};             
			},                 
			processResults: function (response) {
				if(  response['data'] )
				{              
					return {   
						results: response['data']
					};         
				}              
				else           
				{              
					           
					return {   
						results: {}
					};         
				}              
			},                 
			cache: true        
		},                     
		language : '{NV_LANG_DATA}'
	});                        
	                           
	$("#place_home, #place_current").select2({
		multiple: true,        
		maximumSelectionLength: 1,
		placeholder: 'Chọn địa chỉ...',
		ajax: {                
			url: nv_base_siteurl + 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&action=address&second=' + new Date().getTime(),
			type: "post",      
			dataType: 'json',  
			delay: 250,        
			data: function (params) {
				return {       
					q: params.term  
				};             
			},                 
			processResults: function (response) {
				if(  response['data'] )
				{              
					return {   
						results: response['data']
					};         
				}              
				else           
				{              
					           
					return {   
						results: {'id': 0, 'text': ''}
					};         
				}              
			},                 
			cache: true        
		},                     
		language : '{NV_LANG_DATA}'
	});                        
	                           
	$('#file_upload').uploadifive({
        'auto': true,          
        'buttonText': "Chọn tệp tin",
        'width': '120',        
        'formData': {          
			'token': '{TOKEN}',
        },                     
        'onUploadProgress' : function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
            $('#after_content').html(totalBytesUploaded + ' bytes uploaded of ' + totalBytesTotal + ' bytes.').show();
        },                     
		'queueID': 'queue',    
        'uploadScript': nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=upload&second=' + new Date().getTime(),
        'onUploadComplete': function (file, data) {
			var json = $.parseJSON(data);
			if( json['data'] ) 
			{                  
				var items = json['data'];
				var a = "";    
                a += "<li class=\"attachment\" id=\"attachment_" + items['attachment_id'] + "\">";
				a += "  <div>";
				a += "	<input type=\"hidden\" class=\"filenameoriginal\" name=\"attachments[]\" value=\""+items['attachment_id']+"\">";
				a += "	<img class=\"type\" src=\""+nv_base_siteurl+"themes/{TEMPLATE}/images/attachment/"+ items['ext'] +".gif\" width=\"16\" height=\"16\" />"; 
				a += "	<span>"+items['basename']+" ("+items['filesize']+")</span>"; 
				a += "	<a class=\"attach-btn\" href=\"javascript:void(0);\" onclick=\"removeAttachment('"+items['attachment_id']+"','"+items['token']+"'); return false;\">"; 
				a += "		<i class=\"fa fa-times\" aria-hidden=\"true\"></i>"; 
				a += "	</a>"; 
				a += "	</div>";
				a += "</li>";  
                $('#composerAttachmentsHolder').append(a);
			}                  
			else if( json['error'] )
			{                  
				alert( json['error'] );
			}                  
        }                      
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
                               
                               
	$( 'body' ).on('focus', '#registerForm input, #registerForm select', function() {
		obj = $(this);         
		setTimeout(function(){ 
			obj.tooltip('hide');
		}, 500);	           
	})                         
	                           
	$("#registerForm").on('submit', function(e) {
		e.preventDefault();    
		$.ajax({               
			type: "POST",      
			dataType: 'json',  
			url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=register&action=create&second=' + new Date().getTime(),
			data: $('#registerForm').serialize(),
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
				               
					var mess = ''+
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
</script>                      
<!-- END: main -->             
                               
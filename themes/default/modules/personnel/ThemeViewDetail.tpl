<!-- BEGIN: main -->
<div id="registerForm" class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left card-title d62f2f">Thêm nhân sự mới</h3>
                <div class="float-right toolaction">
                    <a href="#" data-toggle="tooltip" title="Import nhân sự Excel"><i class="fas fa-file-upload"> </i><span>Nhập<span></a>
                    <a href="#" data-toggle="tooltip" title="Cài đặt"><i class="fas fa-cog"> </i><span>Cài đặt<span></a>
                </div>
            </div>
            <div id="nav-tab" class="nav nav-tabs" role="tablist">

                <a class="nav-item nav-link active" href="#tab-table1" data-tab="1" data-toggle="tab">Chi tiết</a>

                <a class="nav-item nav-link" href="#tab-table2" data-tab="2" data-toggle="tab">Công việc</a>

                <a class="nav-item nav-link" href="#tab-table3" data-tab="3" data-toggle="tab">Bảo hiểm</a>

                <a class="nav-item nav-link" href="#tab-table4" data-tab="4" data-toggle="tab">Hợp đồng</a>

                <a class="nav-item nav-link" href="#tab-table5" data-tab="5" data-toggle="tab">Lương & Phụ cấp</a>

                <a class="nav-item nav-link" href="#tab-table6" data-tab="6" data-toggle="tab">Tiếp nhận</a>

                <a class="nav-item nav-link" href="#tab-table7" data-tab="7" data-toggle="tab">Thôi việc</a>

                <a class="nav-item nav-link" href="#tab-table8" data-tab="8" data-toggle="tab">Tài sản</a>

                <a class="nav-item nav-link" href="#tab-table9" data-tab="9" data-toggle="tab">Đính kèm(0)</a>

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
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip">
									  <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body fixscrollbar">
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="personnel_code">Mã nhân sự</label>
                                                    <input type="text" id="personnel_code" placeholder="Mã nhân sự" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="timekeeping_code">Mã chấm công</label>
                                                    <input type="text" name="timekeeping_code" id="timekeeping_code" placeholder="Mã chấm công" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="profile_code">Mã hồ sơ</label>
                                                    <input type="text" name="profile_code" id="profile_code" placeholder="Mã hồ sơ" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="full_name">Họ và tên</label>
                                            <input type="text" name="full_name" id="full_name" placeholder="Họ và tên" class="form-control form-control-sm">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="birthday">Ngày sinh</label>
                                                    <input type="text" name="birthday" id="birthday" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">Giới tính</label>
                                                    <input type="text" name="gender" id="gender" placeholder="Giới tính" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Place_birth">Nơi sinh</label>
                                            <input type="text" name="Place_birth" id="Place_birth" placeholder="Nơi sinh" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="domicile">Nguyên quán</label>
                                            <input type="text" name="domicile" id="domicile" placeholder="Nguyên quán" class="form-control form-control-sm">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="passport">CMT/Căn cước/Hộ Chiếu</label>
                                                    <input type="text" name="passport" id="passport" placeholder="1234567890" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_date">Ngày cấp</label>
                                                    <input type="text" name="passport_date" id="passport_date" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-4">
                                                <div class="form-group">
                                                    <label for="passport_place">Nơi cấp</label>
                                                    <input type="text" name="passport_place" id="passport_place" placeholder="Nơi cấp" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="marital_status">Tình trạng hôn nhân</label>
                                                    <input type="text" name="marital_status" id="marital_status" placeholder="Tình trạng hôn nhân" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="nationality">Quốc tịch</label>
                                                    <input type="text" name="nationality" id="nationality" placeholder="Quốc tịch" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="folk">Dân tộc</label>
                                                    <input type="text" name="folk" id="folk" placeholder="Dân tộc" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="religion">Tôn giáo</label>
                                                    <input type="text" name="religion" id="religion" placeholder="Tôn giáo" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="account_number">Số tài khoản</label>
                                                    <input type="text" name="account_number" id="account_number" placeholder="Số tài khoản" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="account_number">Tên tài khoản</label>
                                                    <input type="text" name="account_number" id="account_number" placeholder="Tên tài khoản" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_name">Ngân hàng</label>
                                                    <input type="text" name="bank_name" id="bank_name" placeholder="Ngân hàng" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="bank_branch">Chi nhánh</label>
                                                    <input type="text" name="bank_branch" id="bank_branch" placeholder="Chi nhánh" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="personal_tax_code">Mã số thuế cá nhân</label>
                                            <input type="text" name="personal_tax_code" id="personal_tax_code" placeholder="Mã số thuế cá nhân" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="rank">Cấp bậc</label>
                                            <input type="text" name="rank" id="rank" placeholder="Cấp bậc" class="form-control form-control-sm">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="high_school_education">Trình độ phổ thông</label>
                                                    <input type="text" name="high_school_education" id="high_school_education" placeholder="Trình độ phổ thông" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="highest_expertise">Chuyên môn cao nhất</label>
                                                    <input type="text" name="highest_expertise" id="highest_expertise" placeholder="Chuyên môn cao nhất" class="form-control form-control-sm">
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
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip">
									  <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Điện thoại</label>
                                            <input type="text" name="phone" id="phone" placeholder="Điện thoại" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" placeholder="Email" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="resident">Thường trú</label>
                                            <input type="text" name="resident" id="resident" placeholder="Thường trú" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="address1">Địa chỉ 1</label>
                                            <input type="text" name="address1" id="address1" placeholder="Địa chỉ 1" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="current_accommodation">Chỗ ở hiện nay</label>
                                            <input type="text" name="current_accommodation" id="current_accommodation" placeholder="Thường trú" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="address2">Địa chỉ 2</label>
                                            <input type="text" name="address2" id="address2" placeholder="Địa chỉ 2" class="form-control form-control-sm">
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
										<div class="row">
                                            <div class="col-sm-1 col-md-1">
                                                <div class="form-group">
                                                    <label for="personnel_code">Mối quan hệ</label>
                                                    <select type="text" id="personnel_code" class="form-control form-control-sm">
														<option value="1">CHỌN </option>	
													</select>
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Họ và tên</label>
                                                    <input type="text" id="personnel_code" placeholder="Họ và tên" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-1 col-md-1">
                                                <div class="form-group">
                                                    <label for="personnel_code">Ngày sinh</label>
                                                    <input type="text" id="personnel_code" placeholder="Ngày sinh" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Nghề nghiệp</label>
                                                    <input type="text" id="personnel_code" placeholder="Nghề nghiệp" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Địa chỉ</label>
                                                    <input type="text" id="personnel_code" placeholder="Địa chỉ" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Điện thoại</label>
                                                    <input type="text" id="personnel_code" placeholder="Điện thoại" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Người phụ thuộc</label>
                                                    <input type="text" id="personnel_code" placeholder="Người phụ thuộc" class="form-control form-control-sm">
                                                </div>
                                            </div>
											
										</div>
									
									
										<a href="#" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
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
										<div class="row">
                                            <div class="col-sm-1 col-md-1">
                                                <div class="form-group">
                                                   <div class="form-group">
														<label for="personnel_code">Từ tháng</label>
														<input type="text" id="personnel_code" placeholder="Từ tháng" class="form-control form-control-sm">
													</div>
                                                </div>
                                            </div>
											<div class="col-sm-1 col-md-1">
                                                <div class="form-group">
                                                    <label for="personnel_code">Đến tháng</label>
                                                    <input type="text" id="personnel_code" placeholder="Đến tháng" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="personnel_code">Hình thức đào tạo</label>
													<select type="text" id="personnel_code" class="form-control form-control-sm">
														<option value="1">CHỌN </option>	
													</select>                                                
												</div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Chuyên ngành</label>
                                                    <input type="text" id="personnel_code" placeholder="Chuyên ngành" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Trình độ học vấn</label>
                                                    <input type="text" id="personnel_code" placeholder="Trình độ học vấn" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="personnel_code">Nơi đào tạo</label>
                                                    <input type="text" id="personnel_code" placeholder="Nơi đào tạo" class="form-control form-control-sm">
                                                </div>
                                            </div>

										</div>
									
									
										<a href="#" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
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
										<div class="row">
                                            <div class="col-sm-1 col-md-1">
                                                <div class="form-group">
                                                   <div class="form-group">
														<label for="personnel_code">Từ tháng</label>
														<input type="text" id="personnel_code" placeholder="Từ tháng" class="form-control form-control-sm">
													</div>
                                                </div>
                                            </div>
											<div class="col-sm-1 col-md-1">
                                                <div class="form-group">
                                                    <label for="personnel_code">Đến tháng</label>
                                                    <input type="text" id="personnel_code" placeholder="Đến tháng" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-3 col-md-3">
                                                <div class="form-group">
                                                    <label for="personnel_code">Công ty</label>
													<input type="text" id="personnel_code" placeholder="Công ty" class="form-control form-control-sm">
                                                                                                
												</div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Vị trí</label>
                                                    <input type="text" id="personnel_code" placeholder="Vị trí" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Người tham chiếu</label>
                                                    <input type="text" id="personnel_code" placeholder="Trình độ học vấn" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-1 col-md-1">
                                                <div class="form-group">
                                                    <label for="personnel_code">Điện thoại</label>
                                                    <input type="text" id="personnel_code" placeholder="Điện thoại" class="form-control form-control-sm">
                                                </div>
                                            </div>
											<div class="col-sm-2 col-md-2">
                                                <div class="form-group">
                                                    <label for="personnel_code">Mô tả công việ</label>
                                                    <input type="text" id="personnel_code" placeholder="Mô tả công việ" class="form-control form-control-sm">
                                                </div>
                                            </div>

										</div>
 
										<a href="#" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
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
                                        <h3 class="card-title">Công việc</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip">
									  <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Phòng ban</label>
                                            <input type="text" name="phone" id="phone" placeholder="Điện thoại" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Vị trí</label>
                                            <input type="text" name="email" id="email" placeholder="Email" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="resident">Chức vụ</label>
                                            <input type="text" name="resident" id="resident" placeholder="Thường trú" class="form-control form-control-sm">
                                        </div>
										 <div class="row">
                             
											<div class="col-md-6">
												 <div class="form-group">
													<label for="address1">Ngày vào</label>
													<input type="text" name="address1" id="address1" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-6">
												 <div class="form-group">
													<label for="address1">Ngày vào chính thức</label>
													<input type="text" name="address1" id="address1" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
												</div>
											</div>
										</div>
                                       
                                       <div class="form-group">
											<label for="address2">Nơi làm việc</label>
											<input type="text" name="address2" id="address2" placeholder="Nơi làm việc" class="form-control form-control-sm">
										</div>
                                       

                                    </div>
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class="card">
                                    <div class="card-header padding6-10">
                                        <h3 class="card-title">Lương & Phụ cấp</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip">
									  <i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="phone">Từ này</label>
                                            <input type="text" name="phone" id="phone" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Hình thức lương</label>
                                            <input type="text" name="email" id="email" placeholder="Hình thức lương" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="resident">Số tiền</label>
                                            <input type="text" name="resident" id="resident" placeholder="Số tiền" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="address1">Ghi chú</label>
                                            <input type="text" name="address1" id="address1" placeholder="Ghi chú" class="form-control form-control-sm">
                                        </div>
										<div class="row">
                             
											<div class="col-md-6">
												<div class="form-group">
													<label for="current_accommodation">Phụ cấp</label>
													<input type="text" name="current_accommodation" id="current_accommodation" placeholder="Thường trú" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="address2">Tiền phụ cấp</label>
													<input type="text" name="address2" id="address2" placeholder="Tiền phụ cấp" class="form-control form-control-sm">
												</div>

											</div>
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
													<label for="phone">Số sổ bảo hiểm</label>
													<input type="text" name="phone" id="phone" placeholder="Điện thoại" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="email">Trạng thái sổ</label>
													<select type="text" id="personnel_code" class="form-control form-control-sm">
														<option value="1">CHỌN </option>	
													</select>
												</div>
											</div>
										</div>
                                        <div class="form-group">
                                            <label for="resident">Pháp nhân đóng</label>
                                            <select type="text" id="personnel_code" class="form-control form-control-sm">
												<option value="1"> Chọn pháp nhân </option>	
											</select>
                                        </div>
										 <div class="row">
                             
											<div class="col-md-6">
												 <div class="form-group">
													<label for="address1">Số thẻ BHYT</label>
													<input type="text" name="address1" id="address1" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-md-6">
												 <div class="form-group">
													<label for="address1">Mã cấp tỉnh</label>
													<input type="text" name="address1" id="address1" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
												</div>
											</div>
										</div>
                                       
                                       <div class="form-group">
											<label for="address2">Đăng ký khám chữa bệnh</label>
											<select type="text" id="personnel_code" class="form-control form-control-sm">
												<option value="1"> Chọn nơi khám </option>	
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
										<h3 class="card-title">Lịch sử đóng bảo hiểm</h3>

										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" ><i class="fas fa-minus"></i></button>
										</div>
									</div>
									<div class="card-body padding10">
										<div class="row">
											<div class="col-sm-1 col-md-1">
												<div class="form-group">
												   <div class="form-group">
														<label for="personnel_code">Từ tháng</label>
														<input type="text" id="personnel_code" placeholder="Từ tháng" class="form-control form-control-sm">
													</div>
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">Hình thức</label>
													<select type="text" id="personnel_code" class="form-control form-control-sm">
														<option value="1">CHỌN </option>	
													</select>
												</div>
											</div>
											<div class="col-sm-3 col-md-3">
												<div class="form-group">
													<label for="personnel_code">Lý do</label>
													<select type="text" id="personnel_code" class="form-control form-control-sm">
														<option value="1">CHỌN </option>	
													</select>
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">Mức đóng bảo hiểm</label>
													<input type="text" id="personnel_code" placeholder="Nhập..." class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">CT đóng</label>
													<input type="text" id="personnel_code" placeholder="Trình độ học vấn" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">NLD đóng</label>
													<input type="text" id="personnel_code" placeholder="Điện thoại" class="form-control form-control-sm">
												</div>
											</div>
											 

										</div>
 
										<a href="#" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
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
										<div class="row">
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">Hình thức</label>
													<select type="text" id="personnel_code" class="form-control form-control-sm">
														<option value="1">CHỌN </option>	
													</select>
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
												   <div class="form-group">
														<label for="personnel_code">Ngày nhận hồ sơ</label>
														<input type="text" id="personnel_code" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
													</div>
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
												   <div class="form-group">
														<label for="personnel_code">Ngày hoàn thiện thủ tục</label>
														<input type="text" id="personnel_code" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
													</div>
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
												   <div class="form-group">
														<label for="personnel_code">Ngày nhận tiền BH trả</label>
														<input type="text" id="personnel_code" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
													</div>
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
												   <div class="form-group">
														<label for="personnel_code">Ngày trả chế độ</label>
														<input type="text" id="personnel_code" placeholder="dd/mm/YYYY" class="form-control form-control-sm">
													</div>
												</div>
											</div>
 
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">Số tiền</label>
													<input type="text" id="personnel_code" placeholder="Nhập..." class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">CT đóng</label>
													<input type="text" id="personnel_code" placeholder="Trình độ học vấn" class="form-control form-control-sm">
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label for="personnel_code">NLD đóng</label>
													<input type="text" id="personnel_code" placeholder="Điện thoại" class="form-control form-control-sm">
												</div>
											</div>
											 

										</div>
 
										<a href="#" class="btn btn-inline btn-success btn-xs"><i class="fas fa-plus-circle"></i></a>
									</div>
								</div>
							</div>
						</div>
							
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table4">
                    <div class="card-body">
                        TAB 4
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table5">
                    <div class="card-body">
                        TAB 5
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table6">
                    <div class="card-body">
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover1"> <label for="takeover1"></label> CMT/Căn Cước/Hộ chiếu</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover2"> <label for="takeover2"></label> Tạo tài khoản</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover3"> <label for="takeover3"></label> Sơ yếu lý lịch</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover4"> <label for="takeover4"></label> Bằng cấp, Trình độ chuyên môn</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover6"> <label for="takeover6"></label> Giấy khám sức khỏe</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover7"> <label for="takeover7"></label> Ảnh cá nhân</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover8"> <label for="takeover8"></label> Bản sao giấy khai sinh</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="takeover9"> <label for="takeover9"></label> Bản sao hộ khẩu</div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table7">
                    <div class="card-body">
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="quitjob1"> <label for="quitjob1"></label> Bàn giao công việc</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="quitjob2"> <label for="quitjob2"></label> Thanh toán công nợ</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="quitjob3"> <label for="quitjob3"></label> Chốt và trả sổ bảo hiểm</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="quitjob4"> <label for="quitjob4"></label> Khóa tài khoản email</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="quitjob6"> <label for="quitjob6"></label> Khóa tài khoản Office</div>
                        <div class="icheck-danger checkbox"><input type="checkbox" value="1" name="" id="quitjob7"> <label for="quitjob7"></label> Bàn giao tài sản</div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table8">
                    <div class="card-body">
                        TAB 8
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-table9">
                    <div class="card-body">
                        TAB 9
                    </div>
                </div>
            
				<div class="card-body paddinglr15">
					<div class="row">
						<div class="col-12">
							<a href="#" class="btn btn-secondary">Hủy</a>
							<input type="submit" value="Thêm nhân sự" class="btn btn-success float-right">
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<script>
 
$(function () {
 
	$('a[data-toggle="tab"]').on('click', function(){
		 
	});
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	  
	});
 
});
</script>
<!-- END: main -->

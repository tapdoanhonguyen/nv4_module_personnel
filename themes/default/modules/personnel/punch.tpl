<!-- BEGIN: main -->
                             




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


							  
							 
							  <div role="dialog" class="oxd-overlay oxd-overlay--flex oxd-overlay--flex-centered oxd-overlay--hide oxd-layout-overlay" data-v-fa3720ff="" data-v-130c27f5="">
							  </div>
							  <div class="oxd-layout-context" data-v-130c27f5="">
							  <div class="orangehrm-background-container">
							  <div class="orangehrm-card-container">
							  <h6 class="oxd-text oxd-text--h6 orangehrm-main-title" data-v-7b563373="">{ACTION_LOGIN} ( * Yêu cầu) </h6>
							  <hr class="oxd-divider" role="separator" aria-orientation="horizontal" data-v-9f847659="">
							  
							  <div class="orangehrm-paper-container">
							  <form class="oxd-form" novalidate="" data-v-d5bfe35b="" data-v-3d5e6918="" method="post" id="checkin">
							  <input type="hidden" name="idlogin" value="{IDLOGIN}" style="display:none">
							  <input type="hidden" name="userid" value="{USER.id}" style="display:none">
							  <input type="text" name="typelogin" id="typelogin" value="{TYPELOGIN}" style="display:none">
							  <input type="text" name="lat" id="lat" value="" style="display:none">
							  <input type="text" name="lng" id="lng" value="" style="display:none">
							  <input type="text" name="address" id="address" value="" style="display:none">
							  <input type="text" name="imgdata" id="imgdata" value="" style="display:none">
							  <input type="submit" name="submit" id="checkinsubmit" style="display:none" value="Save">
							  <div class="oxd-form-row" data-v-2130bd2a="" data-v-3d5e6918="">
							  <div class="oxd-grid-2 orangehrm-full-width-grid" data-v-d7b71de4="" data-v-3d5e6918="">
							  <div class=" ">
							  <video id="video" width="640" height="480" autoplay></video>
							  </div>
							  
							  
							  <div class=" ">
								<div class="oxd-grid-1 orangehrm-full-width-grid" data-v-d7b71de4="" data-v-3d5e6918="">
								  <div class="oxd-grid-item oxd-grid-item--gutters --offset-row-4" data-v-c93bdbf3="" data-v-3d5e6918="">
								  <div class="oxd-input-group oxd-input-field-bottom-space" data-v-957b4417="" data-v-3d5e6918="">
								  <div class="oxd-input-group__label-wrapper" data-v-957b4417="">
								  <label class="oxd-label oxd-input-field-required" data-v-30ff22b1="" data-v-957b4417="">Ngày</label>
								  </div>
								  <div class="" data-v-957b4417="">
								  <div class="oxd-date-wrapper" data-v-4a95a2e0="">
								  <div class="oxd-date-input" data-v-4a95a2e0="">
								  <input class="oxd-input oxd-input--active" disabled="" placeholder="{DATA.punch_date}" data-v-1f99f73c="" data-v-4a95a2e0="">
								  <i class="oxd-icon bi-calendar oxd-date-input-icon --disabled" data-v-bddebfba="" data-v-4a95a2e0=""></i>
								  </div>
								  
								  </div>
								  </div>
								  <div class="oxd-input-group__label-wrapper" data-v-957b4417="">
								  <label class="oxd-label" data-v-30ff22b1="" data-v-957b4417="">Tại địa điểm </label>
								  </div>
								  <div class="" data-v-957b4417="">
								  <select class="form-control" name="locationid" id="locationid">
										<!-- BEGIN: location -->
										<option value="{LOCATION.key}" {LOCATION.selected}>{LOCATION.title}</option>
										<!-- END: location -->
									</select>
								  </div>
								  <div class="oxd-input-group__label-wrapper" data-v-957b4417="">
								  <label class="oxd-label" data-v-30ff22b1="" data-v-957b4417="">Ghi chú </label>
								  </div>
								  <div class="" data-v-957b4417="">
								  <textarea class="oxd-textarea oxd-textarea--active oxd-textarea--resize-vertical" placeholder="Type here" data-v-bd337f32="" name="note">
								  </textarea>
								  </div>
								  <div class="row">
									<span id="addressdetail" ></span>
								 </div>
								  </div>
								  
								  </div>
							  </div>
							  </div>
							  </div>
							  <div>
							   <div id="map" style="height: 400px;"></div>
								 
							  </div>
							  </div>
							  
							  <div class="oxd-form-row" data-v-2130bd2a="" data-v-3d5e6918="">
							  <div class="oxd-grid-4 orangehrm-full-width-grid" data-v-d7b71de4="" data-v-3d5e6918="">
							  <div class="oxd-grid-item oxd-grid-item--gutters --span-column-2" data-v-c93bdbf3="" data-v-3d5e6918="">
							  <div class="oxd-input-group oxd-input-field-bottom-space" data-v-957b4417="" data-v-3d5e6918="">
							  
							  
							  </div>
							  </div>
							  </div>
							  
							  </div>
							  
							  </form>
							  <hr class="oxd-divider" role="separator" aria-orientation="horizontal" data-v-9f847659="" data-v-3d5e6918="">
							  <div class="oxd-form-actions" data-v-19c2496b="" data-v-3d5e6918="">
							  
							  <button id="capturein"  >{ACTION_LOGIN}</button>
							  </div>
							  </div>
							  </div>
							  </div>
							  </div>
							  
							  
							  
							  
	 <script>
      $(document).ready(function() {
        // Lấy camera được liệt kê đầu tiên của thiết bị
        navigator.mediaDevices.getUserMedia({ 
          audio: false,
          video: { 
            width: 640, height: 480 
          }
        })
        .then(function(stream) {
          var video = document.getElementById('video');
          // Thiết lập stream để hiển thị ảnh từ camera
          video.srcObject = stream;
          video.play();
         
          // Bắt sự kiện click vào nút chụp ảnh
          $('#capturein').click(function(){
            // Sử dụng thư viện ImageMagick để xử lý hình ảnh
				var canvas = document.createElement('canvas');
				canvas.width = video.videoWidth;
				canvas.height = video.videoHeight;
				var ctx = canvas.getContext('2d');
				ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
				var imgdata = canvas.toDataURL();
				$('#imgdata').val('');
				$('#imgdata').val(imgdata);
				$('#typelogin').val({TYPELOGIN});
				$('#checkinsubmit').click();
				
          });
		 
		  <!-- BEGIN: jvcheckout1 -->
		   // Bắt sự kiện click vào nút chụp ảnh
          $('#captureout1').click(function(){
            // Sử dụng thư viện ImageMagick để xử lý hình ảnh
				var canvas = document.createElement('canvas');
				canvas.width = video.videoWidth;
				canvas.height = video.videoHeight;
				var ctx = canvas.getContext('2d');
				ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
				var imgdata = canvas.toDataURL();
				$('#imgdata').val('');
				$('#imgdata').val(imgdata);
				$('#typelogin').val(1);
				$('#checkinsubmit').click();
				
          });
		  <!-- END: jvcheckout1 -->
		  <!-- BEGIN: jvcheckin2 -->
		   // Bắt sự kiện click vào nút chụp ảnh
          $('#capturein2').click(function(){
            // Sử dụng thư viện ImageMagick để xử lý hình ảnh
				var canvas = document.createElement('canvas');
				canvas.width = video.videoWidth;
				canvas.height = video.videoHeight;
				var ctx = canvas.getContext('2d');
				ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
				var imgdata = canvas.toDataURL();
				$('#imgdata').val('');
				$('#imgdata').val(imgdata);
				$('#typelogin').val({TYPELOGIN});
				$('#checkinsubmit').click();
				
          });
		  <!-- END: jvcheckin2 -->
		  <!-- BEGIN: jvcheckout2 -->
		   // Bắt sự kiện click vào nút chụp ảnh
          $('#captureout2').click(function(){
            // Sử dụng thư viện ImageMagick để xử lý hình ảnh
				var canvas = document.createElement('canvas');
				canvas.width = video.videoWidth;
				canvas.height = video.videoHeight;
				var ctx = canvas.getContext('2d');
				ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
				var imgdata = canvas.toDataURL();
				$('#imgdata').val('');
				$('#imgdata').val(imgdata);
				$('#typelogin').val(1);
				$('#checkinsubmit').click();
				
          });
		  <!-- END: jvcheckout2 -->
		  // Bắt sự kiện click vào nút savecheck
          
        })
        .catch(function(err) {
          console.log(err);
        });
		
		
      });

    </script>
	
	<script src="https://maps.googleapis.com/maps/api/js?key={GOGGLEMAP_API}&callback=initMap" async defer></script>
    <script>
      var map;

      function initMap() {
        // Khởi tạo bản đồ và vị trí mặc định
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 0, lng: 0},
          zoom: 8
        });

        // Lấy vị trí của người dùng hiện tại
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
			console.log(position.coords.latitude);
					console.log(position.coords.longitude);
			$('#lat').val(position.coords.latitude);
			$('#lng').val(position.coords.longitude);
            // Đặt marker tại vị trí của người dùng
            var marker = new google.maps.Marker({
              position: pos,
              map: map,
              title: 'Check-in location'
            });

            // Lấy thông tin chi tiết về địa điểm
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': pos}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                  console.log(results[0].formatted_address);
				  
					$('#address').val(results[0].formatted_address);
					$('#addressdetail').html(results[0].formatted_address);
					console.log(position.coords.latitude);
					console.log(position.coords.longitude);
                  // Lưu thông tin chi tiết về địa điểm vào cơ sở dữ liệu
                  // ...

                } else {
                  console.log('No results found');
                }
              } else {
                console.log('Geocoder failed due to: ' + status);
              }
            });

            // Đặt center của bản đồ vào vị trí của người dùng
            map.setCenter(pos);
            map.setZoom(15);
          }, function() {
            console.log("Geolocation failed");
          });
        } else {
          console.log("Geolocation not supported by this browser");
        }
      }
    </script>						  
<!-- END: main -->
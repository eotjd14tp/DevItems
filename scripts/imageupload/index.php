<?php
  // 이미지 실시간 업로드 소스
  // 사용 기능 : 이미지 실시간 업로드, 이미지 업로드 미리보기
  // 필요 플러그인 : jQuery
?>
<form id="frm">
  <input type="file" name="" id="up_file" />
  <div class="imgBox">
  </div>
</form>

<script>
   $(function() {
		$(document).on('change', 'input#up_file', function(e) {
			// 실시간 이미지 미리보기 해야하면 이거 활용
			var files = e.target.files;
			var filesArr = Array.prototype.slice.call(files);
			var base = $(this);
			var realfile = base[0].files[0];
			// 여기까지
			// console.log($(this)[0].files[0]);
			// 폼에 넣어서 ajax로 업로드
			var form = $('#frm');
			var formData = new FormData(form[0]);
			formData.append('reg_image', realfile);
			formData.append('reg_dir', 'registration');

			$.ajax({
				type: 'POST',
				dataType: 'JSON',
				data: formData,
				contentType: false,
				processData: false,
				url: '/uploads/ajax_upload.php',
				success: function(req) {
					var file_name = req.fileName;
					var target = base.parents('td').find('input[name="regi_ori_file[]"]');

					target.val(file_name);
					// 업로드한 이미지 실시간으로 미리보기하는 기능 추가
					if (files && realfile) {
						var reader = new FileReader();
						reader.onload = function(e) {
							console.log(e);
							var img = '<img src="'+ e.target.result +'" alt="" style="max-width: 150px; max-height: 100px;" />';
							base.parents('form').find('div.imgBox').html(img);
							// document.getElementById('preview').src = e.target.result;
						};
						reader.readAsDataURL(realfile);
					} else {
						// document.getElementById('preview').src = "";
					}
				},
				error: function(error) {
					console.log(error);
				}
			})
		});
	})
</script>

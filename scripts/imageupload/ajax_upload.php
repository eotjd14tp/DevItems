<?php
  // ajax로 이미지 실시간 업로드 처리페이지
	// 파일 업로드 할때 temp 받은걸 지정한 경로에 업로드 시켜줌

$returnArr = array();
	$baseDir = $_POST['reg_dir']; // 업로드 할 경로
//	$this->load->library('upload'); // 라이브러리 호출이 안되는 관계로 수동으로 업로드

	$item = '';
	$upload_path = $baseDir.'/';


	if (is_dir($upload_path) === false) {

		mkdir($upload_path, 0777);
		$file = $upload_path . 'index.php';
		$f = @fopen($file, 'w');
		@fwrite($f, '');
		@fclose($f);
		@chmod($file, 0644);
	}

	$upload_path .= date('Y') . '/';
	if (is_dir($upload_path) === false) {
		mkdir($upload_path, 0777);
		$file = $upload_path . 'index.php';
		$f = @fopen($file, 'w');
		@fwrite($f, '');
		@fclose($f);
		@chmod($file, 0644);
	}

	$upload_path .= date('m') . '/';
	if (is_dir($upload_path) === false) {
		mkdir($upload_path, 0777);
		$file = $upload_path . 'index.php';
		$f = @fopen($file, 'w');
		@fwrite($f, '');
		@fclose($f);
		@chmod($file, 0644);
	}

	$file_name = $_FILES['reg_image']['name'];
	$file_parts = pathinfo($file_name);
	$file_extension = $file_parts['extension']; // 파일 확장자
	$file_realname = time().'.'.$file_extension;
	$file_size = $_FILES['reg_image']['size']; // 파일 사이즈
	$tmp_file = $_FILES['reg_image']['tmp_name']; // 파일 실제이름


	$file_path = $upload_path.$file_realname;
	$r = move_uploaded_file($tmp_file, $file_path);
//	$this->upload->initialize($uploadconfig);

//	$img = $this->upload->data();
	$updatephoto = date('Y') . '/' . date('m') . '/' . $file_realname;

	$returnArr = array(
		'realName' => $file_name,
		'fileName' => $updatephoto,
		'filesize' => $file_size,
		'extension' => $file_extension
	);

	echo json_encode($returnArr);

?>

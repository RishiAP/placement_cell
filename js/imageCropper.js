$(document).ready(function(){

	var $modal = $('#imageCroppingModal');

	var image = document.getElementById('sample_image');

	var cropper;

	$('#upload_image').on('input',function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
      document.getElementById('imageCroppingModal').classList.remove('fade');
      document.getElementById('imageCroppingModal').classList.add('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 2,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
       document.getElementById('imageCroppingModal').classList.remove('show');
      document.getElementById('imageCroppingModal').classList.add('fade');
       $('#upload_image').val(null);
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				$.ajax({
					url:'/placement_cell/partials/_set_image.php',
					method:'POST',
					data:{image_data:base64data},
					success:function(data)
					{
						if(data==="banned"){
							window.location.href="/placement_cell/student_login.php";
						}
						else{
						$modal.modal('hide');
						$('#user_profile_photo').attr('src', data);
						document.getElementById('menuProfileImage').src=data;
						document.getElementById('profileImageAlterChoiceModalCloseBtn').click();
						document.getElementById('askRemoveProfilePhotoBtn').style.display="block";
						document.getElementById('changeProfilePhotoBtn').innerText="Change Photo";
						}
					}
				});
			};
		});
	});
	
});
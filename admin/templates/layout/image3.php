<div class="photoUpload-zone">
	<div class="photoUpload-detail" id="photoUpload-preview3">
		<img class="rounded" src="<?=$photoDetail3?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo" style="<?=$config['news'][$type]['css_hinh']?>"/>
	</div>
	<label class="photoUpload-file" id="photo-zone3" for="file-zone3">
		<input type="file" name="file3" id="file-zone3">
		<i class="fas fa-cloud-upload-alt"></i>
		<p class="photoUpload-drop">Kéo và thả hình vào đây</p>
		<p class="photoUpload-or">hoặc</p>
		<p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
	</label>
	<div class="photoUpload-dimension"><?=@$dimension3?></div>
</div>
(function(){
	var oldData;
	var html = '';
	html += '<a class="diy export" data-type="json">导出json</a>',
	html += '<a class="diy export" data-type="md">导出md</a>',
	html += '<a class="diy export" data-type="km">导出km</a>',
	html += '<button class="diy input">',
	html += '导入<input type="file" id="fileInput">',
	html += '</button>';
	html += '<a class="diy haha" data-type="json">DDRR</a>',
		html += '<a class="diy save" data-type="json">BBCC</a>',

	$('.editor-title').append(html);

	$('.diy').css({
		// 'height': '30px',
		// 'line-height': '30px',
		'margin-top': '0px',
		'float': 'right',
		'background-color': '#fff',
		'min-width': '60px',
		'text-decoration': 'none',
		color: '#999',
		'padding': '0 10px',
		border: 'none',
		'border-right': '1px solid #ccc',
	});
	$('.input').css({
		'overflow': 'hidden',
		'position': 'relative',
	}).find('input').css({
		cursor: 'pointer',
		position: 'absolute',
		top: 0,
		bottom: 0,
		left: 0,
		right: 0,
		display: 'inline-block',
		opacity: 0
	});
	$('.export').css('cursor','not-allowed');

	var content = '{"root":{"data":{"id":"bk0kzjaj9i80","created":1521021118005,"text":"中心主题"},"children":[{"data":{"id":"bk0kzs18ffc0","created":1521021137034,"text":"分支主题","priority":7,"font-size":24},"children":[]},{"data":{"id":"bk0l0hkgkq00","created":1521021192616,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0hs4yzk0","created":1521021193080,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0ij166o0","created":1521021194707,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0iljceg0","created":1521021194858,"text":"分支主题"},"children":[{"data":{"id":"bk0l0jpui5s0","created":1521021197296,"text":"分支主题","expandState":"expand"},"children":[{"data":{"id":"bk0l0l3gue80","created":1521021200296,"text":"分支主题","expandState":"expand"},"children":[{"data":{"id":"bk0l0m89s800","created":1521021202763,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0n04q3k0","created":1521021204448,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0nnyxbk0","created":1521021205889,"text":"分支主题"},"children":[]}]}]}]},{"data":{"id":"bk0ogzxt59c0","created":1521030949762,"text":"1111111111111"},"children":[]},{"data":{"id":"bk0l0io5w6w0","created":1521021195017,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0iqgsio0","created":1521021195156,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0isv8340","created":1521021195301,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0i3xnjs0","created":1521021193794,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0i66enc0","created":1521021193929,"text":"分支主题"},"children":[]},{"data":{"id":"bk0l0c4p4yo0","created":1521021180779,"text":"分支主题"},"children":[]},{"data":{"id":"bk0kzsplxl40","created":1521021138508,"text":"分支主题","progress":9},"children":[]},{"data":{"id":"bk0l0cshz600","created":1521021182218,"text":"分支主题","expandState":"collapse"},"children":[{"data":{"id":"bk0l0ebe1gg0","created":1521021185537,"text":"分支主题"},"children":[]}]},{"data":{"id":"bk0l0d7c8d40","created":1521021183116,"text":"分支主题"},"children":[]},{"data":{"id":"bk0kzt9q4dc0","created":1521021139724,"text":"分支主题"},"children":[]},{"data":{"id":"bk0kztoqmi80","created":1521021140632,"text":"分支主题"},"children":[]}]},"template":"right","theme":"classic-compact","version":"1.4.33"}';
			
	$(document).on('click', '.haha', function(event) {
			
			editor.minder.importData('json', content).then(function(data){
					console.log(data)
					$(fileInput).val('');
				});
			
	});
	
	$(document).on('click', '.save', function(event) {
			//alert(21);
			
			editor.minder.exportData('json').then(function(data){
			content = data;
		});
			//console.log($.parseJSON(content));
	});
	
	$(document).on('mouseover', '.export', function(event) {
		// 链接在hover的时候生成对应数据到链接中
		event.preventDefault();
		var $this = $(this),
				type = $this.data('type'),
				exportType;
		switch(type){
			case 'km':
				exportType = 'json';
				break;
			case 'md':
				exportType = 'markdown';
				break;
			default:
				exportType = type;
				break;
		}
		if(JSON.stringify(oldData) == JSON.stringify(editor.minder.exportJson())){
			return;
		}else{
			oldData = editor.minder.exportJson();
		}

		editor.minder.exportData(exportType).then(function(content){
			switch(exportType){
				case 'json':
					console.log($.parseJSON(content));
					break;
				default:
					console.log(content);
					break;
			}
			$this.css('cursor', 'pointer');
			var blob = new Blob([content]),
					url = URL.createObjectURL(blob);
			var aLink = $this[0];
			aLink.href = url;
			aLink.download = $('#node_text1').text()+'.'+type;
		});
	}).on('mouseout', '.export', function(event) {
		// 鼠标移开是设置禁止点击状态，下次鼠标移入时需重新计算需要生成的文件
		event.preventDefault();
		$(this).css('cursor', 'not-allowed');
	}).on('click', '.export', function(event) {
		// 禁止点击状态下取消跳转
		var $this = $(this);
		if($this.css('cursor') == 'not-allowed'){
			event.preventDefault();
		}
	});

	// 导入
	window.onload = function() {
		var fileInput = document.getElementById('fileInput');

		fileInput.addEventListener('change', function(e) {
			var file = fileInput.files[0],
					// textType = /(md|km)/,
					fileType = file.name.substr(file.name.lastIndexOf('.')+1);
			console.log(file);
			switch(fileType){
				case 'md':
					fileType = 'markdown';
					break;
				case 'km':
				case 'json':
					fileType = 'json';
					break;
				default:
					console.log("File not supported!");
					alert('只支持.km、.md、.json文件');
					return;
			}
			var reader = new FileReader();
			reader.onload = function(e) {
				var content = reader.result;
				editor.minder.importData(fileType, content).then(function(data){
					console.log(data)
					$(fileInput).val('');
				});
			}
			reader.readAsText(file);
		});
		
		
		
	}

})();

function loadURL() {
	var url = (document.getElementById('proxyUrl').value.indexOf('www') == -1 && document.getElementById('proxyUrl').value.indexOf('http') == -1 ? 'www.' + document.getElementById('proxyUrl').value : document.getElementById('proxyUrl').value);
	var url = (url.indexOf('http') != -1 ? url : 'http://' + url);
	url = encodeURIComponent(url);
	window.location = '?url=' + url;
}
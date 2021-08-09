function Export(data) {
  var htmldiv = document.getElementById(data);
  var html = htmldiv.outerHTML;
  window.open("data:application/vnd.ms-excel," + encodeURIComponent(html));
}

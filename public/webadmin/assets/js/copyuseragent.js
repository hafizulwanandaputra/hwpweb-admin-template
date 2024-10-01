function copyUserAgent() {
  var copyText = document.getElementById("useragent");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
}

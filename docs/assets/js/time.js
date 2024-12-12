function startTime() {
	var today = new Date();
	var months = [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Agu",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	];
	var days = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
	var y = today.getFullYear();
	var month = months[today.getMonth()];
	var d = today.getDate();
	var day = days[today.getDay()];
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	d = checkTime(d);
	month = checkTime(month);
	h = checkTime(h);
	m = checkTime(m);
	s = checkTime(s);
	document.getElementById("tanggalwaktu").innerHTML =
		day + " " + d + " " + month + " " + y + " - " + h + "." + m + "." + s;
	var t = setTimeout(startTime, 1);
}
function checkTime(i) {
	if (i < 10) {
		i = "0" + i;
	} // add zero in front of numbers < 10
	return i;
}

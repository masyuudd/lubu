/* http://keith-wood.name/datepick.html
   Indonesian localisation for jQuery Datepicker.
   Written by Deden Fathurahman (dedenf@gmail.com). */
(function($) {
	$.datepick.regional['id'] = {
		monthNames: ['Januari','Februari','Maret','April','Mei','Juni', 'Juli','Agustus','September','Oktober','Nopember','Desember'],
		monthNamesShort: ['Jan','Feb','Mar','Apr','Mei','Jun', 'Jul','Ags','Sep','Okt','Nop','Des'],
		dayNames: ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
		dayNamesShort: ['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
		dayNamesMin: ['Mg','Sn','Sl','Rb','Km','Jm','Sb'],
		dateFormat: 'dd/mm/yyyy', firstDay: 0,
		renderer: $.datepick.defaultRenderer,
		prevText: '&#x3c; Mundur', prevStatus: 'Tampilkan bulan sebelumnya',
		prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
		nextText: 'Maju &#x3e;', nextStatus: 'Tampilkan bulan berikutnya',
		nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
		currentText: 'Hari ini', currentStatus: 'Tampilkan bulan sekarang',
		todayText: 'Hari ini', todayStatus: 'Tampilkan bulan sekarang',
		clearText: 'Hapus', clearStatus: 'Bersihkan tanggal pilihan',
		closeText: 'Tutup', closeStatus: 'Tutup tanpa mengubah',
		yearStatus: 'Tampilkan tahun yang berbeda', monthStatus: 'Tampilkan bulan yang berbeda',
		weekText: 'Mg', weekStatus: 'Minggu dalam tahun',
		dayStatus: 'Pilih DD, d MM', defaultStatus: 'Pilih Tanggal',
		isRTL: false
	};
	$.datepick.setDefaults($.datepick.regional['id']);
})(jQuery);

Array.prototype.chunk = function ( n ) {
    if ( !this.length ) {
        return [];
    }
    return [ this.slice( 0, n ) ].concat( this.slice(n).chunk(n) );
};
Number.prototype.formatNumber = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
$.prototype.loading = function(html = 'Waiting...') {
	$(this).attr('disabled','disabled').html('<i class="fa fa-spin fa-spinner"></i> '+html);
};
$.prototype.finish = function(html = 'Done' ) {
	$(this).removeAttr('disabled').html(html);
};
function showMessage(msg,className){
	toastr.options = {
		closeButton: true,
		progressBar: true,
		showMethod: 'slideDown',
		timeOut: 4000
	};
	switch(className)
	{
		case 'success':
			toastr.success(msg);
			break;
		case 'error':
			toastr.error(msg);
			break;
		case 'warning':
			toastr.warning(msg);
			break;
		case 'wait':
			toastr.info(msg);
			break;			
	}
};

function openPopup(field)
{
	 CKFinder.popup( '../../', null, null, function(url) {SetFileField3( url,field)} ) ;
}

function openPopup2()
{
	 CKFinder.popup( '../../', null, null, function(url) {} ) ;
}
function SetFileField( fileUrl )
{
	$('input[id="image"]').val(fileUrl);
}
function SetFileField3(fileUrl,id )
{
	$('#'+id).val(fileUrl);
	$('#'+id).parent().children('img').attr('src',fileUrl);
}
function stralias(nguon, dich)
{
    var str = ($('#'+nguon).val()).trim();
    str= str.toLowerCase();
    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
    str= str.replace(/đ/g,"d");
    str= str.replace(/!|@|\$|%|\^|\*|∣|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g,"-");
    str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
    str= str.replace(/^\-+|\-+$/g,"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
    var des = document.getElementById(dich);
    des.value = str;
}

function openhd(id)
{
	var win = window.open("http://admin.13thknight.com/system/libs/hdfinder/hdfinder.php?id="+id,"_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=0, width=1000, height=600");
	win.focus();
}
function setHD(id, fileUrl )
{
	$('#'+id).val(fileUrl);
	$('#'+id).trigger('change');
}
$(document).ready(function(){
    $( ".date" ).datepicker({dateFormat:'yy-mm-dd'});
	 $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
});
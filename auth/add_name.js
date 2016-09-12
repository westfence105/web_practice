function option_tag(type,selected){
	return '<option value="' + type + '"' + ( type == ( selected || 'given' ) ? 'selected' : '' ) + '>';
}

var name_count = 1;
function add_name( checked, selected_type ){
	var c = String( name_count );
	var div_element = document.createElement("div");
	div_element.innerHTML = '<select name="name' + c + '_type">' +
		option_tag( "family",		selected_type ) + '姓 (Family Name)'			+ '</option>' +
		option_tag( "given",		selected_type ) + '名 (Given Name)'			+ '</option>' +
		option_tag( "alias",		selected_type ) + '通称/字/仮名 (Alias)'		+ '</option>' +
		option_tag( "pseudonym", 	selected_type ) + '号 (Pseudonym)'			+ '</option>' +
		option_tag( "orig_surname", selected_type ) + '本姓 (Original Surname)'	+ '</option>' +
		'</select>' +
		'<input type="text" name="name' + c + '">' +
		'<input type="checkbox" name="name' + c + '_show" value="show" ' + ( checked ? 'checked' : '' ) + '>' +
		'';
	console.log(div_element.innerHTML);
	var parent = document.getElementById('names');
	console.log(parent);
	parent.appendChild( div_element );
	++name_count;
}

window.onload = function(){
	add_name(True);
	add_name(True,"given");
}
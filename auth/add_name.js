function option_tag(type,selected){
	var ret = '<option value="' + type + '"' + ( type == ( selected || 'given' ) ? 'selected' : '' ) + '>';
	return ret;
}

var name_count = 1;
function addName( selected_type ){
	var c = String( name_count );
	var div_element = document.createElement("div");
	div_element.id = "name[" + String( name_count ) + "]";
	div_element.setAttribute( "name", "name_div" );
	div_element.innerHTML = '<select name="name_type">' +
		option_tag( "family",		selected_type ) + '姓 (Family Name)'			+ '</option>' +
		option_tag( "given",		selected_type ) + '名 (Given Name)'			+ '</option>' +
		option_tag( "alias",		selected_type ) + '通称/字/仮名 (Alias)'		+ '</option>' +
		option_tag( "pseudonym", 	selected_type ) + '号 (Pseudonym)'			+ '</option>' +
		option_tag( "orig_surname", selected_type ) + '本姓 (Original Surname)'	+ '</option>' +
		'</select>' +
		'<input type="text" name="name" onchange="updateNamePreview()">' +
		'<select name="name_omit" value="abbreviate">' +
		'<input type="text" name="name_abbreviated" onchange="updateNamePreview()">' +
		'';
	var parent = document.getElementById('names');
	parent.appendChild( div_element );
	++name_count;
}

function genNameArray(){
	var ret = [];
	var div_list = document.getElementsByName('name_div');
	for( var i = 0; i < div_list.length; ++i ){
	//	console.log(div_list[i].innerHTML);
		var dict = {};
		for( var j = 0; j < div_list[i].children.length; ++j ){
			var child = div_list[i].children[j];
			dict[child.name] = child.value;
		}
		ret.push(dict);
		console.log(dict);
	}
	console.log(ret);
	for( var i = 0; i < ret.length; ++i ){
		console.log(ret[i]);
	}
	return ret;
}

function updateNamePreview(){
	var name_list = genNameArray();
	var html = '';
	for( var i = 0; i < name_list.length; ++i ){
		if( name_list[i]["name"] ){
			var name = name_list[i]["name"];
			if( name_list[i]["name_omit"] == "abbreviate" && name_list[i]["name_abbreviated"] ){
				name = name_list[i]["name_abbreviated"];
			}
			html += '<div class="name_preview">' + name + '<br/>' +
				'<span class="type">' +
				( name_list[i]["name_type"] ? name_list[i]["name_type"] : '' ) +
				'</span>'
				'</div>';
		}
	}

	var div_element = document.getElementById('name_preview');
	div_element.innerHTML = html;
}

function formatNames(){

}
/**
 * Base64编码转换
 * @author  1024tools.com
 */
var BASE64 = {
	encode: function(str) {
		var bin = UTF8BIN.utf82bin(str), s = '', pos = 0, result = '';
		while(s = bin.substr(pos * 24, 24)) {
			if (s.length == 8) {
				s += '0000';
				result += this._map[parseInt("00" + s.substr(0, 6), 2)];
				result += this._map[parseInt("00" + s.substr(6, 6), 2)];
				result += "==";
			} else if (s.length == 16) {
				s += '00';
				result += this._map[parseInt("00" + s.substr(0, 6), 2)];
				result += this._map[parseInt("00" + s.substr(6, 6), 2)];
				result += this._map[parseInt("00" + s.substr(12, 6), 2)];
				result += "=";
			} else if (s.length == 24) {
				result += this._map[parseInt("00" + s.substr(0, 6), 2)];
				result += this._map[parseInt("00" + s.substr(6, 6), 2)];
				result += this._map[parseInt("00" + s.substr(12, 6), 2)];
				result += this._map[parseInt("00" + s.substr(18, 6), 2)];
			}
			pos++;
		}
		return result;
	},
	decode: function(str) {
		var bin = '', pos = 0, result = '', s = '';
		while(pos < str.length) {
			s = str.charAt(pos);
			if (s == '=') {
				bin = bin.slice(0, -2);
			} else {
				bin += ("000000" + (this._map.indexOf(s)).toString(2)).slice(-6);
			}
			pos++;
		}
		return UTF8BIN.bin2utf8(bin);
	},
	_map: [
		"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
		"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
		"0","1","2","3","4","5","6","7","8","9","+","/"
	]
}

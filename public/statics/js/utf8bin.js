/**
 * UTF8编码的字符串与二进制串相互转换
 * @author  1024tools.com
 */
var UTF8BIN = {
	utf82bin: function(str) {
		var start = 0 , result = '', code;
		while(code = str.charCodeAt(start)) {
			var b = "000000000000000000000" + (code).toString(2)
			if (code <= 128) {
				result += b.slice(-8)
			} else if (code <= 2048) {
				result += "110" + b.substr(-11, 5) + "10" + b.substr(-6);
			} else if (code <= 65535) {
				result += "1110" + b.substr(-16, 4) + "10" + b.substr(-12, 6) + "10" + b.substr(-6);
			} else {
				result += "11110" + b.substr(-21, 3) + "10" + b.substr(-18, 6) + "10" + b.substr(-12, 6) + "10" + b.substr(-6);
			}
			start++;
		}
		return result;
	},

	bin2utf8: function(bin) {
		var result = '', prefix, pos = 0, bucket = "";
		while(pos < (bin.length)/8) {
			if ("0" == bin.substr(pos*8, 1)) {
				result += String.fromCharCode(parseInt(bin.substr(pos*8, 8), 2));
				pos++;
			} else if ("110" == bin.substr(pos*8, 3)) {
				bucket = bin.substr(pos*8, 16);
				result += String.fromCharCode(parseInt("" + bucket.substr(3, 5) + bucket.substr(10, 6), 2));
				pos += 2;
			} else if ("1110" == bin.substr(pos*8, 4)) {
				bucket = bin.substr(pos*8, 24);
				result += String.fromCharCode(parseInt("" + bucket.substr(4, 4) + bucket.substr(10, 6) + bucket.substr(18, 6), 2));
				pos += 3;
			} else if ("11110" == bin.substr(pos*8, 5)) {
				bucket = bin.substr(pos*8, 32);
				result += String.fromCharCode(parseInt("" + bucket.substr(5, 3) + bucket.substr(10, 6) + bucket.substr(18, 6) + bucket.substr(26, 6), 2));
				pos += 4;
			} else {
				throw new Error('bad param in bin2utf8')
			}
		}
		return result;
	}
}

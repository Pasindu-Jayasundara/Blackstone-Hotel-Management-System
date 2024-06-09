var Conclave = (function () {
	var buArr = [],
		arlen;

	return {
		init: function () {
			this.addCN();
			this.clickReg();
			this.auto(); // Add automatic carousel rotation
		},
		addCN: function () {
			var buarr = ["holder_bu_awayL3", "holder_bu_awayL2", "holder_bu_awayL1", "holder_bu_center", "holder_bu_awayR1", "holder_bu_awayR2", "holder_bu_awayR3"];
			for (var i = 1; i <= buarr.length; ++i) {
				document.getElementById("bu" + i).className = buarr[i - 1] + " holder_bu";
			}
		},
		clickReg: function () {
			var holderBuElements = document.getElementsByClassName("holder_bu");
			for (var i = 0; i < holderBuElements.length; ++i) {
				buArr.push(holderBuElements[i].className);
			}
			arlen = buArr.length;
			for (var i = 0; i < arlen; ++i) {
				buArr[i] = buArr[i].replace(" holder_bu", "");
			}
			var holderBuElements = document.getElementsByClassName("holder_bu");
			for (var i = 0; i < holderBuElements.length; ++i) {
				holderBuElements[i].addEventListener("click", function (buid) {
					var me = this,
						id = this.id || buid,
						joId = document.getElementById(id),
						joCN = joId.className.replace(" holder_bu", "");
					var cpos = buArr.indexOf(joCN),
						mpos = buArr.indexOf("holder_bu_center");
					if (cpos != mpos) {
						tomove = cpos > mpos ? arlen - cpos + mpos : mpos - cpos;
						while (tomove) {
							var t = buArr.shift();
							buArr.push(t);
							var holderBuElements = document.getElementsByClassName("holder_bu");
							for (var i = 0; i < holderBuElements.length; ++i) {
								holderBuElements[i].className = buArr[i] + " holder_bu";
							}
							--tomove;
						}
					}
				});
			}
		},
		auto: function () {
			var currentIndex = 1;
			var maxIndex = 7; // Assuming there are 7 images in the carousel

			setInterval(function () {
				var currentBu = document.getElementById("bu" + currentIndex);
				currentBu.click();

				currentIndex++;
				if (currentIndex > maxIndex) {
					currentIndex = 1;
				}
			}, 6000);
		},
	};
})();

document.addEventListener("DOMContentLoaded", function () {
	window["conclave"] = Conclave;
	Conclave.init();
});

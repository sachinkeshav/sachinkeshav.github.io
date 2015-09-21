(function() {
	"use strict";
	
	var accountInfoList = [];
	
	var accountObject = function(){
		var name;
		var balance;
		
		function getAccountInfo(){
			name = document.getElementById("account-name").value;
			balance = document.getElementById("deposit").value;
		}
		
		return {
			'newAccount': function(){
				getAccountInfo();
				accountInfoList.push(this);
			},
			'name': function() {
				return name;
			},
			'balance': function() {
				return balance;
			}
		};
	};
	
	function createNewAccount() {
		var account = accountObject();
		account.newAccount();
		var i = 0;
		var accountInfo = "";
		while(i < accountInfoList.length){
			accountInfo += "Account name: " + accountInfoList[i].name() + " Balance: " + accountInfoList[i].balance() + "\n" ;
			i++;
		}
		document.getElementById("text-area").innerHTML = accountInfo;
		document.getElementById("account-name").value = "";
		document.getElementById("deposit").value = "";
	}
	
	window.onload = function () {
		document.getElementById("button").onclick = createNewAccount;
	};
})();
<?php
// site setting
function getSetting($settingName = 'siteName')
{
	return \App\siteSetting::where('nameSetting', $settingName)->first()->value;
}


function encryptData($value)
{
	$encrypted = Crypt::encrypt($value);
	return $encrypted;
}

function decryptData($value)
{
	$decrypted = Crypt::decrypt($value);
	return $decrypted;
}

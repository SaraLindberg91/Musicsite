
function copyEditDeleteSongFormData(frmEditDeleteSong)
{
	document.getElementById("txtTitle").value = frmEditDeleteSong.hidTitle.value;
	document.getElementById("txtCount").value = frmEditDeleteSong.hidCount.value;
	document.getElementById("cboArtist").value = frmEditDeleteSong.hidArtistId.value;
	document.getElementById("hidId").value = frmEditDeleteSong.hidId.value;
	document.getElementById("hidSoundFileName").setAttribute("value", frmEditDeleteSong.hidSoundFileName.value);

 }


function verifyDeleteOfSong(frmEditDeleteSong)
{
	 return window.confirm("Vill du verkligen ta bort " + frmEditDeleteSong.hidTitle.value + "?");
}
	
	
function checkFileNameExtension(fileSoundFileName)
{
	var fileExtension = fileSoundFileName.substring(fileSoundFileName.length - 3);
	 fileExtension = fileExtension.toLowerCase();
	
	 if(fileExtension != "ogg")
	 {
	 window.alert("Felaktigt filformat! Endast .ogg accepteras.");
	 return false;
	}
	return true;
}


function validateNewUpdateSongFormData(frmNewUpdateSong)
{
	if(frmNewUpdateSong.cboArtist.value == "0")
	{
		window.alert("Ingen artist vald!");
		return false;
	}
	if(frmNewUpdateSong.txtTitle.value == "")
	 {
		 window.alert("Ange en låt!");
		 return false;
	 }
	 
	 if(frmNewUpdateSong.hidSoundFileName.value == "")
	 {
		if(frmNewUpdateSong.fileSoundFileName.value == "")
		{
			 window.alert("Ingen ljudfil vald!");
			 return false;
		}
	}

	if(frmNewUpdateSong.txtCount.value == "")
	{
	 	window.alert("Fyll i Count!");
	 	return false;
	}
	
	if(frmNewUpdateSong.hidSoundFileName.value == "")
	{
		if(!checkFileNameExtension(frmNewUpdateSong.fileSoundFileName.value))
		{
			return false;
		}
	}
	return true;
}


function resetNewUpdateSongFormData(frmNewUpdateSong)
{
	 frmNewUpdateSong.reset();
	 with (frmNewUpdateSong)
 {
 
 }
}

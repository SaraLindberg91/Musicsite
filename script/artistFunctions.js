
function verifyDeleteOfArtist(frmEditDeleteArtist)
{
 return window.confirm("Vill du verkligen ta bort " + frmEditDeleteArtist.hidArtist.value + "?");	
}

function copyEditDeleteArtistFormData(frmEditDeleteArtist)
{
	document.getElementById("txtArtist").value = frmEditDeleteArtist.hidArtist.value;
	document.getElementById("hidId").value = frmEditDeleteArtist.hidId.value;
	document.getElementById("hidPictureFileName").value = frmEditDeleteArtist.hidPictureFileName.value;
	document.getElementById("id").value = frmEditDeleteArtist.id.value;

}

function validateNewUpdateArtistFormData(frmNewUpdateArtist)
{
	if(frmNewUpdateArtist.txtArtist.value == "")
	 {
	 window.alert("Ange artist!");
	 return false;
	 }
	 
	 
	 	if(frmNewUpdateArtist.hidPictureFileName.value == "")
	 	{
			if(frmNewUpdateArtist.filePictureFileName.value == "")
			{
			window.alert("Ingen fil vald!");
			return false;
			}
		}
	if(frmNewUpdateArtist.hidPictureFileName.value == "")
	{	
		 if(!checkFileNameExtension(frmNewUpdateArtist.filePictureFileName.value))
		 {
		 	return false;
		 }
	 }
return true;
 }


function checkFileNameExtension(filePictureFileName)
{
	 var fileExtension = filePictureFileName.substring(filePictureFileName.length - 3);
	 fileExtension = fileExtension.toLowerCase();
	
	 if(frmNewUpdateArtist.hidPictureFileName.value == "")
	 {
	 if(fileExtension != "jpg")
	 {
	 window.alert("Felaktigt filformat! Endast .jpg accepteras.");
	 return false;
	 }
	 }

return true;
 }


function resetNewUpdateArtistFormData(frmNewUpdateArtist)
{
	 frmNewUpdateArtist.reset();
	 with (frmNewUpdateArtist)
	 {
	
	 }

}
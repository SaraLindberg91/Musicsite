function verifyDeleteOfComment(frmDeleteComment)
{
return window.confirm("Vill du verkligen ta bort " + frmDeleteComment.hidId.value + "?");
}
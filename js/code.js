function descriptionImg(){
    var ebooks = document.getElementsByClassName('desc');
    var ebookText;
    var limitText;
    //alert(ebooks.length)
    for (let i = 0; i < ebooks.length; i++) {
        ebookText = ebooks[i].innerText;
        limitText = ebookText.substr(0, 90) + '[...]';
        ebooks[i].innerHTML = limitText;
    }
}
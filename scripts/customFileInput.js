function updateFileName(input) {
    var fileName = input.files[0].name;
    var fileNameSpan = input.parentElement.querySelector('.file-name');
    fileNameSpan.innerHTML = fileName;
}
function get_image_name(filePath) {
    return filePath.substr(filePath.lastIndexOf('\\') + 1);
}

function show_image_name() {
    document.getElementById('outputFile').value = get_image_name(document.getElementById('inputFile2').value);
}
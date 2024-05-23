Filevalidation = () => {
    const fi = document.getElementById('manual');
    // Check if any file is selected.
    if (fi.files.length > 0) {
        for (const i = 0; i <= fi.files.length - 1; i++) {
            const fsize = fi.files.item(i).size;
            const file = Math.round((fsize / 1024));
            // The size of the file.
            if (file >= 6096) {
                alert(
                    "File too Big, please select a file less than 6mb");
                fi.value = "";
            } else {
                document.getElementById('size').innerHTML = '<b>' +
                    file + '</b> KB';
            }
        }
    }
}
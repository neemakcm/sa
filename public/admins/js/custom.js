$('#zero_configuration_table').dataTable({
    "lengthMenu": [5, 10, 25, 50, 75, 100]
});

$(document).ready(function() {
    //$('table.display').DataTable();
    $("#video_div").hide();

    // alert(1);


    // multi image uploader plugin
    $('.input-images').imageUploader({
        extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg', '.mp4'],
        mimes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
        maxSize: undefined,
        maxFiles: undefined,
    });
    $(".video-upload").change(function() {
        $("#video_div").show();
        var fileInput = document.getElementById('video_upload');
        var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
        $(".video").attr("src", fileUrl);
    });
});

/*document.querySelector("#file-upload").onchange = function() {
    document.querySelector("#file-name").textContent = this.files[0].name;
    document.querySelector("#file-name").style.display = "none";
    document.querySelector(".custom-file-label").textContent = this.files[0].name;
}*/



/*document.querySelector("#file-upload-1").onchange = function () {
    document.querySelector("#file-name-1").textContent = this.files[0].name;
    document.querySelector("#file-name-1").style.display = "none";
    document.querySelector(".custom-file-label").textContent = this.files[0].name;
}*/
// Date Picker
$('#simpledatepicker').datepicker({
    format: 'dd-mm-yyyy',
    autoClose: true
});
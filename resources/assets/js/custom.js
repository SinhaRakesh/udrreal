// "myAwesomeDropzone" is the camelized version of the HTML element's ID
Dropzone.options.myDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    maxFiles: 10,
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    headers: {
        "x-csrf-token": document.querySelectorAll("meta[name=csrf-token]")[0].getAttributeNode("content").value
    },
    init: function() {
        var myDropzone = Dropzone.forElement("#my-dropzone");
        myDropzone
            .on("removedfile", function(file) {
                $('#submit-form input[value="' + file.url + '"]').remove();
            })
            .on("success", function(file, response) {
                file.url = response.url;
                $("<input>")
                    .attr({
                        type: "hidden",
                        name: "images[]",
                        value: response.url
                    })
                    .appendTo("#submit-form");
            })
            .on("queuecomplete", function() {
                $("#submit-property-btn").removeAttr("disabled");
            })
            .on("sending", function() {
                $("#submit-property-btn").attr("disabled", "");
            });
        $("#submit-form input[name^=images]").each(function(i) {
            previewThumbailFromUrl({
                selector: "my-dropzone",
                fileName: "sample-Img-" + i,
                imageURL: $(this).val()
            });
        });
    }
};

function previewThumbailFromUrl(opts) {
    var imgDropzone = Dropzone.forElement("#" + opts.selector);
    var mockFile = {
        name: opts.fileName,
        size: 12345,
        accepted: true,
        kind: "image",
        url: opts.imageURL
    };
    imgDropzone.emit("addedfile", mockFile);
    imgDropzone.files.push(mockFile);
    imgDropzone.createThumbnailFromUrl(mockFile, opts.imageURL, function() {
        imgDropzone.emit("complete", mockFile);
    });
}
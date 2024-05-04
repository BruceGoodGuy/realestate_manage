@props(['selector'])
<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin" type="text/javascript"></script>
<script type="text/javascript">
    const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '{{ route('ajax.draftupload') }}');
        // xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.setRequestHeader("Accept", "application/json");
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute(
            'content'));

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (xhr.status === 403) {
                reject({
                    message: 'HTTP Error: ' + xhr.status,
                    remove: true
                });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });
    tinymce.init({
        selector: '{{ $selector }}', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists image fullscreen insertdatetime emoticons textcolor',
        image_class_list: [{
            title: 'img-responsive',
            value: 'img-responsive'
        }, ],
        // relative_urls: false,
        // remove_script_host: false,
        // convert_urls: true,
        toolbar: 'fullscreen | insertdatetime emoticons | undo redo | blocks | bold italic forecolor backcolor| alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link image',
        image_title: true,
        automatic_uploads: true,
        images_upload_handler: example_image_upload_handler,

    });
</script>

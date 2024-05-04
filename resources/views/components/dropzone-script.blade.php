@props(['selector', 'url', 'previewtemplate', 'name', 'oldpath', 'oldname'])
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('hidden')
    @if ($previewtemplate === false)
        <div id="hold-preview-template">
            <div class="form-group p-4 bg-border-gray-light d-sm-flex justify-content-between align-items-center rounded-10">
                <div class="d-sm-flex align-items-center mb-3 mb-sm-0 me-lg-3">
                    <div class="me-md-5 pe-xxl-5 mb-3 mb-sm-0">
                        <h4 class="body-font fs-15 fw-semibold text-body">Ảnh đại diện</h4>
                        <p>Hình này sẽ hiển thị trên app</p>
                    </div>
                    <div>
                        <img data-dz-thumbnail class="rounded-4 wh-78 ms-3 ms-lg-0" />
                        <p class="name" data-dz-name></p>
                    </div>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>

                <div class="d-flex ms-sm-3 ms-md-0">
                    <button type="button" class="btn bg-danger bg-opacity-10 text-danger fw-semibold"
                        data-dz-remove>Delete</button>
                </div>
            </div>
        </div>
    @endif
@endsection
<script type="text/javascript" src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js" derfer></script>
<script type="text/javascript">
    let fileData = [];
    let myDropzone = new Dropzone("{{ $selector }}", {
        url: "{{ $url }}",
        thumbnailWidth: 200,
        maxThumbnailFilesize: 5,
        maxFiles: 1,
        previewTemplate: document.querySelector(
            "{{ $previewtemplate !== false ? $previewtemplate : '#hold-preview-template' }}").innerHTML,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function(file, response) {
            fileData.push(response.path);
            console.log(document.querySelector('input[name="{{ $name }}"]'));
            console.log('input[name="{{ $name }}"]')
            document.querySelector('input[name="{{ $name }}"]').value = response.path;
            document.querySelector('input[name="{{ $name }}_name"]').value = file.name;
            const deleteFake = document.querySelector('#fake-{{ $name }} button');
            if (deleteFake) {
                const event = new Event('click');
                deleteFake.dispatchEvent(event);
                this.addFile(file);
            }
        },
        error: function(file, response) {
            file.previewElement.querySelector('strong[data-dz-errormessage]').textContent = response.message
            file.previewElement.querySelector('img[data-dz-thumbnail]').setAttribute('src',
                '{{ asset('assets/images/error.png') }}');
        },
        maxFiles: 1,
        init: function() {
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        },
        removedfile: function(file) {
            fetch("{{ route('ajax.deletefile') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    path: fileData.pop()
                }),
            })

            if (file.previewElement != null && file.previewElement.parentNode != null) {
                file.previewElement.parentNode.removeChild(file.previewElement);
            }
            return this._updateMaxFilesReachedClass();
        }

    });

    const deleteFake = document.querySelector('#fake-{{ $name }} button');
    if (deleteFake) {
        deleteFake.addEventListener('click', function(e) {
            this.closest('div#fake-{{ $name }}').remove();
            document.querySelector('input[name="{{ $name }}"]').value = '';
            document.querySelector('input[name="{{ $name }}_name"]').value = '';
            myDropzone.removeAllFiles();
            fetch('{{ route('ajax.deletefile') }}', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    path: "{{ $oldpath }}"
                }),
            });
        })
    }
</script>

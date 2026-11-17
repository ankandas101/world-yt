<meta name="csrf-token" content="{{ csrf_token() }}">

<div wire:ignore x-data x-init="window.initSummernote = function() {
    let initialValue = @js($getState());
    $('#summernote').summernote({
        height: 300,
        codemirror: {
            mode: 'text/html',
            htmlMode: true,
            lineNumbers: true,
            theme: 'monokai',
        },
        callbacks: {
            onImageUpload: function(files) {
                for (let i = 0; i < files.length; i++) {
                    uploadImage(files[i]);
                }
            },
            onChange: function(contents) {
                $wire.set(@js($getStatePath()), contents);
            }
        }
    });
    // Set value from Livewire
    $('#summernote').summernote('code', initialValue ?? '');
};
window.initSummernote();
Livewire.hook('message.processed', (message, component) => {
    window.initSummernote();
});">
    <style>
        .note-editor .modal-content {
            color: black !important;
        }

        .note-editable {
            color: black !important;
        }

        .note-editable image {
            margin: auto !important;
        }
    </style>

    <textarea id="summernote" name="content"></textarea>
</div>

@once
    @push('scripts')
        <!-- include libraries(jQuery, bootstrap) -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>
        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
        <script>
            function uploadImage(file) {
                let data = new FormData();
                data.append("image", file);
                $.ajax({
                    url: '{{route("summernote.image.upload")}}',
                    method: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#summernote').summernote('insertImage', response.url);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Image upload failed');
                    }
                });
            }
        </script>
    @endpush
@endonce

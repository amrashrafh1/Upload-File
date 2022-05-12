<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Album') }} : {{$album->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class='text-red-500 text-sm font-bold p-2'>{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                        <form method="post" action='{{route('albums.store')}}' enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h3 class="mt-4 gap-x-2 text-center">
                                    {{$album->name}} photos
                                </h3>
                                <div class="mt-4 gap-x-2">
                                    <div class='dropzone' id='file-dropzone'>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <script>
        Dropzone.options.fileDropzone = {
            url: '{{ route("albums.photos.store", $album->id) }}',
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            maxFilesize: 8,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() { 
                myDropzone = this;
                $.ajax({
                    url: '{{ route("albums.photos.index", $album->id) }}',
                    type: 'post',
                    data: {request: 'fetch', '_token': '{{ csrf_token() }}'},
                    dataType: 'json',
                    success: function(response){
            
                    $.each(response, function(key,value) {
                        var mockFile = { name: value.name, size: value.size, uuid: value.uuid };
            
                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, value.original_url);
                        myDropzone.emit("complete", mockFile);
            
                    });
            
                    }
                });
            },
            removedfile: function (file) {

                var name = file.uuid;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("albums.photos.delete", $album->id) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: name
                    },
                    success: function (data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function (file, response) {
                console.log(file);
            },
        }

    </script>
    @endpush
</x-app-layout>

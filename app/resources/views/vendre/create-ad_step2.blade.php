@extends('layout')

@section('titre', __('CreateAd'))

@section('contenu')

<div class="mx-8 md:w-2/4 md:mx-auto">
    <div class="flex justify-center mb-10 text-3xl font-semibold text-default/80">{{ __('PostAd') }}</div>
    <div class="relative mb-6">
        <div class="absolute inset-0 flex items-center">
            <div class="relative w-full h-1 mt-8 ml-20 mr-8">
                <div class="absolute top-0 left-0 h-full bg-info" style="width: 50%;"></div>
                <div class="absolute top-0 right-0 h-full bg-white" style="width: 50%;"></div>
            </div>
        </div>
        <div class="relative flex items-center justify-between">
            <div class="flex flex-col items-center">
                <div class="mb-2 text-default/50">{{ __('GeneralInformation') }}</div>
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-info">
                    <i class="text-white fa-regular fa-check"></i>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-default/50">{{ __('Documents') }}</div>
                <div class="w-8 h-8 bg-white border-4 rounded-full border-info"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-default/50">{{ __('Confirmation') }}</div>
                <div class="w-8 h-8 bg-white rounded-full"></div>
            </div>
        </div>
    </div>
    <form action="{{ route('vendre.step2') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6 text-2xl font-semibold text-default/80">{{ __('VehicleDocuments') }}</div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 font-medium text-default/50">{{ __('CarteGrise') }}</label>
                <div class="flex items-center px-4 py-2 border rounded-md border-input-border bg-input">
                    <i class="mr-3 text-default/50 fa-light fa-upload"></i>
                    <label
                        class="w-full cursor-pointer text-default/50 focus:outline-none focus:ring focus:ring-primary">
                        <span class="text-default/50">{{ __('UploadPDF') }}</span>
                        <input type="file" name="carte_grise" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'carte_grise_preview')">
                    </label>
                </div>
                <div id="carte_grise_preview" class="mt-2"></div>
            </div>
            <div>
                <label class="block mb-2 font-medium text-default/50">{{ __('FicheTechnique') }}</label>
                <div class="flex items-center px-4 py-2 border rounded-md border-input-border bg-input">
                    <i class="mr-3 text-default/50 fa-light fa-upload"></i>
                    <label
                        class="w-full cursor-pointer text-default/50 focus:outline-none focus:ring focus:ring-primary">
                        <span class="text-default/50">{{ __('UploadPDF') }}</span>
                        <input type="file" name="fiche_technique" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'fiche_technique_preview')">
                    </label>
                </div>
                <div id="fiche_technique_preview" class="mt-2"></div>
            </div>
            <div>
                <label class="block mb-2 font-medium text-default/50">{{ __('ControleTechnique') }}</label>
                <div class="flex items-center px-4 py-2 border rounded-md border-input-border bg-input">
                    <i class="mr-3 text-default/50 fa-light fa-upload"></i>
                    <label
                        class="w-full cursor-pointer text-default/50 focus:outline-none focus:ring focus:ring-primary">
                        <span class="text-default/50">{{ __('UploadPDF') }}</span>
                        <input type="file" name="controle_technique" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'controle_technique_preview')">
                    </label>
                </div>
                <div id="controle_technique_preview" class="mt-2"></div>
            </div>
            <div>
                <label class="block mb-2 font-medium text-default/50">{{ __('Divers') }}</label>
                <div class="flex items-center px-4 py-2 border rounded-md border-input-border bg-input">
                    <i class="mr-3 text-default/50 fa-light fa-upload"></i>
                    <label
                        class="w-full cursor-pointer text-default/50 focus:outline-none focus:ring focus:ring-primary">
                        <span class="text-default/50">{{ __('UploadPDF') }}</span>
                        <input type="file" name="divers" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'divers_preview')">
                    </label>
                </div>
                <div id="divers_preview" class="mt-2"></div>
            </div>
        </div>
        <div class="mt-6 mb-6 text-2xl font-semibold text-default/80">{{ __('PhotosAndVideos') }}</div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="flex items-center px-4 py-2 border rounded-md border-input-border bg-input">
                <i class="mr-3 text-default/50 fa-light fa-upload"></i>
                <label class="w-full cursor-pointer text-default/50 focus:outline-none focus:ring focus:ring-primary">
                    <span class="text-default/50">{{ __('UploadImagesAndVideos') }}</span>
                    <input type="file" name="media" accept="image/jpeg,image/png,image/jpg,video/mp4" class="hidden"
                        multiple>
                </label>
            </div>
        </div>
        <div class="mt-6 mb-6 text-2xl font-semibold text-default/80">{{ __('UploadedImages') }}</div>
        <div id="image-grid" class="grid grid-cols-2 gap-2 mt-2 md:grid-cols-7">
            @foreach($uploadedImages as $image)
            <div class="overflow-hidden border rounded-md border-input-border bg-input" style="width: 100px; height: 100px;">
                <img src="{{ asset('storage/' . $image) }}" alt="Image" class="object-cover w-full h-full">
            </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-2 font-semibold text-default/50">{{ __('DragDropToChangePosition') }}</div>
        <div class="flex justify-center gap-4 mt-8">
            <button type="button" class="px-6 py-2 border rounded-md border-input-border bg-input text-default/50 hover:bg-input/50"
                onclick="window.history.back()">{{ __('PreviousStep') }}</button>
            <button type="submit" class="px-6 py-2 text-white rounded-md bg-primary hover:bg-opacity-80">{{ __('NextStep') }}</button>
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('image-grid');
        if (el) {
            var sortable = Sortable.create(el, {
                animation: 150,
                ghostClass: 'bg-blue-100',
                onEnd: function (/**Event*/evt) {
                    // Vous pouvez ajouter du code ici pour gérer l'ordre des images après le tri
                    console.log('Nouveau ordre:', sortable.toArray());
                },
            });
        }

        document.querySelector('input[name="media"]').addEventListener('change', function (event) {
            var files = event.target.files;
            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('media', files[i]);
            }

            fetch('{{ route("vendre.uploadMedia") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.path) {
                    var imgGrid = document.getElementById('image-grid');
                    var newImgDiv = document.createElement('div');
                    newImgDiv.classList.add('border', 'border-input-border bg-input', 'rounded-md', 'overflow-hidden');
                    newImgDiv.style.width = '100px';
                    newImgDiv.style.height = '100px';

                    var newImg = document.createElement('img');
                    newImg.src = '{{ asset("storage") }}/' + data.path;
                    newImg.alt = 'Image';
                    newImg.classList.add('w-full', 'h-full', 'object-cover');

                    newImgDiv.appendChild(newImg);
                    imgGrid.appendChild(newImgDiv);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function uploadPDF(event, previewId) {
        var files = event.target.files;
        var formData = new FormData();
        formData.append('pdf', files[0]);

        fetch('{{ route("vendre.uploadPDF") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.path) {
                var previewContainer = document.getElementById(previewId);
                previewContainer.innerHTML = '';

                var fileName = document.createElement('p');
                fileName.textContent = files[0].name;
                previewContainer.appendChild(fileName);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

@endsection
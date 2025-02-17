@extends('layout')

@section('titre', 'Créer une annonce')

@section('contenu')

<div class="mx-8 md:w-2/4 md:mx-auto">
    <div class="flex justify-center mb-10 text-3xl font-semibold text-gray-800">Poster une annonce</div>
    <div class="relative mb-6">
        <div class="absolute inset-0 flex items-center">
            <div class="relative w-full h-1 mt-8 ml-20 mr-8">
                <div class="absolute top-0 left-0 h-full bg-info" style="width: 50%;"></div>
                <div class="absolute top-0 right-0 h-full bg-white" style="width: 50%;"></div>
            </div>
        </div>
        <div class="relative flex items-center justify-between">
            <div class="flex flex-col items-center">
                <div class="mb-2 text-gray-700">Informations Générales</div>
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-info">
                    <i class="text-white fa-regular fa-check"></i>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-gray-500">Documents</div>
                <div class="w-8 h-8 bg-white border-4 rounded-full border-info"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-gray-500">Confirmation</div>
                <div class="w-8 h-8 bg-white rounded-full"></div>
            </div>
        </div>
    </div>
    <form action="{{ route('vendre.step2') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-6 text-2xl font-semibold text-gray-800">Documents du véhicule</div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="block mb-2 font-medium text-gray-500">Carte Grise</label>
                <div class="flex items-center px-4 py-2 border border-gray-300 rounded-md">
                    <i class="mr-3 text-gray-500 fa-light fa-upload"></i>
                    <label
                        class="w-full text-gray-500 cursor-pointer focus:outline-none focus:ring focus:ring-blue-300">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="carte_grise" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'carte_grise_preview')">
                    </label>
                </div>
                <div id="carte_grise_preview" class="mt-2"></div>
            </div>
            <div>
                <label class="block mb-2 font-medium text-gray-500">Fiche Technique</label>
                <div class="flex items-center px-4 py-2 border border-gray-300 rounded-md">
                    <i class="mr-3 text-gray-500 fa-light fa-upload"></i>
                    <label
                        class="w-full text-gray-500 cursor-pointer focus:outline-none focus:ring focus:ring-blue-300">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="fiche_technique" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'fiche_technique_preview')">
                    </label>
                </div>
                <div id="fiche_technique_preview" class="mt-2"></div>
            </div>
            <div>
                <label class="block mb-2 font-medium text-gray-500">Contrôle Technique</label>
                <div class="flex items-center px-4 py-2 border border-gray-300 rounded-md">
                    <i class="mr-3 text-gray-500 fa-light fa-upload"></i>
                    <label
                        class="w-full text-gray-500 cursor-pointer focus:outline-none focus:ring focus:ring-blue-300">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="controle_technique" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'controle_technique_preview')">
                    </label>
                </div>
                <div id="controle_technique_preview" class="mt-2"></div>
            </div>
            <div>
                <label class="block mb-2 font-medium text-gray-500">Divers</label>
                <div class="flex items-center px-4 py-2 border border-gray-300 rounded-md">
                    <i class="mr-3 text-gray-500 fa-light fa-upload"></i>
                    <label
                        class="w-full text-gray-500 cursor-pointer focus:outline-none focus:ring focus:ring-blue-300">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="divers" accept="application/pdf" class="hidden"
                            onchange="uploadPDF(event, 'divers_preview')">
                    </label>
                </div>
                <div id="divers_preview" class="mt-2"></div>
            </div>
        </div>
        <div class="mt-6 mb-6 text-2xl font-semibold text-gray-800">Photos et vidéos</div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="flex items-center px-4 py-2 border border-gray-300 rounded-md">
                <i class="mr-3 text-gray-500 fa-light fa-upload"></i>
                <label class="w-full text-gray-500 cursor-pointer focus:outline-none focus:ring focus:ring-blue-300">
                    <span class="text-gray-500">Déposez vos images et vos vidéos</span>
                    <input type="file" name="media" accept="image/jpeg,image/png,image/jpg,video/mp4" class="hidden"
                        multiple>
                </label>
            </div>
        </div>
        <div class="mt-6 mb-6 text-2xl font-semibold text-gray-800">Images téléchargées</div>
        <div id="image-grid" class="grid grid-cols-2 gap-2 mt-2 md:grid-cols-7">
            @foreach($uploadedImages as $image)
            <div class="overflow-hidden border border-gray-300 rounded-md" style="width: 100px; height: 100px;">
                <img src="{{ asset('storage/' . $image) }}" alt="Image" class="object-cover w-full h-full">
            </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-2 font-semibold text-gray-500">Glissez-déposez une photo pour changer sa
            position</div>
        <div class="flex justify-center gap-4 mt-8">
            <button type="button" class="px-6 py-2 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-100"
                onclick="window.history.back()">Étape précédente</button>
            <button type="submit" class="px-6 py-2 text-white rounded-md bg-primary hover:bg-opacity-80">Étape
                suivante</button>
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
                    newImgDiv.classList.add('border', 'border-gray-300', 'rounded-md', 'overflow-hidden');
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
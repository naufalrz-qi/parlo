@extends('admin.layouts.app')
@section('content')
    <div class="d-flex">
        <div class="col-md-6">
            <div class="container">

                <h2 class="my-4">Add New Destination</h2>
                <form action="{{ route('store.destinations') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf



                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback">
                            Please provide a name.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        <div class="invalid-feedback">
                            Please provide a description.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="location" class="form-label">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                        <div class="invalid-feedback">
                            Please provide a location.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="iframe" class="form-label">Url Iframe:</label>
                        <input type="text" class="form-control" id="iframe" name="iframe"
                            onchange="previewIframe(event)">
                        <div class="invalid-feedback">
                            Please provide an iframe.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" class="form-control" id="image" name="image"
                            onchange="previewImage(event)">
                        <div class="invalid-feedback">
                            Please upload an image.
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                        <div class="invalid-feedback">
                            Please provide a price.
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>



                </form>

            </div>
        </div>



        <div class="col-md-6">
            <div class="container">
                <h5>Image Preview:</h5>
                <div id="image-container"
                    style="height: 300px; display: flex; align-items: center; justify-content: center; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 20px;">
                    <img id="image-preview" src="#" alt="Image Preview" class="img-fluid"
                        style="display: none; max-height: 100%;">
                </div>
                <h5>Iframe Preview:</h5>
                <div id="iframe-container"
                    style="height: 300px; display: flex; align-items: center; justify-content: center; border: 1px solid #ddd; border-radius: 5px;">
                    <iframe id="iframe-preview" src="#"
                        style="display: none; width: 100%; height: 100%; border: none;"></iframe>
                </div>

            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewIframe(event) {
            const iframeInput = event.target.value;
            const output = document.getElementById('iframe-preview');
            if (iframeInput) {
                output.src = iframeInput;
                output.style.display = 'block';
            } else {
                output.style.display = 'none';
            }
        }

        // JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection

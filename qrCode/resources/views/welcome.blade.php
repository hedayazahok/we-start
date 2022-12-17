<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->

        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />


<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.0/tinymce.min.js" integrity="sha512-CpqBk+ddDL2iYxwLkBkqiL9HywSfSfVQdkZThgvEryhQXnGlrrp9foNf6K9hDM+QrNUyT9ElgRoKJLSnsLujow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>


        <style>
           @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");
body {
	box-sizing: border-box;
	background: #f2f2f2;
	font-family: "Roboto", sans-serif;
	display: flex;
	align-items: center;
	justify-content: center;
}

.container {
	background: #fff;
	width: 100%;
	padding: 1rem;
}

.title {
	font-size: 24px;
	line-height: 28px;
	font-weight: bold;
	color: #374151;
	padding-bottom: 11px;
	border-bottom: 1px solid #d7dbdf;
}

.form-group {
	margin-top: 25px;
	display: flex;
	flex-direction: column;
}

.textarea-group label,
.form-group label {
	color: #374151;
	font-size: 16px;
	line-height: 19px;
	margin-bottom: 10px;
}

.form-group [type],
.textarea-group textarea {
	border: 1px solid #d2d6db;
	border-radius: 6px;
	padding: 15px;
}
.form-group [type]:hover,
.textarea-group textarea:hover {
	border-color: #a8afb9;
}
.form-group [type]:focus,
.textarea-group textarea:focus {
	border-color: #5850eb;
}

.textarea-group {
	margin-top: 24px;
}

.textarea-group textarea {
	resize: none;
	width: 100%;
	margin-top: 10px;
	height: calc(100% - 59px);
}

.checkbox-group {
	margin-top: 25px;
}

.checkbox-group label {
	display: flex;
}

.checkbox-group label::before {
	content: "\0020";
	display: flex;
	align-items: center;
	justify-content: center;
	width: 16px;
	height: 16px;
	margin-right: 8px;
	border: 1px solid #d2d6db;
	border-radius: 6px;
	transition: background 0.1s ease-in;
}

.checkbox-group input[type="checkbox"] {
	/* ici on ne doit pas mettre de display: none afin de pouvoir "tabber" */
	position: absolute;
	width: 1px;
	height: 1px;
	padding: 0;
	margin: -1px;
	overflow: hidden;
	clip: rect(0, 0, 0, 0);
	border: 0;
}
.checkbox-group input[type="checkbox"]:focus + label:before {
	border-color: #5850eb;
}
.checkbox-group input[type="checkbox"]:checked + label:before {
	color: #fff;
	content: "\2713";
	background: #5850eb;
	border-color: #5850eb;
}

.button {
	font-weight: bold;
	line-height: 19px;
	background: #5850eb;
	border: none;
	padding: 15px 25px;
	border-radius: 6px;
	color: white;
	width: 100%;
	margin-top: 24px;
}
.button:hover {
	background: #6e67ee;
}
.button:focus {
	background: #4239e8;
}

@media screen and (min-width: 768px) {
	body {
		align-items: center;
		justify-content: center;
	}

	.container {
		margin: 2rem;
		box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
		border-radius: 4px;
		max-width: 32rem;
		padding: 2rem;
	}
}
@media screen and (min-width: 1024px) {
	.container {
		max-width: 80%;
		width: 100%;
	}

	.checkboxes {
		display: flex;
	}
	.checkboxes > :not(:first-child) {
		margin-left: 1rem;
	}

	.grid {
		display: grid;
		grid-gap: 24px;
		grid-template-columns: 1fr 1fr 1fr;
		grid-auto-rows: 1fr;
	}

	.email-group {
		grid-column: 1;
		grid-row: 2;
	}

	.phone-group {
		grid-column: 2;
		grid-row: 2;
	}

	.textarea-group {
		grid-column: 3;
		grid-row: span 2;
		margin-right: 2rem;
	}

	.button-container {
		text-align: right;
	}

	.button {
		/* bon, bon, bon
		c'est pas tout mais j'ai faim moi ^^
		*/
		width: auto;
	}
}

        </style>
    </head>
    <body>
        <div class="container">

            <h1 class="title">Event form</h1>
<form action="{{route('event.create')}}" method="post" enctype="multipart/form-data">
    @csrf
            <div class="grid">
                <div class="form-group a">
                    <label for="name">Event Name:</label>
                    <input id="name" name="name" type="text" required>
                </div>

                <div class="form-group b">
                    <label for="Address">Address:</label>
                    <input id="Address"  name="Address" type="text" required>
                </div>

                <div class="form-group ">
                    <label for="date">Date Of Event</label>
                    <input id="date" type="date" name="doe" required>
                </div>

            </div>

                <div class="textarea-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" ></textarea>
                </div>






                <div class="col-12">
                    <div class="form-group">
                        <label>Gallery</label>
                        <div class="dropzone" id="gallery">
                            <div class="dz-message">
                                Upload Product Images
                            </div>
                        </div>
                        {{-- <input type="file" name="gallery" class="form-control"
                            id="inputImage"> --}}

                            <div class="gallery-wrapper"></div>
                    </div>
                </div>



            <div class="button-container">
                <button class="button">Enregister les modifications</button>
            </div>
        </form>





        </div>

<script>
    tinymce.init({
        selector: '#bio'
    })

    var uploadedDocumentMap = {}
    Dropzone.autoDiscover = false;
    let myDropzone = new Dropzone("div#gallery", {
        url: "/addImage",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        addRemoveLinks: true,
        success: function(file, response) {
            let img = `<input type="hidden" name="album[]" value="${response}" />`
            document.querySelector('.gallery-wrapper').insertAdjacentHTML("beforeend", img );
            uploadedDocumentMap[file.name] = response
        },
        removedfile: function(file) {
            file.previewElement.remove()
            name = uploadedDocumentMap[file.name];
            document.querySelector('input[name="album[]"][value="' + name + '"]').remove()
        }
    });
</script>
    </body>
</html>

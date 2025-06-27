@extends('backend.layouts.htmlheader')

@section('content')
@php
$enc_id = Crypt::encrypt($galdet['id']);

@endphp

<div class="container-fluid dashboard_bg  min-vh-100">

    <div class="row pt-3 pb-2" id="bread-row">
        <div class="col-12">
            <span class="h4"> <i class="fas fa-folder-open"></i> &nbsp; Upload Gallery Items</span>
        </div> <!-- ./col12 -->

        <div class="col-12 pt-2 d-flex justify-content-end">
            <nav aria-label="breadcrumb mt-3 ">
                <ol class="breadcrumb">
                    {!!$breadcrumbarr!!}
                </ol>
            </nav>
        </div> <!-- ./col12 -->
    </div> <!-- ./row -->

    <div class="row py-2" id="warning-row">
        <div class="col-12">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {!! implode(' ', $errors->all('<span class="text-danger">:message</span>')) !!}
            </div> <!-- ./alert -->
            @endif
            @if(isset($error))
            @php
            $errf=1;
            @endphp
            <div class="alert alert-danger" role="alert">
                <span class="text-danger">{{$error}}</span>
            </div> <!-- ./alert -->
            @endif
            @if(isset($success))
            <div class="alert alert-success" role="alert">
                <span class="text-info">{{$success}}</span>
            </div> <!-- ./alert -->
            @endif
            @if(session('reload'))
                <script>
                    window.onload = function () {
                        if ({{ session('reload') }}) {
                            location.reload();
                        }
                    };
                </script>
            @endif

        </div> <!-- ./col12 -->
    </div> <!-- ./row -->
    <!-- ./row -->
    <div class="row py-2" id="warning-row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <span class="text-primary">{{'Upload images for Gallery Stills'}}</span>
            </div> <!-- ./alert -->
        </div>
    </div><!-- ./row -->
    <div class="row py-2">
        <div class="col-12 pt-2 d-flex justify-content-center">
            <div id="drag-drop-area"></div>
        </div> <!-- ./col12 -->
    </div> <!-- ./row -->
    <!-- <div class="row py-2" id="warning-row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <span class="text-primary">{{'Preview of images for Gallary Stills'}}</span>
            </div>
        </div>
    </div> -->
    <div class="row py-2">
        <div class="col-12 pt-2 d-flex justify-content-center">
            <div id="drag-drop-area"></div>
        </div> <!-- ./col12 -->
    </div> <!-- ./row -->

    @if($galitemcnt>0)
    
    <div class="row py-2" id="warning-row">
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <span class="text-primary">{{'Uploaded images for Gallery Stills'}}</span>
            </div> <!-- ./alert -->
        </div>
    </div><!-- ./row -->
    <section class="gallery-block grid-gallery">
        <div class="row mt-2">

            @foreach($galitem as $res)
            <div class="col-lg-3 p-2 d-flex justify-content-center">
                @if($res->image!='')
                <div class="card">

                    <!-- <div class="card-body">
                        <a class="lightbox" href="{{asset('/assets/backend/uploads/Galleryitem/'.$res->image) }}">
                            <img id="img_show" src="{{asset('/assets/backend/uploads/Galleryitem/'.$res->image) }}" class="img-fluid" alt="film poster">
                        </a>
                    </div>  -->
                    <div class="card-body">
                        @php
                            $filePath = '/assets/backend/uploads/Galleryitem/' . $res->image;
                            $fileUrl = asset($filePath);
                            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <!-- Display image in a lightbox -->
                            <a class="lightbox" href="{{ $fileUrl }}">
                                <img id="img_show" src="{{ $fileUrl }}" class="img-fluid" alt="Uploaded Image">
                            </a>
                        @elseif(strtolower($fileExtension) === 'pdf')
                            <!-- Provide a link to view the PDF -->
                            <a href="{{ $fileUrl }}" target="_blank" title="View PDF">
                                {{ $res->image ?? 'View PDF' }}
                            </a>
                        @elseif(in_array(strtolower($fileExtension), ['doc', 'docx']))
                            <!-- Provide a link to download the document -->
                            <a href="{{ $fileUrl }}" target="_blank" title="Download Document">
                                Download Document
                            </a>
                        @elseif(strtolower($fileExtension) === 'mp4')
                            <!-- Display video player -->
                            <video controls width="100%" class="img-fluid">
                                <source src="{{ $fileUrl }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @elseif(in_array(strtolower($fileExtension), ['xls', 'xlsx']))
                            <!-- Provide an option to preview or download the Excel file -->
                            <a href="{{ $fileUrl }}" target="_blank" title="Download Excel">
                                Download Excel File
                            </a>   
                        @else
                            <!-- Message for unsupported file types -->
                            <p>Unsupported file type: {{ $fileExtension }}</p>
                        @endif

                        <!-- //////////////////////////
                         
                          -->

                    </div> <!-- ./card-body -->

                    <div class="card-footer">
                        <input type="hidden" id="poster_path" name="poster_path" value="{{asset('/assets/backend/uploads/Galleryitem/'.$res->image) }}">
                        <input type="hidden" id="galitemid" name="galitemid" value="{{ $res->id }}">
                        <button class="btn btn-sm btn-danger btn-flat mt-3 delete_pic_btn" title="Remove Image" id="{{ $res->id }}">
                            <i class="fas fa-trash" title="Remove Image"></i> Delete image</button>
                    </div> <!-- ./card-footer -->
                </div> <!-- ./card -->
                @endif
            </div> <!-- ./col-3 -->
            @endforeach

        </div> <!-- ./row -->
    </section>
    @endif

    
    <div class="row p-1">
        <div class="col-12 p-2 d-flex justify-content-end" id="search_col1">
          
            <input type="hidden" id="edit_f" value="{{isset($edit_f)?$edit_f:''}}">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" id="hidden_id" name="hidden_id" value="{{isset($enc_id)?$enc_id:''}}">
        </div> <!-- ./col12 -->
    </div> <!-- ./row -->
    <!-- The Modal -->
    <div id="myModal" class="modal_pic">
        <span class="closepic">&times;</span>
        <img class="modalpic-content" id="img01">
        <div id="captionpic"></div>
    </div>

</div> <!-- ./container -->

@endsection
@section('page_scripts')
<script>
    // $('.img_show').on('click', function() {
    //     var modal = document.getElementById("myModal");

    //     var modalImg = document.getElementById("img01");
    //     var captionText = document.getElementById("captionpic");
    //     modal.style.display = "block";
    //     modalImg.src = this.src;
    //     captionText.innerHTML = this.alt;
    // });
    var span = document.getElementsByClassName("closepic")[0];
    span.onclick = function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var usertype = $("#usertype_id").val();
        $('.delete_pic_btn').on('click', function(e) {

            var element_id = $(this).attr('id');
            // alert(element_id);

            var usertype = $("#usertype_id").val();
            
            // alert(usertype+"ss");
            var action_url = "/siteadmin/galitemdel/" + element_id;


            $.ajax({
                url: action_url,
                dataType: "json",

                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        window.location.reload();
                        alert('Data Deleted');
                    }, 200);
                }
                
            })
        });

    });



    $('#languages').on('keyup', function(e) {
        var testres = alpha_comma_space('#languages', this.value);
        if (!testres) {
            $('.langerr').show();

        } else {
            $('.langerr').hide();
        }
    });





    $('#poster').on('change', function(e) {

        var testres = imageval('#poster', this.files[0], '#img_show');
        if (!testres) {
            $('.postererr').show();

        } else {
            $('.postererr').hide();
        }
    });
    $('#img_show').on('load', function(e) {
        var image = new Image();
        image.src = $(this).attr("src");
        var testres = imageheightwidth('#img_show', image.width, image.height);
        if (!testres) {
            $('#img_show').hide()
            $('.postererr').slideDown("slow");
        } else {
            $('#img_show').show()
            $('.postererr').hide();
        }
    });
    $('#alternate_text').on('keyup', function(e) {
        var testres = engtitle('#alternate_text', this.value);
        if (!testres) {
            $('.alternate_texterr').show();

        } else {
            $('.alternate_texterr').hide();
        }
    });



    function img_preview() {
        const [file] = poster.files
        if (file) {
            img_show.src = URL.createObjectURL(file);
        }
        $('#img_show').show();

    }




$('button').on('click',function(){

});
    /*    UPPY file upload and editor (start)  */
    var hidid = $("#hidden_id").val();
    var usertype = $("#usertype_id").val();
  
    var actionurl = '/siteadmin/galitemstoreuppy/' + hidid;
   
    // if (usertype == 2) {
    //     var actionurl = '/siteadmin/galitemstoreuppy/' + hidid;
    // } else if (usertype == 3) {
    //     var actionurl = '/festadmin/galitemstoreuppy/' + hidid;
    // } else if (usertype == 6) {
    //     var actionurl = '/mediamanager/galitemstoreuppy/' + hidid;
    // }
    var uppy = new Uppy.Core({
            restrictions: {
                // maxFileSize: 2000000,
                // maxFileSize: 50000000, // 50 MB in bytes
                maxFileSize: 10 * 1024 * 1024, // 10MB
                maxNumberOfFiles: 25,
                minNumberOfFiles: 1,
                // allowedFileTypes: ['image/*', 'application/*']
                allowedFileTypes: ['image/*','video/*','application/*']
            },
        })
        .use(Uppy.Dashboard, {
            trigger: '.UppyModalOpenerBtn',
            inline: true,
            target: '#drag-drop-area',
            showProgressDetails: true,
            note: '.jpg, .jpeg, .png ,.pdf,.mp4,.docx,doc,.webm ,.xlsx file formats only, 1–5 files, up to 10 MB',
            
            // height: 470,

            metaFields: [{
                    id: 'name',
                    name: 'Name',
                    placeholder: 'file name'
                },
                {
                    id: 'caption',
                    name: 'Caption',
                    placeholder: 'describe what the image is about'
                }
            ],
            browserBackButtonClose: false
        })

        .use(Uppy.ImageEditor, {
            target: Uppy.Dashboard,
            quality: 0.8,
            cropperOptions: {
                viewMode: 1,
                background: true,
                autoCropArea: false,
                responsive: true,
                aspectRatio: 1 / 1,
                initialAspectRatio: 1 / 1,
            },
            actions: {
                revert: true,
                rotate: true,
                granularRotate: true,
                flip: true,
                zoomIn: true,
                zoomOut: true,
                cropSquare: true,
                cropWidescreen: false,
                cropWidescreenVertical: false,
            },
        })
        //.use(Uppy.Tus, { endpoint: '{{ url("/festmanager/filmstillstore")}}/'})
        .use(Uppy.DropTarget, {
            target: document.body
        })
        .use(Uppy.GoldenRetriever)
       
        .use(Uppy.XHRUpload, {
            limit: 10,
            endpoint: actionurl,
            formData: true,
            fieldName: 'file',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // from <meta name="csrf-token" content="{{ csrf_token() }}">
            },
            
        });
    uppy.on('file-added', (file) => {
        const data = file.data // is a Blob instance
        const url = URL.createObjectURL(data)
        const image = new Image()
        image.src = url
        image.onload = () => {
            // const url = '';
            // if (image.width != 800 && image.height != 600) {
            //     uppy.info(`${file.name} error. Only 800x600 accepted`);
            //     const url = '';
            //     uppy.removeFile(file.id);
            // } else {
            
                uppy.setFileMeta(file.id, {
                    width: image.width,
                    height: image.height
                })

                URL.revokeObjectURL(url)
                // alert(url);
            // }

        }
    })

    uppy.on('complete', (result) => {
        if ($('.uppy-StatusBar').hasClass('is-complete')) {
            // alert("Upload complete! We’ve uploaded these files:");
            Swal.fire({
                title: "Kerala health",
                    text: "Upload complete! We’ve uploaded these files:",
                    type: "info",
                    showCancelButton: false,
                    showConfirmButton: true
})
.then(willDelete => {
  if (willDelete) {
    var usertype = $("#usertype_id").val();
    // alert(usertype+'::'+hidid);
   
    window.location.href = "/viewgallarypics/" + hidid; 
   
  }
});
            // swal({
            //         title: "KSEB",
            //         text: "Upload complete! We’ve uploaded these files:",
            //         type: "info",
            //         showCancelButton: false,
            //         showConfirmButton: true
            //     },
            //     function() {
            //         // var usertype = $("#usertype_id").val();
            //         alert(hidid);
            //         window.location.href = "/viewgallarypics/" + hidid;
            //         // alert(usertype);
            //         // if (usertype == 4) {
            //         //     window.location.href = "/festmanager/viewgallarypics/" + hidid;
            //         // } else if (usertype == 3) {
            //         //     window.location.href = "/festadmin/viewgallarypics/" + hidid;
            //         // } else if (usertype == 6) {
            //         //     window.location.href = "/mediamanager/viewgallarypics/" + hidid;
            //         // } else if (usertype == 11) {
            //         //     window.location.href = "/archiveuser/viewgallarypics/" + hidid;
            //         // }

            //     });
        }
        if ($('.uppy-StatusBar').hasClass('is-error')) {
            alert("Error while uploading"+result);
            // window.location.reload();
            // swal({
            //         title: "IFFK",
            //         text: "Error while uploading",
            //         type: "warning",
            //         showCancelButton: false,
            //         showConfirmButton: true
            //     },
            //     function() {
            //         window.location.reload();
            //     });
        }
    })


    /*    UPPY file upload and editor (end)  */
</script>
@endsection
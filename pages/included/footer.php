</div>
		</div>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/main.js"></script>
    <script src="../../js/app.js"></script>
    <script>
        $(document).ready(function(){
    $('#moreModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var certificate = button.data('certificate');
        var name = button.data('name');
        var phone = button.data('phone');
        var address = button.data('address');
        var rule = button.data('rule');
        console.log('No Errors');
        var modal = $(this);
        modal.find('.modal-title').html("<p class='lead'>Request From <mark>"+name+"</mark><sub>"+rule+"</sub></p>");
        modal.find('.modal-body').html("<p class='lead'>Address : <mark>"+address+"</mark></p> <p class='lead'>Phone Number : <mark>"+phone+"</mark></p>");    
        if(rule == "Baby Sitter"){
            modal.find('.modal-footer a[href]').attr("href", "../babysitter/upload/" + certificate);
            modal.find('.modal-footer a[href]').removeAttr("data-dismiss");
            modal.find('.modal-footer a[href]').text("View Certificate");
        } else {
            modal.find('.modal-footer a[href]').attr("href", "");
            modal.find('.modal-footer a[href]').attr("data-dismiss", "modal");
            modal.find('.modal-footer a[href]').text("Done");
        }
        // modal.find('.modal-body input').val(recipient)
    });
    // Prepare the preview for profile picture
        $("#profile-picture").change(function(){
            readURL(this);
        });
        $("#wizard-picture").change(function(){
            readURL(this);
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                var imgTarget = input.id == "wizard-picture"?"#wizardPicturePreview":"#profilePicturePreview";
            
                $(imgTarget).attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
    <!-- <script src="assets/js/app.js"></script> -->

  </body>
</html>
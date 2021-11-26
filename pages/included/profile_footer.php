<!-- /.right-sidebar -->
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
         <div class="control-sidebar-bg shadow white fixed"></div>
</div>
<!--/#app -->
<script src="../../assets/js/app.js"></script>
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
    $("#wizard-picture").change(function(){
        readURL(this);
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script> 

</body>
</html>
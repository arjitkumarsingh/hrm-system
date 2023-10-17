<html lang="en">
<head>
    <title>How to add ckeditor required field validation in Jquery</title>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
</head>
<body>
<div class="container text-center">
    <h2>How to add ckeditor required field validation in Jquery</h2>
    <form id="ckeditorForm" method="post">
        <textarea name="editor" class="text-area" id="text-area"></textarea><br>
        <button>Submit</button>
    </form>
    <script>
        
        ClassicEditor.create(document.querySelector('.text-area'));

        $("#ckeditorForm").submit(function(e) {
            var content = $('.text-area').val();
            console.log(content);
            html = $(content).text();
            console.log(html);
            if ($.trim(html) == '') {
                alert("Please enter message");
                e.preventDefault();
            } else {
                alert("Success");
                e.preventDefault();
            }
        });
    </script>
</div>  
</body>
</html>
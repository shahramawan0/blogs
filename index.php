<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rich Content Editor</title>
    <script src="https://cdn.tiny.cloud/1/2f94z5pzrvl4ryvz3apf03c1v7x6kcxbgym4j2k8qsw1xyvs/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#content',
        plugins: 'lists link image table',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | bullist numlist | table',
        height: 500,
        images_upload_url: 'upload_image.php',
        automatic_uploads: true,
        images_upload_handler: function (blobInfo, success, failure) {
          var xhr, formData;
          xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open('POST', 'upload_image.php');
          xhr.onload = function() {
            var json;
            if (xhr.status != 200) {
              failure('HTTP Error: ' + xhr.status);
              return;
            }
            try {
              json = JSON.parse(xhr.responseText);
            } catch (e) {
              failure('Invalid JSON: ' + xhr.responseText);
              return;
            }
            if (!json || typeof json.location != 'string') {
              failure('Invalid JSON: ' + xhr.responseText);
              return;
            }
            success(json.location);
          };
          formData = new FormData();
          formData.append('file', blobInfo.blob(), blobInfo.filename());
          xhr.send(formData);
        }
      });
    </script>
</head>
<body>
    <form method="post" action="save_content.php">
        <textarea id="content" name="content"></textarea>
        <button type="submit">Save</button>
    </form>
</body>
</html>

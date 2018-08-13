<!DOCTYPE html>
<html>
  <head>
    <title><?= $title; ?></title>
  </head>
  <body>
    <h1>Upload multiple files</h1>
    <?= form_open_multipart();?>
      <p>Upload file(s):</p>
      <?= form_error('uploadedimages[]'); ?>
      <?= form_upload('uploadedimages[]','','multiple'); ?>
      <br />
      <br />
      <?= form_submit('submit','Upload');?>
    <?= form_close();?>
  </body>
</html>
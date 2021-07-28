Webcam.set({
    width: 100,
    height: 50,
    image_format: 'jpeg',
    jpeg_quality: 90
  });
  Webcam.attach('#my_camera');
  
  
  function take_snapshot() {
  
    // take snapshot and get image data
    Webcam.snap(function(data_uri) {
        // display results in page
        document.getElementById('results').innerHTML =
            '<img src="' + data_uri + '"/>';
    });
  }
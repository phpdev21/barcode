<!doctype html>
<!-- The DOCTYPE declaration above will set the     -->
<!-- browser's rendering engine into                -->
<!-- "Standards Mode". Replacing this declaration   -->
<!-- with a "Quirks Mode" doctype is not supported. -->

<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Janusz Białobrzewski" />
    <!--                                                               -->
    <!-- Consider inlining CSS to reduce the number of requested files -->
    <!--                                                               -->
    <link type="text/css" rel="stylesheet" href="{{asset('JsQRScanner.css')}}">

    <!--                                           -->
    <!-- Any title is fine                         -->
    <!--                                           -->
    <title>JsQRScanner example</title>
    
    <!--                                           -->
    <!-- This script loads your compiled module.   -->
    
  </head>

  <body>

    <!-- RECOMMENDED if your web app will not function without JavaScript enabled -->
    <noscript>
      <div style="width: 22em; position: absolute; left: 50%; margin-left: -11em; color: red; background-color: white; border: 1px solid red; padding: 4px; font-family: sans-serif">
        Your web browser must have JavaScript enabled
        in order for this application to display correctly.
      </div>
    </noscript>

    <div class="row-element-set row-element-set-QRScanner">
      <h1>JsQRScanner example</h1>
      <div class="row-element">
        <div class="FlexPanel detailsPanel QRScannerShort">
          <div class="FlexPanel shortInfoPanel">
            <div class="gwt-HTML">
              Point the webcam to a QR code.
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row-element">
        <div class="qrscanner" id="scanner">
        </div>
      </div>
      <div class="row-element">
        <div class="form-field form-field-memo">
          <div class="form-field-caption-panel">
            <div class="gwt-Label form-field-caption">
              Scanned text
            </div>
          </div>
          <div class="FlexPanel form-field-input-panel">
            <textarea id="scannedTextMemo" class="textInput form-memo form-field-input textInput-readonly" rows="3" readonly>
            </textarea>
          </div>
        </div>
        <div class="form-field form-field-memo">
          <div class="form-field-caption-panel">
            <div class="gwt-Label form-field-caption">
              Scanned text history
            </div>
          </div>
          <div class="FlexPanel form-field-input-panel">
            <textarea id="scannedTextMemoHist" class="textInput form-memo form-field-input textInput-readonly" value="" rows="6" readonly>
            </textarea>
          </div>
        </div>
      </div>
      <br>
      <a style="font-weight: bold;" href="https://github.com/jbialobr/JsQRScanner">The source code is hosted on GitHub</a>
    </div>
    <script type="text/javascript" src="{{asset('jsqrscanner.nocache.js')}}"></script>
  <script type="text/javascript">
    function onQRCodeScanned(scannedText)
    {
    	var scannedTextMemo = document.getElementById("scannedTextMemo");
    	if(scannedTextMemo)
    	{
    		scannedTextMemo.value = scannedText;
    	}
    	var scannedTextMemoHist = document.getElementById("scannedTextMemoHist");
    	if(scannedTextMemoHist)
    	{
    		scannedTextMemoHist.value = scannedTextMemoHist.value + '\n' + scannedText;
    	}
    }
    
    function provideVideo()
    {
        var n = navigator;
        if (n.mediaDevices && n.mediaDevices.getUserMedia)
        {
          return n.mediaDevices.getUserMedia({
            video: {
              facingMode: "environment"
            },
            audio: false
          });
        } 
        
        return Promise.reject('Your browser does not support getUserMedia');
    }
    function provideVideoQQ()
    {
        return navigator.mediaDevices.enumerateDevices()
        .then(function(devices) {
            var exCameras = [];
            devices.forEach(function(device) {
            if (device.kind === 'videoinput') {
              exCameras.push(device.deviceId)
            }
         });
            
            return Promise.resolve(exCameras);
        }).then(function(ids){
            if(ids.length === 0)
            {
              return Promise.reject('Could not find a webcam');
            }
            
            return navigator.mediaDevices.getUserMedia({
                video: {
                  'optional': [{
                    'sourceId': ids.length === 1 ? ids[0] : ids[1]//this way QQ browser opens the rear camera
                    }]
                }
            });        
        });                
    }
    
    //this function will be called when JsQRScanner is ready to use
    function JsQRScannerReady()
    {
        //create a new scanner passing to it a callback function that will be invoked when
        //the scanner succesfully scan a QR code
        var jbScanner = new JsQRScanner(onQRCodeScanned);
        //var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
        //reduce the size of analyzed image to increase performance on mobile devices
        jbScanner.setSnapImageMaxSize(300);
    	var scannerParentElement = document.getElementById("scanner");
    	if(scannerParentElement)
    	{
    	    //append the jbScanner to an existing DOM element
    		jbScanner.appendTo(scannerParentElement);
    	}        
    }
  </script>    
  </body>
</html>
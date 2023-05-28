<!DOCTYPE html>
<html>
<body>
<script>
  var roomId = "<?php echo $room_id;?>";
  var token = "<?php echo VIDEO_SDK_API_KEY;?>";
  var script = document.createElement("script");
  script.type = "text/javascript";

  script.addEventListener("load", function (event) {
    const config = {
       debug: true,
      name: "GFG Academy",
      meetingId: roomId,
      apiKey: token,
      micEnabled: true,
      toggleParticipantMic: true,
      participantCanToggleSelfMic: true,


      containerId: null,
      raiseHandEnabled:true,  
      webcamEnabled: false,
      participantCanToggleSelfWebcam: false,
      whiteboardEnabled: true,
      chatEnabled: true,
      screenShareEnabled: true,
       recording: {
        enabled: false,
        autoStart: true,
      layout: {
        type: "SIDEBAR", // "SPOTLIGHT" | "SIDEBAR" | "GRID"
        priority: "PIN", // "SPEAKER" | "PIN",
        gridSize: 3,
      },
    },

  permissions: {
    toggleRecording: true,
    changeLayout: true,
    drawOnWhiteboard: true,
    toggleWhiteboard: true,
    pin: true,
    endMeeting: true,
    toggleParticipantWebcam: true,
    toggleParticipantMic: true,
    
  },

      
    };

    const meeting = new VideoSDKMeeting();
    meeting.init(config);
  });


  script.src =
    "https://sdk.videosdk.live/rtc-js-prebuilt/0.3.7/rtc-js-prebuilt.js";
  document.getElementsByTagName("head")[0].appendChild(script);
</script>
</body>
</html>
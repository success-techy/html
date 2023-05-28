<!DOCTYPE html>
<html>
<body>
<script>
  var roomId = "<?php echo $room_id;?>";
  var names = "<?php echo $student_name;?>";
  var token = "<?php echo VIDEO_SDK_API_KEY;?>";
  var script = document.createElement("script");
  script.type = "text/javascript";

  script.addEventListener("load", function (event) {
    const config = {
      name: names,
      meetingId: roomId,
      apiKey: "18991a7c-b707-40f2-8861-4d354942a6a8",
      containerId: null,
      micEnabled: false,
      webcamEnabled: false,
      participantCanToggleSelfWebcam: false,
      participantCanToggleSelfMic: true,
      chatEnabled: true,
      screenShareEnabled: false,
      raiseHandEnabled: true,
      joinScreen: {
        visible: false
      },
      /*

     Other Feature Properties
      
      */
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

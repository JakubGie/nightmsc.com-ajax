<!DOCTYPE html>
<html lang="en">
<head>

    <title>Night Music - feel the night!</title>

    <?php include 'elements/head.php'; ?>

</head>
<body>
    <div class="outer">
        <div class="middle">
            <div class="form">
                <a href="https://nightmsc.com"><img src="img/NMSClogowhite.png" class="logo" alt="Night Music Logo"></a>
                <h2>SUBMIT YOUR TRACK</h2>
                <input name="artistName" id="artistName" type="text" placeholder="*Your Artist Name" maxlength="30">
                <input name="email" id="email" type="text" placeholder="*Your Email" maxlength="60">
                <input name="songName" id="songName" type="text" placeholder="*Name of Song" maxlength="40">
                <input name="link" id="link" type="text" placeholder="*Listen Link" maxlength="500">
                <textarea name="adInfo" id="adInfo" rows="1" placeholder="Additional info (optional)" maxlength="500"></textarea>
                <input type="submit" value="SEND" id="send">
                <div class="result"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", "#send", function () {
            $.post("elements/ajax.php", {
                operation: "send",
                artistName: $("input[name=artistName]").val(),
                email: $("input[name=email]").val(),
                songName: $("input[name=songName]").val(),
                link: $("input[name=link]").val(),
                adInfo: $("textarea[name=adInfo]").val()
            }, function(data){
                $(".result").html(data);
            });
        });

        function clearForm()
        {
            $("#artistName").val("");
            $("#email").val("");
            $("#songName").val("");
            $("#link").val("");
            $("#adInfo").val("");
        }
    </script>
</body>
</html>
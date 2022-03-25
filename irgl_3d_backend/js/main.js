$(function () 
{
    let playSound = false;
    let darkMode = false;
    let volume = 0.5;


    const sound = new Howl({
        src: ['../assets/sound.mp3'],
        loop: true,
        volume: 0,
        onplay: function () {
            console.log("Sound is Playing");
        },
        onpause: function () {
            console.log("Howler not Playing");
        }
    });


    $('[data-display=loader]').click(function() 
    {
        $(this).fadeOut(800);
        $("#irgl-section").fadeIn(1000);

        if (!sound.playing()) {
            playSound = true;
            sound.play();
            sound.fade(0, 0.5, 2000);
            // sound.volume(0.7);
        }
    });


    $('[data-toggle=modal]').click(function(e) 
    {
        e.preventDefault();
        const getAttr = $(this).attr("data-target");
        const dataHide = $(this).attr("data-hide");


        if (getAttr && dataHide) {
            const modalView = $(getAttr);

            if (dataHide && modalView) {
                $(dataHide).fadeOut();

                setTimeout(() => {
                    modalView.fadeIn();
                }, 500);
            }
        }
    });


    $("#volumeSelect").change(function() 
    {
        let addVolumeSelect;
        if (playSound) {
            const value = $(this).val();

            if (value === "0") {
                volume = 0.5;
                addVolumeSelect = 'fas fa-volume-down';
            }
            else if (value === "2") {
                volume = 1;
                addVolumeSelect = 'fas fa-volume-up';
            }
            else {
                volume = 0.7;
                addVolumeSelect = 'fas fa-volume';
            }

            sound.volume(volume);
        }

        $("#volumeClick").removeClass();
        $("#volumeClick").addClass("faicon " + addVolumeSelect);
    });


    $('#darkModeSelect').change(() => 
    {
        let addDarkMode;
        if (darkMode) {
            darkMode = false;
            addDarkMode = "fas fa-sun";
            $("body").removeAttr("data-darkmode");

        }
        else {
            darkMode = true;
            addDarkMode = "fad fa-moon";
            $("body").attr("data-darkmode", true);
        }

        $("#darkModeClick").removeClass();
        $("#darkModeClick").addClass("faicon " + addDarkMode);
    });


    $('#musicSoundSelect').change(() => 
    {
        let addClassSound;
        if (playSound) {
            playSound = false;
            addClassSound = "fas fa-music-slash margin-left";

            $("#volumeSelect").attr('disabled', true);
            sound.fade(1, 0, 1000);

        }
        else {
            playSound = true;
            addClassSound = "fas fa-music";
            $("#volumeSelect").attr('disabled', false);
            sound.fade(0, 1, 1000);
        }

        setTimeout(() => {
            if (playSound)
                sound.volume(volume);
        });

        $("#musicSoundClick").removeClass();
        $("#musicSoundClick").addClass("faicon " + addClassSound);
    });



    // Registration API
    $('.form-regist').submit(function(e)
    {
        e.preventDefault();
        const getDataForm = new FormData($(this)[0]);

        $('.form-regist input, .form-regist button').attr('disabled', 'disabled');

        $.ajax({
            url         : '../backend/registration.php',
            data        : getDataForm, 
            cache       : false,
            contentType : false,
            processData : false,
            type        : 'POST',
            enctype     : 'multipart/form-data',
            success     : function(data)
            {
                $('.form-regist input, .form-regist button').removeAttr('disabled');

                if (data.return)
                {
                    Swal.fire({
                        icon: data.success_regist ? 'success' : 'error',
                        title: data.success_regist ? 'Successfully Registered' : 'Oops...',
                        text: data.message,
                        confirmButtonColor: 'rgb(62, 82, 84)'
                    });

                    if (data.success_regist)
                        $('.form-regist input').val('');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) 
            {
                $('.form-regist input, .form-regist button').removeAttr('disabled');

                Swal.fire({
                    icon: 'error',
                    title: 'System Error',
                    text: `System Error: ${thrownError}. Status: ${xhr.status}`,
                    confirmButtonColor: 'rgb(62, 82, 84)'
                });
            }
        });
    });



    // Login API
    $('.form-login').submit(function(e)
    {
        e.preventDefault();
        const getDataForm = $(this).serialize();

        $('.form-login input, .form-login button').attr('disabled', 'disabled');

        $.ajax({
            url         : '../backend/login.php',
            data        : getDataForm, 
            type        : 'POST',
            success     : function(data)
            {
                $('.form-login input, .form-login button').removeAttr('disabled');

                if (data.return)
                {
                    Swal.fire({
                        icon: data.success_login ? 'success' : 'error',
                        title: data.success_login ? 'Successfully logged in' : 'Oops...',
                        text: data.message,
                        confirmButtonColor: 'rgb(62, 82, 84)'
                    });

                    if (data.success_login)
                    {
                        $('.form-login input').val('');

                        setTimeout(() => {
                            Swal.close();
                        }, 2000);

                        setTimeout(() => {
                            window.location.href = data.redirect_page;
                        }, 2500);
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) 
            {
                $('.form-login input, .form-login button').removeAttr('disabled');
                
                Swal.fire({
                    icon: 'error',
                    title: 'System Error',
                    text: `System Error: ${thrownError}. Status: ${xhr.status}`,
                    confirmButtonColor: 'rgb(62, 82, 84)'
                });
            }
        });
    });
});
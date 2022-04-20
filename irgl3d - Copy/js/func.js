function changeStyleWebGl() 
{
    $('.webgl').css(
        {
            'width': $(window).width(),
            'height': $(window).height()
        }
    );
}

function registerNext(curr, next, done = false) 
{
    if (!done) 
    {
        let currForm = document.querySelector(curr);
        let nextForm = document.querySelector(next);
        currForm.style.display = 'none';
        currForm.style.pointerEvents = 'none';
        nextForm.style.display = 'grid';
        nextForm.style.pointerEvents = 'auto';
    }
}



// function loadPage() {
//     $(".registration-page").css("opacity", "1");
//     $(".registration-page").css("pointer-events", "all");
//     window.init3D2();
//     window.animate3D2();
// }

// function unloadPage() {
//     $(".registration-page").css("opacity", "0");
//     $(".registration-page").css("pointer-events", "none");
// }

$(function () 
{
    let playSound = false;
    let darkMode = false;
    let volume = 0.1;


    const sound = new Howl({
        src: ['assets/sound.mp3'],
        loop: true,
        volume: 0,
        onplay: function () {
            console.log("Sound is Playing");
        },
        onpause: function () {
            console.log("Howler not Playing");
        }
    });

    const genereteRecaptcha = function(div) 
    {
        const objects = $(div);

        return grecaptcha.render(objects.attr("id"), {
            "sitekey" : objects.attr("data-sitekey")
        });
    }

    

    const captchaLogin      = genereteRecaptcha("#reCaptchaLogin");
    const captchaRegister   = genereteRecaptcha("#reCaptchaRegister");



    const scaleCaptcha = () => 
    {
        const width = $('.captcha').parent().width();

        if (width !== 0 && width < 302)
        {
            const scale = width / 302;

            $('.captcha').css('transform', 'scale(' + scale + ')');
            $('.captcha').css('-webkit-transform', 'scale(' + scale + ')');
            $('.captcha').css('transform-origin', '0 0');
            $('.captcha').css('-webkit-transform-origin', '0 0');
        }
    }


    $('[data-display=loader]').click(function() 
    {
        $(this).fadeOut(800);
        $("#irgl-section").fadeIn(1000);

        if (!sound.playing()) {
            playSound = true;
            sound.play();
            sound.fade(0, 0.5, 500);
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

        setTimeout(() =>
        {
            scaleCaptcha();    
            $(window).resize(scaleCaptcha);
        }, 1000);
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

    // var utk menyimpan kondisi sound sebelum play video story line
    let tempSound;
    $("#play-btn").click(function(){
        let addClassSound;
        if (playSound) {
            playSound = false;
            tempSound = true;
            addClassSound = "fas fa-music-slash margin-left";

            $("#volumeSelect").attr('disabled', true);
            sound.fade(1, 0, 1000);

        }

        $("#musicSoundClick").removeClass();
        $("#musicSoundClick").addClass("faicon " + addClassSound);
    });

    $("#closeStory").click(function(){
        let addClassSound;

        if(tempSound){
            console.log(tempSound);
            playSound = true;
            addClassSound = "fas fa-music";
            $("#volumeSelect").attr('disabled', false);
            sound.fade(0, 1, 1000);
        }

        setTimeout(() => {
            if (tempSound)
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
        $('.form-regist button').text('Please Wait ...');

        $.ajax({
            url         : 'backend/registration.php',
            data        : getDataForm, 
            cache       : false,
            contentType : false,
            processData : false,
            type        : 'POST',
            enctype     : 'multipart/form-data',
            success     : function(data)
            {
                $('.form-regist input, .form-regist button').removeAttr('disabled');
                $('.form-regist button').text('Submit');

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
                $('.form-regist button').text('Submit');

                Swal.fire({
                    icon: 'error',
                    title: 'System Error',
                    text: `System Error: ${thrownError}. Status: ${xhr.status}`,
                    confirmButtonColor: 'rgb(62, 82, 84)'
                });
            },
            complete: () =>
            {
                grecaptcha.reset(captchaRegister);
            }
        });
    });



    // Login API
    $('.form-login').submit(function(e)
    {
        e.preventDefault();
        const getDataForm = $(this).serialize();

        $('.form-login input, .form-login button').attr('disabled', 'disabled');

        $('.form-login button').text('Please wait ...');

        $.ajax({
            url         : 'backend/login.php',
            data        : getDataForm, 
            type        : 'POST',
            success     : function(data)
            {
                $('.form-login input, .form-login button').removeAttr('disabled');
                $('.form-login button').text('Login Now');

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
                $('.form-login button').text('Login Now');
                
                Swal.fire({
                    icon: 'error',
                    title: 'System Error',
                    text: `System Error: ${thrownError}. Status: ${xhr.status}`,
                    confirmButtonColor: 'rgb(62, 82, 84)'
                });
            },
            complete: () =>
            {
                grecaptcha.reset(captchaLogin);
            }
        });
    });
});


// ABOUT US
const videoFile = document.getElementById('video-file'),
      videoButton = document.getElementById('video-button'),
      videoIcon = document.getElementById('video-icon')

function playPause(){ 
    if (videoFile.paused){
        // Play video
        videoFile.play()
        // We change the icon
        videoIcon.classList.add('ri-pause-line')
        videoIcon.classList.remove('ri-play-line')
    }
    else {
        // Pause video
        videoFile.pause(); 
        // We change the icon
        videoIcon.classList.remove('ri-pause-line')
        videoIcon.classList.add('ri-play-line')

    }
}
videoButton.addEventListener('click', playPause)

function finalVideo(){
    // Video ends, icon change
    videoIcon.classList.remove('ri-pause-line')
    videoIcon.classList.add('ri-play-line')
}
// ended, when the video ends


videoFile.addEventListener('ended', finalVideo)


const sr = ScrollReveal({
    distance: '60px',
    duration: 2800,
})

sr.reveal(`.home_content`,{
    origin: 'top',
    interval: 100,
}) 

sr.reveal(`.about_content, .image`,{
    origin:'bottom',
    interval: 100,
})
sr.reveal(` .video_content`,{
    opacity : 0,
    interval: 100,

})

sr.reveal(`.home_content,.section_title`,{
    origin: 'top',
    interval: 100,
}) 
sr.reveal(`.video_description`,{
    origin:'left',
    interval: 100,
})
$(function () {
    let playSound = false;
    let darkMode = false;
    let volume = 0.5;

    const sound = new Howl({
        src: ['./sound.mp3'],
        loop: true,
        volume: 0,
        onplay: function () {
            console.log("Sound is Playing");
        },
        onpause: function () {
            console.log("Howler not Playing");
        }
    });

    $('[data-display=loader]').click(function () {
        $(this).fadeOut(800);
        $("#irgl-section").fadeIn(1000);

        if (!sound.playing()) {
            playSound = true;
            sound.play();
            sound.fade(0, 0.5, 2000);
            // sound.volume(0.7);
        }
    });

    $('[data-toggle=modal]').click(function (e) {
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

    $("#volumeSelect").change(function () {
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

    $('#darkModeSelect').change(() => {
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

    $('#musicSoundSelect').change(() => {
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
});
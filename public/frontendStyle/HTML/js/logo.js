$(document).ready(function() {
  var icons = $(".grid-container a img");
  var infoBox = $(".information");
  var currentIndex = 0;
  var interval = 2000;
  var vibrationDuration = 1500;
  var pauseBetweenVibrations = 3500;
  var resumeVibrationDelay = 4000;

  var timer;
  var isManualVibration = false;

  function showInfo(index) {
    var currentIcon = icons.eq(index);
    var text = currentIcon.data("text");
    infoBox.text(text).fadeIn();

    if (!currentIcon.hasClass("active")) {
      icons.removeClass("active");
      vibrateIcon(currentIcon);

      timer = setTimeout(function() {
        resetIcon(currentIcon);
        infoBox.fadeOut();
        if (!isManualVibration) {
          resumeAutomaticVibration();
        }
      }, vibrationDuration + pauseBetweenVibrations);
    }
  }

  function vibrateIcon(icon) {
    icon.addClass("active");
    icon.css({
      animation: "vibration 1.5s ease-in-out infinite"
    });
  }

  function resetIcon(icon) {
    icon.removeClass("active");
    icon.css({
      animation: "none"
    });
  }

  function vibrateNextIcon() {
    currentIndex = (currentIndex + 1) % icons.length;
    showInfo(currentIndex);
  }

  vibrateNextIcon();

  function resumeAutomaticVibration() {
    if (!isManualVibration) {
      timer = setTimeout(function() {
        vibrateNextIcon();
      }, pauseBetweenVibrations);
    }
  }

  icons.on("mouseenter", function() {
    if ($(this).hasClass("active")) {
      return;
    }

    isManualVibration = true;
    clearTimeout(timer);

    icons.removeClass("active");
    resetIcon(icons);
    $(this).addClass("active");
    vibrateIcon($(this));
    infoBox.text($(this).data("text")).fadeIn();
  });

  icons.on("mouseleave", function() {
    if ($(this).hasClass("active")) {
      return;
    }

    isManualVibration = false;
    clearTimeout(timer);
    resetIcon(icons);
    setTimeout(function() {
      resumeAutomaticVibration();
    }, resumeVibrationDelay);
  });

  $(".grid-container").on("mouseenter", function() {
    resumeAutomaticVibration();
  }).on("mouseleave", function() {
    if (!isManualVibration) {
      resumeAutomaticVibration();
    }
  });
});
